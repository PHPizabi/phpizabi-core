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
	$tpl -> Load("bindings");
	$tpl -> GetObjects();
	

	// HANDLE POST ///////////////////////////////////////////////////////////////
	if (isset($_POST["Submit"])) {
		if ($handle = fopen("system/cache/reg_bindings.dat", "w")) {
			fwrite($handle, pk((isset($_POST["ck"])?$_POST["ck"]:false)));
			fclose($handle);
		}
	}
	
	// HANDLE DELETE ///////////////////////////////////////////////////////////////
	if (isset($_GET["rm"]) && is_file("system/cache/questionnaires/{$_GET["rm"]}")) {
		unlink("system/cache/questionnaires/{$_GET["rm"]}");
	}		

	// OPEN THE REGISTRATION BINDINGS DATAFILE ///////////////////////////////////
	if (!is_array($bindings = unpk(file_get_contents("system/cache/reg_bindings.dat")))) $bindings = array();
	
	// READ THE QUESTIONNAIRES DIRECTORY /////////////////////////////////////////	
	if (is_dir("system/cache/questionnaires") && $handle = opendir("system/cache/questionnaires")) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && substr($file, strlen($file)-4) == ".dat") {
				$questionnairesList[] = array(
					"q.name" => base64_decode(substr($file, 0, strlen($file)-4)),
					"q.file" => $file,
					"q.size" => round(filesize("system/cache/questionnaires/{$file}") / 1024, 2),
					"q.check" => (in_array($file, $bindings) ? "checked=\"checked\"" : NULL),
				);
			}
		}
	}
	
	if (isset($questionnairesList)) {
		
		$tpl -> Loop("questionnaires", $questionnairesList);
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