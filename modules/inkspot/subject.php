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
	
	// TEMPLATE HANDLING ////////////////////////////////////////////////////////////////// FINAL //
	/*
		Initialize the template engine and
		load the template file. Get objects,
		convert self user.
	*/
	$tpl = new template;
	$tpl -> Load("subject");

	if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
		
		/*
			Load the inkspot subjects array
		*/
		$inkSpotSubjects = unpk(file_get_contents("system/cache/inkspot.dat"));
		if (!is_array($inkSpotSubjects)) $inkSpotSubjects = array();
		
		/*
			Cycle in the subjects and find the right array for the actual ID
		*/
		foreach ($inkSpotSubjects as $inkSpotArray) {
			
			if ($inkSpotArray["ID"] == $_GET["id"]) {
				$subjectArray = $inkSpotArray;
				break;
			}
		}
		
		$select = myQ("
			SELECT *, COUNT(`topic`) AS `count`
			FROM `[x]inkspot`
			WHERE `subject` = '{$subjectArray["ID"]}'
			GROUP BY `topic`
			ORDER BY `date` ASC
		");
		
		while ($row = myF($select)) {
			
			$topicsReplacementArray[] = array(
				"topic.title" => $row["topic"],
				"topic.id" => $row["id"],
				"topic.userID" => $row["origin_user"],
				"topic.mainpicture" => _fnc("user", $row["origin_user"], "mainpicture"),
				"topic.replies" => $row["count"] -1,
				"topic.views" => $row["view_count"],
				"topic.lastPostUsername" => _fnc("user", $row["user"], "username")
			);
			
		}
		
		if (isset($topicsReplacementArray)) $tpl -> Loop("topicsInSubject", $topicsReplacementArray);
		
		//$s[0]["TITLE"] = "This is a subject";
		//$s[0]["ID"] = "1212121121121121";
		//$s[0]["LOCKED"] = false;
		//$s[0]["TOPIC_COUNT"] = 1;
		//$s[0]["POST_COUNT"] = 5;
		//$s[0]["TYPES"] = "g,u";
	
		$tpl -> AssignArray(array(
			"subject.id" => $inkSpotArray["ID"],
			"subject.title" => $inkSpotArray["TITLE"]
		));

	}

	
	else die("No subject ID provided. Can not act");
	
	
	$tpl -> Flush();
?>