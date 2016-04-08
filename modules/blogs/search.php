<?php
///////////////////////////////////////////////////////////////////////////////////////
// PHPizabi 2.01 Alpha [Madison]                             http://www.phpizabi.org //
///////////////////////////////////////////////////////////////////////////////////////
//                                                                                   //
// Please read the LICENSE.md & README.md file before using/modifying this software  //
//                                                                                   //
// Developing Author:       Andrew James, RubberDucky - andy@phpizabi.org            //
// Last modification date:  December 13th, 201                                       //
// Version:                 PHPizabi 2.01 Alpha                                      //
//                                                                                   //
// (C) 2005, 2006 Real!ty Medias                                                     //
// (C) 2007-2012 AndyJames.Org                                                       //
//                                                                                   //
// PHPizabi Is the work of a very talented development team. This script is our      //
// Pride and Joy. We hope that you enjoy using this software as much as we enjoy     //
// Developing it for you. If you need anything: http://www.phpizabi.org              //
//                                                                                   //
///////////////////////////////////////////////////////////////////////////////////////

	/* Check Structure Availability */
	if (!defined("CORE_STRAP")) die("Out of structure call");
	
	// TEMPLATE ENGINE INITIALIZATION /////////////////////////////////////////////////
	$tpl = new template;
	$tpl -> Load("search");
	$tpl -> GetObjects();
	
	// QUERY STRING PREPARATION ///////////////////////////////////////////////////////
	if (isset($_GET["query"])) {
		
		// BOOLEAN ////////////////////////////////////////////////////////////////////
		/*
			we will manipulate the search booleans here, there
			are 3 types: OR, AND, or PHRASE. The "or" boolean
			is the default one, we don't need to modify the search
			query for that one. Set the variable...
		*/
		if (!isset($_GET["boolean"]) || $_GET["boolean"] == "or") {
			
			/*
				If there was only one word, we will prefix it with
				a strict search char and append a wildcard char at
				the end of the word, this help the search engine
				find some results with short queries.
			*/
			if (strlen(trim($_GET["query"])) > 0 && !strstr(trim($_GET["query"]), " ") && !strstr($_GET["query"], "*")) {
				$query = "+".$_GET["query"]."*";
			}
			
			/*
				If there was more than a word and the boolean is
				null or is "OR", we will use the query as-is.
			*/
			else $query = $_GET["query"];
		
		}
		
		/*
			Boolean is "AND", each word of the query string must
			be prefixed with a PLUS (+) sign. Let's deal with that...
		*/
		elseif ($_GET["boolean"] == "and") $query = str_replace(" ", " +", $_GET["query"]);
		
		/*
			Boolean is "PHRASE", we will need to "enquote" the
			query string so its considered in whole.
		*/
		elseif ($_GET["boolean"] == "phrase") $query = "+\"{$_GET["query"]}\"";
		
		// RESTRICT TO USER ///////////////////////////////////////////////////////////
		/*
			Some external pages will require to search for blogs articles
			from a specific user... let's handle that.
		*/
		if (isset($_GET["user"]) && is_numeric($_GET["user"])) {
			$usrQ = " AND `user`='{$_GET["user"]}' ";
		} else $usrQ = null;
		
		// FIELDS /////////////////////////////////////////////////////////////////////
		/*
			The "sin" get array defines in what fields we will be 
			searching. if it is not set, we will search in both 
			the title and the body of the blog article, if it is
			set, we will use its values.
		*/
		if (!isset($_GET["sin"]) || !is_array($_GET["sin"])) $sin = "`title`,`body`";
		else $sin = "`".implode("`,`", $_GET["sin"])."`";
		
		// ORDER //////////////////////////////////////////////////////////////////////
		/*
			The order post is meant to define the sort order for
			what we will find, the default order is the MATCH AGAINST
			sort order (based on score). We will override that if 
			something has been posted
		*/
		$orderingKeys = array("date","views","comments");
		if (isset($_GET["order"]) && in_array($_GET["order"], $orderingKeys)) {
			
			/*
				Set the ordering direction -- HEY! Why is it that we call 
				ASCENDING and we do DESCENDING? Ok that looks strange but
				for an intuitivity need, we need to do that, as integers
				grows as they are created, an ascending order would place
				the older values first, while the user checked "ascending"
				to get the newer values first...
			*/
			if (isset($_GET["direction"]) && $_GET["direction"] == "desc") $orderBy = "ORDER BY {$_GET["order"]} ASC";
			else $orderBy = "ORDER BY {$_GET["order"]} DESC";
		}
		
		/*
			No orderby provided or the key was invalid?
			(We actually post an invalid key purposely when
			we want to use the natural order... so there
			is no forced order) -- Let's make the ordering
			blank.
		*/
		else $orderBy = "";
		
		// PAGINATION PREPARATION /////////////////////////////////////////////////////
		if (!isset($_GET["page"]) || !is_numeric($_GET["page"]) || $_GET["page"] == 0) $page = 1;
		else $page = $_GET["page"];
		
		// RUN THE QUERY //////////////////////////////////////////////////////////////
		/*
			Run the query
		*/
		$select = myQ("
			SELECT SQL_CALC_FOUND_ROWS * 
			FROM `[x]blogs` 
			WHERE MATCH ({$sin}) AGAINST ('{$query}' IN BOOLEAN MODE) 
			{$usrQ}
			{$orderBy} 
			LIMIT ".(($page * $CONF["SEARCH_RESULTS_PER_PAGE"]) - $CONF["SEARCH_RESULTS_PER_PAGE"]).",{$CONF["SEARCH_RESULTS_PER_PAGE"]}
		");
		
		/*
			Find out how many rows we would have got
			without the limit statement
		*/
		$countRowsSelect = myQ("SELECT FOUND_ROWS()");
		$countRowsResult = mysql_fetch_row($countRowsSelect);
		$totalRows = $countRowsResult[0];

		// PAGINATION ////////////////////////////////////////////////////////////////
		$totalPages = ceil($totalRows / $CONF["SEARCH_RESULTS_PER_PAGE"]);
		
		if ($totalPages > 1) {
			
			$tpl -> Zone("paginationBlock", "enabled");
			
			/*
				If the total number of pages to be shown exceed
				the total number of pages we are allowed to show,
				we will show the total allowed pages instead.
			*/
			$showPages = ($totalPages>$CONF["SEARCH_PAGINATION_PADDING"]?$CONF["SEARCH_PAGINATION_PADDING"]:$totalPages);
			
			/*
				Find out the first page to start up with; if
				the total number of pages to show divided by
				two (total middle) is greater than the actual 
				page number, we will start with the actual page
				minus the result of the total pages to show 
				divided by two; else, we start with page one.
			*/
			if ($totalPages > $showPages && $page > ceil($showPages/2)) {
				
				/*
					Set the first page
				*/
				$startUpPage = $page - floor($showPages/2);
	
				/*
					Make sure we show the maximum number of pages
					when we're at the end of the results. If 
					the value of startuppage (first page
					to be shown) minus the total number of
					shown pages is greater than the total number
					of pages to be displayed, it means the
					first page should be the result of the
					total pages minus the total of shown
					pages
				*/
				if (($startUpPage+$showPages) > $totalPages) $startUpPage = $totalPages - $showPages;
			}
			
			else $startUpPage = 1;
	
			/*
				Find out the last page number we will show
			*/		
			$lastPage = ($startUpPage+$showPages<$totalPages?$startUpPage+$showPages:$totalPages);
	
			/*
				Build up the actual page link, we will force the
				L value and remove the page value.
			*/
			$getDataString = "?L=".$_GET["L"];
	
			foreach ($_GET as $var => $val) {
				if (!is_array($val)) {
					if ($var != "page" && $var != "L") $getDataString .= "&{$var}={$val}";
				} else foreach ($val as $arVar => $arVal) {
					$getDataString .= "&{$var}[]={$arVal}";
				}
			}
	
			/*
				If the page is greater than page 2
				(not page one, not page two which are
				already linked if $page <= 2), we show
				a "back" link
			*/
			if ($page > 1) {
				$tpl -> Zone("pagination.back", "linked");
				$tpl -> AssignArray(array("pagination.back.link" => $getDataString."&page=".($page-1)));
			} else $tpl -> Zone("pagination.back", "disabled");
	
			/*
				If the first page isnt page number one, 
				we will show a link to it
			*/
			if ($startUpPage > 1) {
				$tpl -> Zone("pagination.first", "linked");
				$tpl -> AssignArray(array("pagination.first.link" => $getDataString."&page=1"));
			} else $tpl -> Zone("pagination.first", "disabled");
	
	
			/*
				Generate the pages
			*/
			$paginationMergeContent = NULL;
			for ($i=$startUpPage; $i<=$lastPage; $i++) {
				
				if ($i == $page) {
					$replaceArray = array(
						"{pagination.page.pageNumber}" => $i
					);
					
					$paginationMergeContent .= strtr($GLOBALS["OBJ"]["pagination.unlinked.page"], $replaceArray);
				} else {
					$replaceArray = array(
						"{pagination.page.pageNumber}" => $i,
						"{pagination.page.link}" => $getDataString."&page={$i}"
					);
					
					$paginationMergeContent .= strtr($GLOBALS["OBJ"]["pagination.linked.page"], $replaceArray);
				}
			}
			
			if (!is_null($paginationMergeContent)) $tpl -> AssignArray(array("pagination.pages" => $paginationMergeContent));
			
			
			/*
				If the last possible page isnt shown, we will
				show a link to it here
			*/
			if ($lastPage < $totalPages) {
				
				$tpl -> Zone("pagination.last", "linked");
				$tpl -> AssignArray(array(
					"pagination.last.link" => $getDataString."&page={$totalPages}",
					"pagination.last.pageNumber" => $totalPages
				));
			} else $tpl -> Zone("pagination.last", "disabled");
			
			/*
				
			*/
			if ($page < $totalPages) {
				$tpl -> Zone("pagination.next", "linked");
				$tpl -> AssignArray(array(
					"pagination.next.link" => $getDataString."&page=".($page+1),
				));
			} else $tpl -> Zone("pagination.next", "disabled");
	
		}
		
		else $tpl -> Zone("paginationBlock", "disabled");
		
		$tpl -> AssignArray(array(
			"page.thisPage" => $page,
			"page.total" => $totalPages,
		));
		
		// DISPLAY RESULTS ///////////////////////////////////////////////////////////
		$i=0;
		/*
			Cycle in the results array
		*/
		while ($row = myF($select)) {
			
			/*
				Generate the loop array
			*/
			$resultsLoopArray[$i] = array(
				"blog.user" => _fnc("user", $row["user"], "username"),
				"blog.id" => $row["id"],
				"blog.comments" => $row["comments"],
				"blog.date" => date($CONF["LOCALE_SHORT_DATE"], $row["date"]),
				"blog.views" => $row["views"],
				"blog.body" => _fnc("str_spot", _fnc("clearBodyCodes", $row["body"]), $_GET["query"], 200),
				"blog.userid" => $row["user"],
				"blog.title" => _fnc("strtrim", $row["title"], 40),
				"blog.mainpicture" => _fnc("user", $row["user"], "mainpicture")
			);
			
			$i++;
		}
		
		/*
			if there was results, let's loop them
		*/
		if (isset($resultsLoopArray)) {
			$tpl -> Zone("searchResults", "enabled");
			$tpl -> Zone("searchResultsBlock", "enabled");
			$tpl -> Loop("searchResultsLoop", $resultsLoopArray);


			$tpl -> Zone("searchCounter", "enabled");
			$tpl -> AssignArray(array(
				"count.total" => $totalRows,
			));
		}
		
		/*
			No results? Show a message
		*/
		else {
			$tpl->Zone("searchResults", "noResult");
			$tpl->Zone("searchCounter", "noResult");
		}
		

	} 
	
	else {
		$tpl -> Zone("searchCounter", "disabled");
	}
	
	
	// POPULATE FORM FIELDS /////////////////////////////////////////////////
	/*
		We will post-populate the fields values here. 
		The following are the booleans radio buttons
	*/
		
	$tpl->AssignArray(array(
		"boolean.or.checkvalue" => ((isset($_GET["boolean"])&&$_GET["boolean"]=="or")||(!isset($_GET["boolean"]))?"checked":NULL),
		"boolean.and.checkvalue" => (isset($_GET["boolean"])&&$_GET["boolean"]=="and"?"checked":NULL),
		"boolean.phrase.checkvalue" => (isset($_GET["boolean"])&&$_GET["boolean"]=="phrase"?"checked":NULL)
	));
		
	/*
		Now the ordering radios
	*/
	$tpl->AssignArray(array(
		"order.natural.checkvalue"=>((isset($_GET["order"])&&$_GET["order"]=="natural")||(!isset($_GET["order"]))?"checked":NULL),
		"order.date.checkvalue" => (isset($_GET["order"])&&$_GET["order"]=="date"?"checked":NULL),
		"order.views.checkvalue" => (isset($_GET["order"])&&$_GET["order"]=="views"?"checked":NULL),
		"order.comments.checkvalue" => (isset($_GET["order"])&&$_GET["order"]=="comments"?"checked":NULL)
	));
		
	/*
		The sort direction
	*/
	$tpl->AssignArray(array(
		"direction.asc.checkvalue"=>((isset($_GET["direction"])&&$_GET["direction"]=="asc")||(!isset($_GET["direction"]))?"checked":NULL),
		"direction.desc.checkvalue" => (isset($_GET["direction"])&&$_GET["direction"]=="desc"?"checked":NULL)
	));
		
	/*
		The sin
	*/
	$tpl->AssignArray(array(
		"sin.title"=>((isset($_GET["sin"])&&in_array("title",$_GET["sin"]))||(!isset($_GET["sin"]))?"checked":NULL),
		"sin.body"=>((isset($_GET["sin"])&&in_array("body",$_GET["sin"]))||(!isset($_GET["sin"]))?"checked":NULL)
	));
		
	/*
		The text field
	*/
	$tpl->AssignArray(array("get.query"=>(isset($_GET["query"])?$_GET["query"]:NULL)));
	
	
	$tpl -> CleanZones();
	$tpl -> Flush();

?>