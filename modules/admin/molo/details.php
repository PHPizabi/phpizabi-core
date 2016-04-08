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
	$tpl -> Load("details");
	$tpl -> GetObjects();

	/*
		Get the MoLo object <info ...> data
	*/
	$moloBuffer = file_get_contents($_GET["f"]);
	if (preg_match('/<info ([A-Z0-9+&@#\/%=~_|!:,.;\/ "]*)>/si',  $moloBuffer, $moloMatch)) {
			
		/*
			The molo "info" is now stored in $mooloMatch[1]... we will now get 
			each individual element of it and split that into another array
		*/
		preg_match_all('/([A-Z0-9]*) ?= ?"(.*?)"/si', $moloMatch[1], $moloInfo, PREG_SET_ORDER);
			
		foreach ($moloInfo as $key => $moloArray) {

			switch($moloInfo[$key][1]) {
				case("name"):		$molo["molo.name"] =		$moloInfo[$key][2]; break;
				case("version"):	$molo["molo.version"] =		$moloInfo[$key][2]; break;
				case("author"):		$molo["molo.author"] =		$moloInfo[$key][2]; break;
				case("support"):	$molo["molo.support"] =		$moloInfo[$key][2]; break;
				case("url"):		$molo["molo.url"] = 		$moloInfo[$key][2]; break;
				case("body"):		$molo["molo.body"] =		$moloInfo[$key][2]; break;
			}
		}
		$molo["molo.id"] = md5($molo["molo.name"].$molo["molo.version"]);
		$molo["molo.file"] = $_GET["f"];

		/*
			Is this module installed?
		*/
		if (!is_array($iMoLoArray = unpk(file_get_contents("system/cache/molo.dat")))) $iMoLoArray = array();
		
		if (_fnc("in_multiarray", $iMoLoArray, md5($molo["molo.name"].$molo["molo.version"]))) {
			$molo["molo.status"] = $GLOBALS["OBJ"]["installed"];
		} else $molo["molo.status"] = $GLOBALS["OBJ"]["not_installed"];
		
		/*
			Detect MoLo Methods - Does the MoLo handles INSTALL, UNINSTALL, UPDATE ?
		*/
		if (preg_match('/<install>(.*)<\/install>/si', $moloBuffer, $matches)) {
			$supportReplace["support.install"] = $GLOBALS["OBJ"]["yes"];
			$supportReplace["molobat.install"] = $matches[1];
			unset($matches);
		} 
		else {
			$supportReplace["support.install"] = $GLOBALS["OBJ"]["no"];
			$supportReplace["molobat.install"] = NULL;
		}
		
		if (preg_match('/<uninstall>(.*)<\/uninstall>/si', $moloBuffer, $matches)) {
			$supportReplace["support.uninstall"] = $GLOBALS["OBJ"]["yes"];
			$supportReplace["molobat.uninstall"] = $matches[1];
		} 
		else {
			$supportReplace["support.uninstall"] = $GLOBALS["OBJ"]["no"];
			$supportReplace["molobat.uninstall"] = NULL;
		}
		
		if (preg_match('/<update>(.*)<\/update>/si', $moloBuffer, $matches)) {
			$supportReplace["support.update"] = $GLOBALS["OBJ"]["yes"];
			$supportReplace["molobat.update"] = $matches[1];
		} 
		else {
			$supportReplace["support.update"] = $GLOBALS["OBJ"]["no"];
			$supportReplace["molobat.update"] = NULL;
		}
		
		$tpl -> AssignArray($supportReplace);
				
		
	}

	$tpl -> AssignArray($molo);

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