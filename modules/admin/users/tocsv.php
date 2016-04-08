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
	$tpl -> Load("tocsv");
	$tpl -> GetObjects();
	
	// HANDLE THE GENERATE REQUEST /////////////////////////////////////
	if (isset($_GET["Submit"], $_GET["ck"]) && is_array($_GET["ck"])) {

		$select = myQ("
			SELECT ".implode(",", $_GET["ck"])." 
			FROM `[x]users`
			".(isset($_GET["where"])&&$_GET["where"]!=""?"WHERE ".stripslashes($_GET["where"]):NULL)."
			".(isset($_GET["order"])&&$_GET["order"]!=""?"ORDER BY ".stripslashes($_GET["order"]):NULL)."
		");
		
		
		echo "
			SELECT ".implode(",", $_GET["ck"])."
			FROM `[x]users`
			".(isset($_GET["where"])&&$_GET["where"]!=""?"WHERE ".stripslashes($_GET["where"]):NULL)."
			".(isset($_GET["order"])&&$_GET["order"]!=""?"ORDER BY ".stripslashes($_GET["order"]):NULL)."
		";

		$csvRow[] = implode(stripslashes($_GET["field_terminator"]), $_GET["ck"]);
		while ($row = mysql_fetch_row($select)) {
			$csvRow[] = implode(stripslashes($_GET["field_terminator"]), $row);
		}
		
		$csvResult = implode(($_GET["line_terminator"]=="cr"?chr(13):chr(10)), $csvRow);

		$tpl -> Zone("pageFlop", "result");
		$tpl -> AssignArray(array(
			"csvOutput" => $csvResult,
			"csvCount" => myNum($select)
		));
		
	}
	
	else $tpl -> Zone("pageFlop", "form");

	// GET COLS, ASSIGN ////////////////////////////////////////////////
	$select = myQ("SHOW COLUMNS FROM `[x]users`");
	$i=0;
	while ($row = myF($select)) {
		$columnsReplacementArray[] = array(
			"db.column" => $row["Field"],
			"db.type" => $row["Type"],
			"db.null" => ($row["Null"]==""?"0":$row["Null"]),
			"db.key" => $row["Key"],
			"db.default" => $row["Default"],
			"db.extra" => $row["Extra"],
			"db.id" => $i
		);
		$i ++;
	}
	
	$tpl -> Loop("dbList", $columnsReplacementArray);
	
	

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