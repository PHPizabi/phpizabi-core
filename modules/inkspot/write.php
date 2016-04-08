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
	$tpl -> Load("write");
	

	/*
		Load the inkspot subjects array
	*/
	$inkSpotSubjects = unpk(file_get_contents("system/cache/inkspot.dat"));
	if (!is_array($inkSpotSubjects)) $inkSpotSubjects = array();
	
	
	$subjectID = (isset($_POST["subject"])?$_POST["subject"]:(isset($_GET["subject"])?$_GET["subject"]:NULL));
		
	/*
		Cycle in the subjects and find the right array for the actual ID
	*/
	foreach ($inkSpotSubjects as $inkSpotArray) {
		
		$subjectsReplacementArray[] = array(
			"subject.id" => $inkSpotArray["ID"],
			"subject.title" => $inkSpotArray["TITLE"],
			"subject.select" => ($inkSpotArray["ID"] == $subjectID?"selected=\"selected\"":NULL)
		);
		
		if ($inkSpotArray["ID"] == $subjectID) $subjectArray = $inkSpotArray;
	}
	
	if (isset($subjectsReplacementArray)) $tpl -> Loop("subjectsLoop", $subjectsReplacementArray);
	
	// HANDLE POST ///////////////////////////////////////////////////////////////////
	if (isset($_POST["Submit"]) && isset($_POST["body"]) && isset($_POST["title"]) && isset($_POST["subject"])) {
			
		/*
			Avoid blank data
		*/
		if ($_POST["body"] != "" && $_POST["title"] != "" && $_POST["subject"] != "") {

			/*
				Make sure the subject exist
			*/
			if (isset($subjectArray["ID"])) {
						
				/* 
					Only admins can post on a locked subject
				*/
				if (
					($subjectArray["LOCKED"] && 
						(me("is_administrator") || me("is_superadministrator"))
					) || (!$subjectArray["LOCKED"])
				) {
					
					/*
						Control the post allow array
					*/
					$allowList = explode(",", $subjectArray["TYPES"]);
					if (
							
						(!isset($_SESSION["id"]) && in_array("g", $allowList))
						||
						(isset($_SESSION["id"]) && in_array("u", $allowList))
						||
						(in_array(me("account_type"), $allowList))
						||
						(me("is_administrator") || me("is_superadministrator"))
					) {
						
						/*
							make sure the thread title is unique in this subject
						*/
						$select = myQ("
							SELECT *
							FROM `[x]inkspot`
							WHERE `subject`='{$_POST["subject"]}'
							AND `topic`='{$_POST["title"]}'
							LIMIT 1
						");
						
						if (myNum($select) == 0) {
								
							/*
								Okay, everything is safe, we will save!
							*/
							myQ("
								INSERT INTO `[x]inkspot`
								(`subject`,`topic`,`user`,`origin`,`origin_user`,`body`,`date`,`read_array`)
								VALUES
								(
									'{$_POST["subject"]}',
									'{$_POST["title"]}',
									'".me("id")."',
									'1',
									'".me("id")."',
									'{$_POST["body"]}',
									'".date("U")."',
									'".pk(array(me("id")))."'
								)
							");
							
							$tpl -> AssignArray(array(
								"post.id" => mysql_insert_id(),
								"post.subject" => $_POST["subject"]
							));
							
							$tpl -> Zone("header", "success");
							
							_fnc("reload", 5, "?L=inkspot.topic&id=".mysql_insert_id());
							
						}
						
						else $tpl -> Zone("header", "cloneThread");
					}
					
					else $tpl -> Zone("header", "notAllowed");
				}
				
				else $tpl -> Zone("header", "subjectLocked");
			}
			
			else $tpl -> Zone("header", "noSubject");
		}
		
		else $tpl -> Zone("header", "blankField");
	}
	
	else $tpl -> Zone("header", "enabled");
	
	$tpl -> AssignArray(array(
		"subject.title" => (isset($inkSpotArray)?$inkSpotArray["TITLE"]:NULL),
		"get.title" => (isset($_GET["topic"])?$_GET["topic"]:NULL),
	));
	
	
	$tpl -> Flush();
?>