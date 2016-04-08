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
	$tpl -> Load("errorpages");
	
	
	// HANDLE REMOVE REQUEST ////////////////////////////////////////////////
	if (isset($_GET["rm"]) && is_file("theme/templates/GLOBALS/errors/{$_GET["rm"]}.tpl")) {
		unlink("theme/templates/GLOBALS/errors/{$_GET["rm"]}.tpl");
	}

	// GET A LIST OF ALL THE ERROR PAGES ////////////////////////////////////
	$totalErrors = 0;
	
	if ($handle  = opendir("theme/templates/GLOBALS/errors/")) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && substr($file, strlen($file)-4) == ".tpl") {
				$tplList[] = array(
					"error.file" => substr($file, 0, strlen($file)-4),
					"error.size" => round(filesize("theme/templates/GLOBALS/errors/{$file}") / 1024, 2)
				);
				$totalErrors ++;
			}
		}
	}
	if (isset($tplList)) $tpl -> Loop("errorPagesList", $tplList);
	$tpl -> AssignArray(array("errorCount.total" => $totalErrors));
	
	// WRITE LOCK TEST ///////////////////////////////////////////////////////
	if (!is_writable("theme/templates/GLOBALS/errors")) {
		$tpl -> Zone("error", "writeLock");
	}
	
	// GET ALL THE POSSIBLE "L" CALLS ///////////////////////////////////////
	foreach (readTree("modules") as $lCall) {
		$modulesReplace[] = array(
			"module" => $lCall
		);
	}
	$tpl -> Loop("modulesDropDown", $modulesReplace);
	
	
	
	// The readtree function ////////////////////////////////////////////////
	function readTree($dir) {
		$handle  = opendir($dir);
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (is_dir($dir."/".$file)) {
					$tree = array_merge((isset($tree)?$tree:array()), readTree($dir."/".$file));
				}
				else if (substr($file, strlen($file)-4) == ".php") {
					$fileName =  str_replace("/", ".", str_replace(".php", "", $dir."/".$file));
					$tree[] = str_replace("modules.", "", $fileName);
				}
			}
		}
		return (isset($tree)?$tree:array());
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