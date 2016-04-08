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

///////////////////////////////////////////////////////////////////////////////////////
//                                                                                   //
// QID FIX Provided by OpenDoor -- Thank you ;)                                      //
//                                                                                   //
///////////////////////////////////////////////////////////////////////////////////////

	/* Check Structure Availability */
	if (!defined("CORE_STRAP")) die("Out of structure call");
	/* Administrative restriction */
	(!me('is_administrator')&&!me('is_superadministrator')?die("Access restricted"):NULL);

	$tpl = new template;
	$tpl -> Load("new");

	// IT RESET SESSION VARIABLES ON LOAD ////////////////////////////////////////////
	
	if (isset($_GET["reset"])) {
		if (isset($_SESSION["Q"])) session_unregister("Q");
		if (isset($_SESSION["QID"])) session_unregister("QID");
		if (isset($_SESSION["QNAME"])) session_unregister("QNAME");
		
		_fnc("reload", 0, "?L=admin.questionnaires.new");	
	
	}
	
	// IT RESET SESSION VARIABLES ON LOAD ///////////////////////////////////// END //
	
	if (isset($_POST["reset"])) {
		if (isset($_SESSION["Q"])) session_unregister("Q");
		if (isset($_SESSION["QID"])) session_unregister("QID");
		if (isset($_SESSION["QNAME"])) session_unregister("QNAME");
	}
	
	$tpl = new template;
	$tpl -> Load("new");

	/* Process replace array values */
	if (isset($_SESSION["Q"])) {
		$ret = "<table><td>Question</td><td>Type</td></tr>";
		foreach ($_SESSION["Q"] as $key => $array) {
			$ret .= "<tr><td>{$array["question"]}</td><td>{$array["field"]}</td></tr>";
		}
		$ret .= "</table>";
	}
	$replace["qlist"] = (isset($ret)?$ret:NULL);
	
	$replace["questionaire"] = (isset($_SESSION["QNAME"])?$_SESSION["QNAME"]:NULL);
	$replace["question"] = (isset($_POST["question"])?$_POST["question"]:NULL);
	$replace["fieldtype"] = (isset($_POST["fieldtype"])?$_POST["fieldtype"]:NULL);
	
	$tpl -> AssignArray($replace);
	/* -- End -- */

	
	if (!isset($_SESSION["QNAME"])) {
		/* No questionaire name has been specified, means we're at the beginning of the creation process. */
		if (!isset($_POST["Submit"])) {
			$tpl -> Zone("action", "create");
			$tpl -> Zone("step", "namequestionaire");
			
		} elseif (trim($_POST["name"]) != "") {
			$_SESSION["QNAME"] = trim($_POST["name"]);
			$tpl -> Zone("action", "addquestion");
			$tpl -> Zone("step", "addquestion");
		}
	} else {
	
		if (isset($_POST["addquestion"])) {
			$tpl -> Zone("action", "addquestion");
			$tpl -> Zone("step", "addquestion");
		}
	
		// QuestionaireName is set. //
		if (isset($_POST["SubmitQuestion"])) {
			// a question has been submitted //
			
			$idq = $_SESSION["QID"] = (isset($_SESSION["Q"])?count($_SESSION["Q"]):0); //Changed $id to $idq
			
			$_SESSION["Q"][$idq]["question"] = trim($_POST["question"]); //Changed $id to $idq
			$_SESSION["Q"][$idq]["field"] = $_POST["fieldtype"]; //Changed $id to $idq
			$tpl -> Zone("action", "set_question_extras");
			$tpl -> Zone("step", "setquestion");
			
			if ($_POST["fieldtype"] == "textfield") {
				$tpl -> Zone("fieldopts", "textfield");
			} elseif ($_POST["fieldtype"] == "textarea") {
				$tpl -> Zone("fieldopts", "textarea");
			} else {
				$tpl -> Zone("fieldopts", "populated");
			}
		}
		
		if (isset($_POST["SubmitFieldOpts"])) {
			$idq = $_SESSION["QID"]; //Changed $id to $idq
			session_unregister("QID");
			
			$_SESSION["Q"][$idq]["default"] = (isset($_POST["default"])?$_POST["default"]:NULL); //Changed $id to $idq
			$_SESSION["Q"][$idq]["charwidth"] = (isset($_POST["charwidth"])?$_POST["charwidth"]:NULL); //Changed $id to $idq
			$_SESSION["Q"][$idq]["lines"] = (isset($_POST["lines"])?$_POST["lines"]:NULL); //Changed $id to $idq
			$_SESSION["Q"][$idq]["maxlen"] = (isset($_POST["maxlen"])?$_POST["maxlen"]:NULL); //Changed $id to $idq
			$_SESSION["Q"][$idq]["options"] = (isset($_POST["options"])?str_replace("\n", "|", $_POST["options"]):NULL); //Changed $id to $idq
			
			$tpl -> Zone("step", "showquestionaire");
			$tpl -> Zone("action", "showquestionaire");
		}
		
		if (isset($_POST["SubmitSave"])) {
			
			$tpl -> Zone("step", "savequestionaire");
			$tpl -> Zone("action", "savequestionaire");
			
			if ($handle = @fopen("system/cache/questionnaires/".base64_encode($_SESSION["QNAME"]).".dat", "w")) {

	// IT MAKE POSSIBLE EDIT QUESTIONNAIRES //////////////////////////////////////////

				fwrite($handle, serialize($_SESSION["Q"]));
				
	// IT MAKE POSSIBLE EDIT QUESTIONNAIRES /////////////////////////////////// END //
				
				fclose($handle);
				$tpl -> Zone("save", "success");			
			} else {
				$tpl -> Zone("save", "failed");
			}
		}
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