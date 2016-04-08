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
	/* Administrative restriction */
	(!me('is_administrator')&&!me('is_superadministrator')?die("Access restricted"):NULL);

	$tpl = new template;
	$tpl -> Load("users");
	$tpl -> GetObjects();
	
	// HANDLE THE GHOST REQUEST /////////////////////////////////////////////////////////
	if (isset($_GET["ghost"]) && $_GET["ghost"] != me("id")) {
		
		/*
			Swapping works one level down, means a superadmin can swap to 
			an admin but not to another superadmin - admins can swap to users
			only
		*/
		if (
			(me('is_superadministrator') && !_fnc("user", $_GET["ghost"], "is_superadministrator"))
			||
			(me('is_administrator') && !_fnc("user", $_GET["ghost"], "is_superadministrator") && !_fnc("user", $_GET["ghost"], "is_administrator"))
		) {
		
			$_SESSION["swap_id"] = $_SESSION["id"];
			$_SESSION["id"] = $_GET["ghost"];
			_fnc("reload", 0, "?L=users.desktop");
		}
	}
	
	// HANDLE THE ACTION REQUEST /////////////////////////////////////////////////////////
	if (isset($_GET["action"], $_GET["ck"]) && $_GET["action"] != NULL && is_array($_GET["ck"])) {
		
		switch($_GET["action"]) {
			
			case("activate"):
				$query = NULL;
				for ($i=0; $i < count($_GET["ck"]); $i++) {
					$query .= ($i == 0 ? "WHERE (`id`='{$_GET["ck"][$i]}'" : " OR `id`='{$_GET["ck"][$i]}'");
				}
				$query .= ")";
				
				myQ("UPDATE `[x]users` SET `active`='1' {$query}");
				
				$tpl -> Zone("dbUpdate", "enabled");
				$tpl -> AssignArray(array("dbUpdateCount" => mysql_affected_rows()));
			break;
			
			case("unactivate"):
				$query = NULL;
				for ($i=0; $i < count($_GET["ck"]); $i++) {
					if (_fnc("user", $_GET["ck"][$i], "is_superadministrator")) $_GET["ck"][$i] = 0; // don't un-activate superadmins //
					$query .= ($i == 0 ? "WHERE (`id`='{$_GET["ck"][$i]}'" : " OR `id`='{$_GET["ck"][$i]}'");
				}
				$query .= ")";
				
				myQ("UPDATE `[x]users` SET `active`='0' {$query}");
				
				$tpl -> Zone("dbUpdate", "enabled");
				$tpl -> AssignArray(array("dbUpdateCount" => mysql_affected_rows()));
			break;
			
			case("admin"):
				$query = NULL;
				for ($i=0; $i < count($_GET["ck"]); $i++) {
					$query .= ($i == 0 ? "WHERE (`id`='{$_GET["ck"][$i]}'" : " OR `id`='{$_GET["ck"][$i]}'");
				}
				$query .= ")";
				
				myQ("UPDATE `[x]users` SET `is_administrator`='1' {$query}");
				
				$tpl -> Zone("dbUpdate", "enabled");
				$tpl -> AssignArray(array("dbUpdateCount" => mysql_affected_rows()));
			break;
			
			case("unadmin"):
				$query = NULL;
				for ($i=0; $i < count($_GET["ck"]); $i++) {
					if (_fnc("user", $_GET["ck"][$i], "is_superadministrator")) $_GET["ck"][$i] = 0; // don't un-admin superadmins //
					$query .= ($i == 0 ? "WHERE (`id`='{$_GET["ck"][$i]}'" : " OR `id`='{$_GET["ck"][$i]}'");
				}
				$query .= ")";
				
				myQ("UPDATE `[x]users` SET `is_administrator`='0' {$query}");
				
				$tpl -> Zone("dbUpdate", "enabled");
				$tpl -> AssignArray(array("dbUpdateCount" => mysql_affected_rows()));
			break;
			
			case("emailcheck"):
				$query = NULL;
				for ($i=0; $i < count($_GET["ck"]); $i++) {
					$query .= ($i == 0 ? "WHERE (`id`='{$_GET["ck"][$i]}'" : " OR `id`='{$_GET["ck"][$i]}'");
				}
				$query .= ")";
				
				myQ("UPDATE `[x]users` SET `email_verified`='1' {$query}");
				
				$tpl -> Zone("dbUpdate", "enabled");
				$tpl -> AssignArray(array("dbUpdateCount" => mysql_affected_rows()));
			break;
			
			case("bulkmail"):
				if (isset($_SESSION["BULK_LIST"]) && is_array($_SESSION["BULK_LIST"])) {
					$_SESSION["BULK_LIST"] = array_merge($_SESSION["BULK_LIST"], $_GET["ck"]);
				}
				else $_SESSION["BULK_LIST"] = $_GET["ck"];
			break;
			
			case("delete"):
				$query = NULL;
				for ($i=0; $i < count($_GET["ck"]); $i++) {
					if (_fnc("user", $_GET["ck"][$i], "is_superadministrator")) $_GET["ck"][$i] = 0; // don't delete superadmins //
					$query .= ($i == 0 ? "WHERE (`id`='{$_GET["ck"][$i]}'" : " OR `id`='{$_GET["ck"][$i]}'");
				}
				$query .= ")";
				
				myQ("DELETE FROM `[x]users` {$query}");
				
				$tpl -> Zone("dbUpdate", "enabled");
				$tpl -> AssignArray(array("dbUpdateCount" => mysql_affected_rows()));
			break;
		}
	}

	// QUERY STRING PREPARATION ///////////////////////////////////////////////////////
	if (isset($_GET["query"]) && !is_numeric($_GET["query"])) {
		
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
		A numeric search has been passed. We will get the 
		user by ID
	*/
	if (isset($_GET["query"]) && is_numeric($_GET["query"])) $qID = "AND `id` = '{$_GET["query"]}' ";
	else $qID = NULL;

	// ORDER GET REQUEST ///////////////////////////////////////////////////////////////
	$qOrder = "ORDER BY `".(isset($_GET["order"])?$_GET["order"]:"id")."` ".(isset($_GET["direction"])?$_GET["direction"]:"ASC");

	// SORT ONLY GET REQUEST ///////////////////////////////////////////////////////////
	if (isset($_GET["sort"])) {
		
		switch($_GET["sort"]) {
			
			case("all"): default:
				$qSort = NULL;
			break;
			
			case("admin"):
				$qSort = "AND (`is_administrator` = '1' OR `is_superadministrator` = '1') ";
			break;
			
			case("active"):
				$qSort = "AND `active`='1' ";
			break;
			
			case("notactive"):
				$qSort = "AND `active`!='1' ";
			break;
			
			case("online"):
				$qSort = "AND `last_load` > '".(date("U")-300)."' ";
			break;
			
			case("offline"):
				$qSort = "AND `last_load` < '".(date("U")-300)."' ";
			break;
			
			case("picture"):
				$qSort = "AND `mainpicture` != '' ";
			break;
			
			case("nopicture"):
				$qSort = "AND `mainpicture` = '' ";
			break;
			
			case("type"):
				$qSort = "AND `account_type` != '' ";
			break;
			
			case("notype"):
				$qSort = "AND `account_type` = '' ";
			break;

		}
	}
	
	else $qSort = NULL;

	// POPULATE FORM FIELDS ////////////////////////////////////////////////////////////
	/*
		Results per page
	*/
	$tpl -> AssignArray(array(
		"rpp.ck.20" => ( (isset($_GET["rpp"]) && $_GET["rpp"] == 20) || !isset($_GET["rpp"]) ? "selected" : NULL),
		"rpp.ck.50" => (isset($_GET["rpp"]) && $_GET["rpp"] == 50 ? "selected" : NULL),
		"rpp.ck.100" => (isset($_GET["rpp"]) && $_GET["rpp"] == 100 ? "selected" : NULL),
		"rpp.ck.500" => (isset($_GET["rpp"]) && $_GET["rpp"] == 500 ? "selected" : NULL),
		"rpp.ck.1000" => (isset($_GET["rpp"]) && $_GET["rpp"] == 1000 ? "selected" : NULL)
	));
	
	/*
		Sort field
	*/
	$tpl -> AssignArray(array(
		"sort.ck.all" => ( (isset($_GET["sort"]) && $_GET["sort"] == "all") || !isset($_GET["sort"]) ? "selected" : NULL),
		"sort.ck.admin" => (isset($_GET["sort"]) && $_GET["sort"] == "admin" ? "selected" : NULL),
		"sort.ck.active" => (isset($_GET["sort"]) && $_GET["sort"] == "active" ? "selected" : NULL),
		"sort.ck.notactive" => (isset($_GET["sort"]) && $_GET["sort"] == "notactive" ? "selected" : NULL),
		"sort.ck.online" => (isset($_GET["sort"]) && $_GET["sort"] == "online" ? "selected" : NULL),
		"sort.ck.offline" => (isset($_GET["sort"]) && $_GET["sort"] == "offline" ? "selected" : NULL),
		"sort.ck.picture" => (isset($_GET["sort"]) && $_GET["sort"] == "picture" ? "selected" : NULL),
		"sort.ck.nopicture" => (isset($_GET["sort"]) && $_GET["sort"] == "nopicture" ? "selected" : NULL),
		"sort.ck.type" => (isset($_GET["sort"]) && $_GET["sort"] == "type" ? "selected" : NULL),
		"sort.ck.notype" => (isset($_GET["sort"]) && $_GET["sort"] == "notype" ? "selected" : NULL)
	));

	/*
		Order field
	*/
	$tpl -> AssignArray(array(
		"order.ck.id" => ( (isset($_GET["order"]) && $_GET["order"] == "id") || !isset($_GET["order"]) ? "selected" : NULL),
		"order.ck.username" => (isset($_GET["order"]) && $_GET["order"] == "username" ? "selected" : NULL),
		"order.ck.active" => (isset($_GET["order"]) && $_GET["order"] == "active" ? "selected" : NULL),
		"order.ck.gender" => (isset($_GET["order"]) && $_GET["order"] == "gender" ? "selected" : NULL),
		"order.ck.account_type" => (isset($_GET["order"]) && $_GET["order"] == "account_type" ? "selected" : NULL),
		"order.ck.account_expire" => (isset($_GET["order"]) && $_GET["order"] == "account_expire" ? "selected" : NULL),
		"order.ck.last_load" => (isset($_GET["order"]) && $_GET["order"] == "last_load" ? "selected" : NULL),
		
		"direction.ck.asc" => ((isset($_GET["direction"]) && $_GET["direction"] == "ASC") || !isset($_GET["direction"])?"selected":NULL),
		"direction.ck.desc" => (isset($_GET["direction"]) && $_GET["direction"] == "DESC" ? "selected" : NULL)
		
	));
	
	/*
		Query
	*/
	$tpl -> AssignArray(array("query" => (isset($_GET["query"])?$_GET["query"]:NULL)));
	
	// PAGINATION PREPARATION /////////////////////////////////////////////////////
	if (!isset($_GET["page"]) || !is_numeric($_GET["page"]) || $_GET["page"] == 0) $page = 1;
	else $page = $_GET["page"];
	
	/*
		Find out how many results per page we will display
	*/
	$resultsPerPage = (isset($_GET["rpp"])?$_GET["rpp"]:20);	

	// RUN QUERY //////////////////////////////////////////////////////////////////////
	$select = myQ("
		SELECT SQL_CALC_FOUND_ROWS `id`,`username`,`last_load`,`is_administrator`,`is_superadministrator`,`is_moderator`,`active`,`email_verified`,`account_type`
		FROM `[x]users` 
		WHERE `id`!='0'
		".(isset($query)&&$query!=""?"AND MATCH (`username`) AGAINST ('{$query}' IN BOOLEAN MODE)":NULL)."
		{$qID}
		{$qSort}
		{$qOrder}
		LIMIT ".(($page * $resultsPerPage) - $resultsPerPage).",{$resultsPerPage}
	");
	
	/*
		Find out how many rows we would have got
		without the limit statement
	*/
	$countRowsSelect = myQ("SELECT FOUND_ROWS()");
	$countRowsResult = mysql_fetch_row($countRowsSelect);
	$totalRows = $countRowsResult[0];

	// PAGINATION ////////////////////////////////////////////////////////////////
	$totalPages = ceil($totalRows / $resultsPerPage);
		
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
				if ($var != "page" && $var != "L" && $val != "ck") $getDataString .= "&{$var}={$val}";
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

	// COUNT ALL USERS ///////////////////////////////////////////////////////////
	$selectCount = myQ("SELECT SQL_CALC_FOUND_ROWS * FROM `[x]users`");
	$countRowsSelectCount = myQ("SELECT FOUND_ROWS()");
	$countRowsResultCount = mysql_fetch_row($countRowsSelectCount);
	$totalRowsCount = $countRowsResultCount[0];
	
	$tpl -> AssignArray(array(
		"dbCount.total" => $totalRowsCount,
		"dbCount.sample" => $totalRows,
		
		"page.pagenumber" => $page,
		"page.totalpages" => $totalPages
	));
		
	// ASSIGN LOOP ////////////////////////////////////////////////////////////////
	while ($userRow = myF($select)) {
		
		$usersReplacementArray[] = array(
			"user.id" => $userRow["id"],
			"user.username" => $userRow["username"],
			"user.lastload" => ($userRow["last_load"]>0?date($CONF["LOCALE_HEADER_DATE_TIME"], $userRow["last_load"]):0),
			"user.admin" => ($userRow["is_superadministrator"] ? "Super Admin" : ($userRow["is_administrator"] ? "Admin" : ($userRow["is_moderator"] ? "Moderator" : ""))),
			"user.active" => $userRow["active"],
			"user.account_type" => ($userRow["account_type"] > 0 ? $userRow["account_type"] : '')
		);
	}
	
	if (isset($usersReplacementArray)) {
		$tpl -> Loop("usersList", $usersReplacementArray);
	}

	// TEMPLATE REPROCESS & FLUSH ////////////////////////////////////////////////////
	$tpl -> CleanZones();

	/* Get the frame templates, flush the TPL result into it */
	$frame = new template;
	$frame -> Load("!theme/{$GLOBALS["THEME"]}/templates/admin/frame.tpl");
	$frame -> AssignArray(array(
		"jump" => $tpl->Flush(1)
	));
	
	/* Assign Location Value */
	$locationArray = explode(".", $_GET["L"]);
	for ($i=0; $i<count($locationArray); $i++) {
		$locationAppendResult[] = $locationArray[$i];
		if ($i > 0) $location[] = "<a href=\"?L=".implode(".", $locationAppendResult)."\">{$locationArray[$i]}</a>";
	}
	$frame -> AssignArray(array("location" => implode(" &raquo; ", $location)));
	
	/* Set the forced chromeless mode, flush the template */
	$GLOBALS["CHROMELESS_MODE"] = 1;
	$frame -> Flush();
	
?>