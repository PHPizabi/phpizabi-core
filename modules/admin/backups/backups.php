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
	$tpl -> Load("backups");

	// HANDLE THE DELETE REQUEST //////////////////////////////////////////////////
	if (isset($_GET["rm"]) && is_file("system/cache/backups/{$_GET["rm"]}") && !strstr($_GET["rm"], "..")) {
		unlink("system/cache/backups/{$_GET["rm"]}");
	}
	
	// HANDLE THE GET REQUEST /////////////////////////////////////////////////////
	if (isset($_GET["get"])) {
		$newFile = uniqid(rand(0,9999),1).$_GET["get"];
		copy("system/cache/backups/{$_GET["get"]}", "system/cache/temp/{$newFile}");
		_fnc("reload", 0, "modules/admin/backups/get.php?file={$newFile}");
	}
	
	// LIST THE FILES IN THE BACKUPS DIRECTORY ///////////////////////////////////////
	$totalFiles = 0;
	$totalSize = 0;	
	
	if ($handle = opendir("system/cache/backups/")) {
		while (false !== ($file = readdir($handle))) {

			if ($file != ".." && $file != "." && $file != ".htaccess") {
				
				$totalFiles ++;
				$totalSize += filesize("system/cache/backups/{$file}");
			
				$backups[] = array(
					"backup.file" => $file,
					"backup.date" => date($CONF["LOCALE_LONG_DATE"], filemtime("system/cache/backups/{$file}")),
					"backup.size" => round(filesize("system/cache/backups/{$file}")/1024, 2)
				);
			}
		}
	}
	
	if (isset($backups)) {
		$tpl -> Loop("backupList", $backups);
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