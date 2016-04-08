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
	$tpl -> Load("logs");

	// HANDLE THE DELETE REQUEST //////////////////////////////////////////////////
	if (isset($_GET["rm"]) && is_file("system/cache/logs/{$_GET["rm"]}.log") && !strstr($_GET["rm"], "..")) {
		unlink("system/cache/logs/{$_GET["rm"]}.log");
	}
	
	// LIST THE FILES IN THE LOGS DIRECTORY ///////////////////////////////////////
	$totalFiles = 0;
	$totalSize = 0;	
	
	if ($handle = opendir("system/cache/logs/")) {
		while (false !== ($fileName = readdir($handle))) {

			$file = explode(".", $fileName, 2);

			if ($file[1] == "log" && is_numeric($file[0])) {
			
				$totalFiles ++;
				$totalSize += filesize("system/cache/logs/{$fileName}");
			
				$logs[] = array(
					"log.date" => date($CONF["LOCALE_LONG_DATE"], $file[0]),
					"log.datestamp" => $file[0],
					"log.size" => round(filesize("system/cache/logs/{$fileName}")/1048576, 2)
				);
			}
		}
	}
	
	if (isset($logs)) {
		$tpl -> Loop("logsList", $logs);
	}
	
	/* Assign the stats */
	$tpl -> AssignArray(array(
		"stats.totalFiles" => $totalFiles,
		"stats.totalSize" => round($totalSize / 1048576, 2)
	));

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