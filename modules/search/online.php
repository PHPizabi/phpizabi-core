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
	$tpl -> Load("online");
	
	// RUN THE QUERY //////////////////////////////////////////////////////////////
	/*
		Run the query
	*/
	$select = myQ("
		SELECT SQL_CALC_FOUND_ROWS * 
		FROM `[x]users` 
		WHERE `active`='1'
		AND `last_load` > '".(date("U")-130)."'
		LIMIT 1000
	");
		
	/*
		Find out how many rows we would have got
		without the limit statement
	*/
	$countRowsSelect = myQ("SELECT FOUND_ROWS()");
	$countRowsResult = mysql_fetch_row($countRowsSelect);
	$totalRows = $countRowsResult[0];
	
	$tpl->AssignArray(array("users.onlineCount" => $totalRows));

	// ASSIGN AND LOOP ///////////////////////////////////////////////////////////
	$i=0;
	while ($row = myF($select)) {
			
		$resultsLoopArray[$i]["user.username"] = $row["username"];
		$resultsLoopArray[$i]["user.id"] = $row["id"];
		$resultsLoopArray[$i]["user.mainpicture"] = $row["mainpicture"];
		$resultsLoopArray[$i]["user.quote"] = _fnc("strtrim", $row["quote"], 40);
		$resultsLoopArray[$i]["user.gender"] = $row["gender"];
		$resultsLoopArray[$i]["user.age"] = $row["age"];
		$resultsLoopArray[$i]["user.header"] = _fnc("strtrim", _fnc("clearBodyCodes", $row["header"]), 100);
				
		$i++;
	}
			
	/*
		if there was results, let's loop them
	*/
	if (isset($resultsLoopArray)) {
		$tpl->Zone("searchResults", "enabled");
		$tpl->Loop("searchResultsLoop", $resultsLoopArray);
	}
		
	/*
		No results? Show a message
	*/
	else $tpl->Zone("searchResults", "noResult");
	
	
	


	
	$tpl -> Flush();

?>