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
	$tpl -> Load("picturescache");

	// LIST THE CACHE FILES //////////////////////////////////////////////
	$totalFiles = 0;
	
	if ($handle = opendir($CONF["IMAGE_DEFAULT_DIRECTORY"])) {
		while (false !== ($fileName = readdir($handle))) {

			if (strstr($fileName, "CACHE_")) {
			
				// HANDLE THE REMOVE AND FLUSH REQUESTS ///////////////////////////////
				if ((isset($_GET["rm"]) and $_GET["rm"] == $fileName) or isset($_GET["flush"])) {
					unlink($CONF["IMAGE_DEFAULT_DIRECTORY"]."/".$fileName);
				}
				
				else {
			
					$totalFiles ++;
					
					$pictures[] = array(
						"cache.id" => $fileName,
						"cache.size" => round(filesize($CONF["IMAGE_DEFAULT_DIRECTORY"]."/".$fileName)/1024, 2),
						"cache.date" => date($CONF["LOCALE_LONG_DATE"], filemtime($CONF["IMAGE_DEFAULT_DIRECTORY"]."/".$fileName))
					);
				}
			}
		}
	}
	
	if (isset($pictures)) {
		$tpl -> Loop("picturesList", $pictures);
	}
	
	/* Assign the stats */
	$tpl -> AssignArray(array(
		"stats.totalFiles" => $totalFiles,
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