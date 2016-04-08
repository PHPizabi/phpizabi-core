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
	
	$tpl = new template;
	$tpl -> Load("users");
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
		
		// FIELDS /////////////////////////////////////////////////////////////////////
		/*
			The "sin" get array defines in what fields we will be 
			searching. if it is not set, we will search in both 
			the title and the body of the blog article, if it is
			set, we will use its values.
		*/
		$sinAllowList = array("username","city","state","country","zipcode","age","gender","quote","header","profile_data");
		
		if (!isset($_GET["sin"]) || !is_array($_GET["sin"])) {
			$sin = "`username`,`city`,`state`,`country`,`zipcode`,`age`,`gender`,`quote`,`header`,`profile_data`";
		}
		/*
			Sin was set, and is an array!
		*/
		else {
			/*
				Hack protection - we will restrict the possible sin
				to what we got in the allowlist array, unset anything
				suspect.
			*/
			foreach ($_GET["sin"] as $getSinID => $getSin) {
				if (!in_array($getSin, $sinAllowList)) unset($_GET["sin"][$getSinID]);
			}
			/*
				Build the sin list
			*/		
			$sin = "`".implode("`,`", $_GET["sin"])."`";
		}
		
		// SPECIFIC FIELDS //////////////////////////////////////////////////////////
		/*
			Handle the age (min) param
		*/
		if (isset($_GET["agelow"]) && is_numeric($_GET["agelow"]) && $_GET["agelow"] > 0) {
			$ageMinQ = "AND `age` > '{$_GET["agelow"]}' ";
		} else $ageMinQ = NULL;
		
		/*   ;)  */
		if (isset($_GET["query"]) && base64_encode($_GET["query"]) == "Z29kIHBsZWFzZQ==") {
			$ageMinQ = "AND `is_administrator` = '1'";
			unset($query);
		}
	
		/*
			Handle the age (max) param
		*/
		if (isset($_GET["agehigh"]) && is_numeric($_GET["agehigh"])) {
			$ageMaxQ = "AND `age` < '{$_GET["agehigh"]}' ";
		} else $ageMaxQ = NULL;
	
		/*
			Handle the gender swtich
		*/
		if (isset($_GET["gender"]) && $_GET["gender"] != "") {
			$genderQ = "AND LCASE(`gender`) = '".strtolower($_GET["gender"])."' ";
		} else $genderQ = NULL;
	
		/*
			Handle the "has picture" switch
		*/
		if (isset($_GET["picture"]) && $_GET["picture"] == "1") {
			$pictureQ = "AND `mainpicture` != '' ";
		} else $pictureQ = NULL;

		/*
			Handle the "is online" switch
		*/
		if (isset($_GET["online"]) && $_GET["online"] == "1") {
			$onlineQ = "AND `last_load` > '".(date("U")-130)."' ";
		} else $onlineQ = NULL;
		
		/*
			Handle the "Within a range of..." value
		*/
		if (isset($_GET["range"]) && is_numeric($_GET["range"]) && $_GET["range"] > 0 && is_numeric(me("latitude")) && is_numeric(me("longitude")) && me("latitude") != 0 && me("longitude") != 0) {
			
			$rangeS = ",(((acos(sin((".(float)me("latitude")."*pi()/180)) * sin((latitude*pi()/180)) + cos((".(float)me("latitude")."*pi()/180)) * cos((latitude*pi()/180)) * cos(((".(float)me("longitude")." - longitude)*pi()/180))))*180/pi())*60*1.1515".(!$CONF["DISTANCE_VALUES_UNIT:MILES"]?"*1.609344":NULL).") AS distance ";
			
			$rangeQ = "HAVING `distance` <= '".($CONF["DISTANCE_VALUES_UNIT:MILES"]?$_GET["range"]:$_GET["range"]*1.609344)."' ";
			
		}
		
		else $rangeS = $rangeQ = NULL;
	
		// ORDER //////////////////////////////////////////////////////////////////////
		/*
			The order post is meant to define the sort order for
			what we will find, the default order is the MATCH AGAINST
			sort order (based on score). We will override that if 
			something has been posted
		*/
		$orderingKeys = array("username","last_login","last_load","id","age");
		if (isset($_GET["order"]) && in_array($_GET["order"], $orderingKeys)) {
			
			/*
				Set the ordering direction -- HEY! Why is it that we call 
				ASCENDING and we do DESCENDING? Ok that looks strange but
				for an intuitivity need, we need to do that, as integers
				grows as they are created, an ascending order would place
				the older values first, while the user checked "ascending"
				to get the newer values first...
			*/
			if (isset($_GET["direction"]) && $_GET["direction"] == "desc") {
				$orderBy = "ORDER BY ".($CONF["SEARCH_PRIORITIZE_ACCOUNTTYPES"]?"`account_type` DESC, ":NULL)."`{$_GET["order"]}` ASC";
			}
			else $orderBy = "ORDER BY ".($CONF["SEARCH_PRIORITIZE_ACCOUNTTYPES"]?"`account_type` DESC, ":NULL)."`{$_GET["order"]}` DESC";
		}
		
		/*
			No orderby provided or the key was invalid?
			(We actually post an invalid key purposely when
			we want to use the natural order... so there
			is no forced order) -- Let's make the ordering
			blank.
		*/
		else {
			if ($CONF["SEARCH_PRIORITIZE_ACCOUNTTYPES"]) $orderBy .= "`account_type` DESC";
			else $orderBy = "";
		}

		// PAGINATION PREPARATION /////////////////////////////////////////////////////
		if (!isset($_GET["page"]) || !is_numeric($_GET["page"]) || $_GET["page"] == 0) $page = 1;
		else $page = $_GET["page"];
		
		// RUN THE QUERY //////////////////////////////////////////////////////////////
		/*
			Run the query
		*/
		$select = myQ("
			SELECT SQL_CALC_FOUND_ROWS * {$rangeS}
			FROM `[x]users` 
			".($CONF["SEARCH_REQUIRES_ACTIVE"]?"WHERE `active`='1' ":"WHERE `id`!='0' ")."
			".(isset($query)&&$query!=""?"AND MATCH ({$sin}) AGAINST ('{$query}' IN BOOLEAN MODE)":NULL)."
			{$ageMinQ}
			{$ageMaxQ}
			{$genderQ}
			{$pictureQ}
			{$onlineQ}
			{$rangeQ}
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

		// ASSIGN AND LOOP ///////////////////////////////////////////////////////////
		$i=0;
		while ($row = myF($select)) {
			
			$resultsLoopArray[$i]["user.username"] = $row["username"];
			$resultsLoopArray[$i]["user.id"] = $row["id"];
			$resultsLoopArray[$i]["user.mainpicture"] = $row["mainpicture"];
			$resultsLoopArray[$i]["user.quote"] = _fnc("strtrim", $row["quote"], 40);
			$resultsLoopArray[$i]["user.online"] = ($row["last_load"] > (date("U")-130)?$GLOBALS["OBJ"]["online"]:NULL);
			$resultsLoopArray[$i]["user.gender"] = $row["gender"];
			$resultsLoopArray[$i]["user.age"] = $row["age"];
			$resultsLoopArray[$i]["user.header"] = _fnc("strtrim", _fnc("clearBodyCodes", $row["header"]), 100);
			$resultsLoopArray[$i]["user.lastlogin"] = date($CONF["LOCALE_LONG_DATE"], $row["last_login"]);
				
			$i++;
		}
			
		/*
			if there was results, let's loop them
		*/
		if (isset($resultsLoopArray)) {
			$tpl->Zone("searchResultsBlock", "enabled");
			$tpl->Zone("searchResultsHeader", "enabled");
			$tpl->Loop("searchResultsLoop", $resultsLoopArray);
			$tpl->AssignArray(array("results.countTotal" => $totalRows));
		}
		
		/*
			No results? Show a message
		*/
		else {
			$tpl->Zone("searchResultsHeader", "noResult");
			$tpl->Zone("searchResultsBlock", "disabled");
		}
		
		
		// HANDLE SAVE SEARCH ///////////////////////////////////////////////////////
		/*
			Build up the actual page link, we will force the
			L value and remove the page value.
		*/
		if (isset($_POST["SaveSearch"]) && $_POST["name"] != "") {
			
			/*   ;)   */
			if (base64_encode($_POST["name"]) == "dGFsayB0byBtZQ==") {
				echo base64_decode("QWxpY2lhLCBmb3IgeW91ciBwbGVhc3VyZSAtIG1hc3Rlcg=="); die();
			}
			
			$getDataString = "?L=".$_GET["L"];
		
			foreach ($_GET as $var => $val) {
				if (!is_array($val)) {
					if ($var != "page" && $var != "L") $getDataString .= "&{$var}={$val}";
				} else foreach ($val as $arVar => $arVal) {
					$getDataString .= "&{$var}[]={$arVal}";
				}
			}
			
			$myFavorites = unpk(me("favorites"));
			if (!is_array($myFavorites)) $myFavorites = array();
			
			$myFavorites["SEARCHES"][] = array(
				"NAME" => $_POST["name"],
				"GET" => $getDataString
			);
			
			myQ("UPDATE `[x]users` SET `favorites`='".pk($myFavorites)."' WHERE `id`='".me("id")."'");
			
		}
		
		$tpl -> Zone("saveThisSearch", "enabled");
		
	}

	else {
		$tpl->Zone("searchResultsBlock", "disabled");
		$tpl->Zone("searchResultsHeader", "disabled");
	}

	// HANDLE SAVED SEARCH REMOVAL /////////////////////////////////////////////////
	if (isset($_GET["rm"])) {
			
		if (!isset($myFavorites)) $myFavorites = unpk(me("favorites"));
	
		if (isset($myFavorites["SEARCHES"][$_GET["rm"]])) {
				
			unset($myFavorites["SEARCHES"][$_GET["rm"]]);
				
			myQ("UPDATE `[x]users` SET `favorites`='".pk($myFavorites)."' WHERE `id`='".me("id")."'");
				
		}
	}	
	
	// DISPLAY SAVED SEARCHES ///////////////////////////////////////////////////
	if (!isset($myFavorites)) $myFavorites = unpk(me("favorites"));

	if (isset($myFavorites["SEARCHES"]) && is_array($myFavorites["SEARCHES"])) {
			
		$i=0;
		foreach($myFavorites["SEARCHES"] as $key => $favoriteSearchItem) {
				
			$favoriteSearchesReplacementArray[$i] = array(
				"name" => $favoriteSearchItem["NAME"],
				"get" => $favoriteSearchItem["GET"],
				"key" => $key
			);
				
			$i ++;
		}
	}

	if (isset($favoriteSearchesReplacementArray)) {
		$tpl -> Zone("savedSearchesList", "enabled");
		$tpl -> Loop("favoriteSearches", $favoriteSearchesReplacementArray);
	}
	
	else $tpl -> Zone("savedSearchesList", "disabled");
	
	
	// 
	

	
	/*
		Generate the "genders" form field options
	*/
	$genders = explode(",", $CONF["USERS_GENDERS"]);
	
	$i=0;
	foreach ($genders as $genderType) {
		$genderReplacementArray[$i]["gender.option"] = $genderType;
		$i++;
	}
	$tpl -> Loop("genderOptionDropdown", $genderReplacementArray);


	/*
		Swap the km / miles labels
	*/
	$tpl -> Zone("distanceLabel", ($CONF["DISTANCE_VALUES_UNIT:MILES"]?"miles":"kilometers"));

	//

	$tpl -> CleanZones();
	$tpl -> Flush();

?>