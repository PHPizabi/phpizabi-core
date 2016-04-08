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
	$tpl -> Load("cms");
	
	// HANDLE THE REMOVE REQUEST //////////////////////////////////////////////
	if (isset($_GET["rm"]) && is_file("modules/cms/{$_GET["rm"]}.php")) {
		unlink("modules/cms/{$_GET["rm"]}.php");
	}
	
	// GET A LIST OF ALL THE CMS PAGES ////////////////////////////////////////
	$totalCMS = 0;
	
	if ($handle  = opendir("modules/cms")) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && substr($file, strlen($file)-4) == ".php") {
				$cmsList[] = array(
					"cms.file" => substr($file, 0, strlen($file)-4),
					"cms.size" => round(filesize("modules/cms/{$file}") / 1024, 2),
					"cms.lastmod" => date($CONF["LOCALE_HEADER_DATE_TIME"], filemtime("modules/cms/{$file}"))
				);
				$totalCMS ++;
			}
		}
	}
	
	if (isset($cmsList)) {
		$tpl -> Loop("cmsList", $cmsList);
	}
	$tpl -> AssignArray(array("cmsCount.total" => $totalCMS));

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