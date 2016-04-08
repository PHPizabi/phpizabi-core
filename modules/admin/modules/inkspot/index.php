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
	$tpl -> Load("index");
	
	$spotSubjects = unpk(file_get_contents("system/cache/inkspot.dat"));
	
	// HANDLE NEW SUBJECT ////////////////////////////////////////////
	if (isset($_POST["Submit"], $_POST["title"])) {
		$spotSubjects[] = array(
			"TITLE" => $_POST["title"],
			"ID" => time(),
			"LOCKED" => (isset($_POST["lock"])?true:false),
			"TOPIC_COUNT" => 0,
			"POST_COUNT" => 0,
			"TYPES" => (isset($_POST["class"])?implode(",", $_POST["class"]):NULL)
		);
		
		if ($handle = fopen("system/cache/inkspot.dat", "w")) {
			fwrite($handle, pk($spotSubjects));
			fclose($handle);
		}
	}
	//
	
	$subjectsCount = 0;
	
	foreach($spotSubjects as $key => $subject) {
		
		// HANDLE THE RM REQUEST /////////////////////////////
		if (isset($_GET["rm"]) and $_GET["rm"] == $subject["ID"]) {
			unset($spotSubjects[$key]);
			
			if ($handle = fopen("system/cache/inkspot.dat", "w")) {
				fwrite($handle, pk($spotSubjects));
				fclose($handle);
			}
		}
		
		else {
			$subjectsReplacementArray[] = array(
				"subject.title" => $subject["TITLE"],
				"subject.id" => $subject["ID"],
				"subject.locked" => $subject["LOCKED"],
				"subject.topic_count" => $subject["TOPIC_COUNT"],
				"subject.post_count" => $subject["POST_COUNT"],
				"subject.allow" => $subject["TYPES"]
			);
			
			$subjectsCount ++;
		}		
	}
	$tpl -> Loop("subjectsList", $subjectsReplacementArray);
	$tpl -> AssignArray(array("dbCount.total" => $subjectsCount));
	
	
	// ASSIGN THE USERS LEVELS TO THE DROPDOWN MENU //////////////////////////////
	$heritage = unpk(file_get_contents($CONF["HERITAGE_INFOFILE"]));
	if (!is_array($heritage)) $heritage = array();
	
	$heritage["u"]["NAME"] = "Users";
	$heritage["g"]["NAME"] = "Guests";
	
	$heritage = array_reverse($heritage, 1);

	foreach ($heritage as $heritageKey => $heritageArray) {
		$heritageReplacementArray[] = array(
			"class.id" => $heritageKey,
			"class.name" => $heritageArray["NAME"]
		);
	}
	$tpl -> Loop("usersClasses", $heritageReplacementArray);
	
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