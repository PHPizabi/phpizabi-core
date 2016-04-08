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
	$tpl -> Load("create");
	
	// GET NEWS DATA ///////////////////////////////////////////////////////
	$newsArray = unpk(file_get_contents("system/cache/news.dat"));
	if (!is_array($newsArray)) $newsArray = array();


	// ASSIGN USERS LEVELS //////////////////////////////////////////////////
	$heritage = unpk(file_get_contents($CONF["HERITAGE_INFOFILE"]));
	if (!is_array($heritage)) $heritage = array();
	
	foreach ($heritage as $key => $levelArray) {
	
		$levelsReplacementArray[] = array(
			"level.id" => $key,
			"level.title" => $levelArray["NAME"]
		);
	}
	
	if (isset($levelsReplacementArray)) {
		$tpl -> Zone("usersLevels", "enabled");
		$tpl -> Loop("usersLevels", $levelsReplacementArray);
	}
	
	// HANDLE POST DATA /////////////////////////////////////////////////////
	if (isset($_POST["Submit"], $_POST["title"], $_POST["body"])) {
		
		$newsArray[] = array(
			"title" => $_POST["title"],
			"date" => date("U"),
			"body" => $_POST["body"],
			"access" => (isset($_POST["show"]) ? $_POST["show"] : array())
		);
		
		if ($handle = fopen("system/cache/news.dat", "w")) {
			fwrite($handle, pk($newsArray));
			fclose($handle);
			$tpl -> Zone("save", "success");
			_fnc("reload", 3, "?L=admin.news.news");
		}
		
		else $tpl -> Zone("save", "error");
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