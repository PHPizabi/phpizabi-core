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
	$tpl -> Load("questionaire");
	$tpl -> GetObjects();
	
	
	/* Handle the posted questionaire */
	if (isset($_POST["Submit"])) {
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
		myQ("UPDATE `[x]users` SET `profile_data` = '".serialize($data)."' WHERE `id`='{$_SESSION["REG_ID"]}'");

		session_unregister("REG_ID");

		$tpl -> AssignArray(array("content"=>NULL));
		$tpl -> Zone("completed", "enabled");
		_fnc("reload", 5, "?L");
	}
	
	$tplRep = NULL;
	
	// OPEN THE REGISTRATION BINDINGS DATAFILE ///////////////////////////////////
	if (!is_array($bindings = unpk(file_get_contents("system/cache/reg_bindings.dat")))) {
		
		$tpl -> AssignArray(array("content"=>NULL));
		$tpl -> Zone("completed", "enabled");
		_fnc("reload", 5, "?L");
	
	} 
	
	else {
		
		/* cycle through questionaires */ 
		foreach ($bindings as $file) {
					
			/* Load the questionaire data */
			$questionaireTitle = base64_decode(str_replace(".dat", "", $file));
			$tplRep .= str_replace("{title}", $questionaireTitle, $GLOBALS["OBJ"]["header"]);
	
			$q = unpk(file_get_contents("system/cache/questionnaires/{$file}"));
			
			/* Loop in questions */
			foreach ($q as $key => $val) {
				$printThis = true;
				
				/* Load the appropriate field type for that question */
				$t = new template;
				$t -> LoadThis(isset($val["field"], $GLOBALS["OBJ"]["q_".$val["field"]])?$GLOBALS["OBJ"]["q_".$val["field"]]:NULL);
				$t -> AssignArray(
					array(
						"question_code"=>base64_encode($questionaireTitle."|".(isset($val["question"])?$val["question"]:NULL)),
						"question"=>(isset($val["question"])?$val["question"]:NULL),
						"default"=>(isset($val["default"])?$val["default"]:NULL), 
						"charwidth"=>(isset($val["charwidth"])?$val["charwidth"]:NULL), 
						"lines"=>(isset($val["lines"])?$val["lines"]:NULL), 
						"maxlen"=>(isset($val["maxlen"])?$val["maxlen"]:NULL)
					)
				);
				/* For each multiselect option, pass a loop so each value is multiplicated */
				if (isset($val["field"]) && ($val["field"] == "dropdown" || $val["field"] == "radiobuttons" || $val["field"] == "checkboxes")) {
					if (strstr($val["options"], "|")) {
						foreach ($values = explode("|", $val["options"]) as $key => $answer) {
							if (str_replace("\n", "", str_replace("\r", "", $answer)) != "") {
								$loopingArray[$key]["value"] = stripslashes($answer);
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
		$tpl -> AssignArray(array("content"=>$tplRep));
	}
	
	$tpl -> CleanZones();
	$tpl -> Flush();
	
?>