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
	$tpl -> Load("fill");
	$tpl -> GetObjects();
	
	
	/* Handle the posted questionaire */
	if (isset($_POST["Submit"])) {
		$data = unpk(me("profile_data"));
		
		$i=0;
		foreach ($_POST as $qstrip => $answer) {
			$qstrip = base64_decode($qstrip);
			if (strstr($qstrip, "|") && $answer != "") {
				$q = explode("|", $qstrip);
				if ($q[0] != "" && $q[1] != "") {
					$data[$q[0]][$q[1]] = (!is_array($answer)?$answer:implode(", ", $answer));
					$i++;
				}
			}
		}
		myQ("UPDATE `[x]users` SET `profile_data` = '".serialize($data)."' WHERE `id`='".me('id')."'");
		$tpl -> Zone("main", "saved");
		_fnc("reload", 3, "?L=users.myself");

	} else {
	
		/* Load the questionaire data */
		$questionaireTitle = base64_decode($_GET["id"]);
		$tplRep = str_replace("{title}", $questionaireTitle, $GLOBALS["OBJ"]["header"]);
	
		$q = unpk(file_get_contents("system/cache/questionnaires/{$_GET["id"]}.dat"));
		
		/* Loop in questions */
		foreach ($q as $key => $val) {
			
			if (isset($val["question"]) && $val["question"] != "" && isset($val["field"]) && $val["field"] != "") {
				
				$printThis = true;
					
				/* Load the appropriate field type for that question */
				$t = new template;
				$t -> LoadThis($GLOBALS["OBJ"]["q_".$val["field"]]);
				$t -> AssignArray(
					array(
						"question_code"=>base64_encode($questionaireTitle."|".$val["question"]),
						"question"=>$val["question"],
						"default"=>$val["default"], 
						"charwidth"=>$val["charwidth"], 
						"lines"=>$val["lines"], 
						"maxlen"=>$val["maxlen"]
					)
				);
				/* For each multiselect option, pass a loop so each value is multiplicated */
				if ($val["field"] == "dropdown" || $val["field"] == "radiobuttons" || $val["field"] == "checkboxes") {
					if (strstr($val["options"], "|")) {
						foreach ($values = explode("|", $val["options"]) as $key => $answer) {
							if (str_replace("\n", "", str_replace("\r", "", $answer)) != "") {
								$loopingArray[$key]["value"] = $answer;	
							}
						}
					} elseif ($val["options"] != "") {
						$loopingArray[0]["value"] = $val["options"];
					}
					
					if (isset($loopingArray)) {
						$t -> Loop("options", $loopingArray);
						unset($loopingArray);
					} else {
						$printThis = false;
					}
				}
					
				if ($printThis) {
					$tplRep .= $t -> Flush(1);
				}
			}
		}
	
		$tplRep .= $GLOBALS["OBJ"]["end"];
		
		$tpl -> Zone("main", "questionaire");
		$tpl -> AssignArray(array("content"=>$tplRep));
	}
	
	
	$tpl -> Flush();
	
?>