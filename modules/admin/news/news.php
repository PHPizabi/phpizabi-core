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
	$tpl -> Load("news");
	$tpl -> GetObjects();
	
	// GET NEWS DATA ///////////////////////////////////////////////////////
	$newsArray = unpk(file_get_contents("system/cache/news.dat"));
	if (!is_array($newsArray)) $newsArray = array();

	$tpl -> AssignArray(array(
		"dbCount.total" => count($newsArray)
	));
	
	// ASSIGN NEWS TO LOOP /////////////////////////////////////////////////
	foreach ($newsArray as $key => $article) {
	
		// HANDLE REMOVE REQUEST ///////////////////////////////////////////
		if (isset($_GET["rm"]) && $_GET["rm"] == $article["date"]) {
			
			unset($newsArray[$key]);
			
			if ($handle = fopen("system/cache/news.dat", "w")) {
				fwrite($handle, pk($newsArray));
				fclose($handle);
			}
		} 
		
		else {
	
			$newsReplacementArray[] = array(
				"news.id" => $key,
				"news.title" => $article["title"],
				"news.date" => date($CONF["LOCALE_HEADER_DATE_TIME"], $article["date"]),
				"news.show" => implode(", ", $article["access"]),
				"news.key" => $article["date"]
			);
			
		}		
	}
	
	if (isset($newsReplacementArray)) $tpl -> Loop("newsList", $newsReplacementArray);
	
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