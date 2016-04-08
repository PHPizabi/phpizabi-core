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
	$tpl -> Load("setoverride");
	
	// LOAD HERITAGE DATA /////////////////////////////////////////////////////
	$heritageArray = unpk(file_get_contents($CONF["HERITAGE_INFOFILE"]));
	if (!is_array($heritageArray)) $heritageArray = array();
	
	// HANDLE HERITAGE OVERRIDE INJECTION ///////////////////////////////////////
	if (isset($_POST["Submit"])) {
		$heritageArray[$_GET["id"]]["CONF"][$_POST["entity"]] = $_POST["value"];
		
		if ($handle = fopen($CONF["HERITAGE_INFOFILE"], "w")) {
			fwrite($handle, pk($heritageArray));
			fclose($handle);
		}
	}
	
	// HANDLE HERITAGE OVERRIDE REMOVAL ////////////////////////////////////////
	if (isset($_GET["rm"])) {
		unset($heritageArray[$_GET["id"]]["CONF"][$_GET["rm"]]);
		
		if ($handle = fopen($CONF["HERITAGE_INFOFILE"], "w")) {
			fwrite($handle, pk($heritageArray));
			fclose($handle);
		}
		_fnc("reload", 0, "?L=admin.heritage.setoverride&id={$_GET["id"]}");
	}



	// ASSIGN ARRAY ////////////////////////////////////////////////////////////
	$tpl -> AssignArray(array(
		"heritage.name" => $heritageArray[$_GET["id"]]["NAME"]
	));
	
	foreach ($heritageArray[$_GET["id"]]["CONF"] as $overrideKey => $overrideVal) {
		$heritageKeys[] = array(
			"override.var" => $overrideKey,
			"override.val" => substr($overrideVal, 0, 50),
			"override.conf" => substr((string)$CONF[$overrideKey], 0, 50),
			"override.id" => $overrideKey,
			"override.heritage" => $_GET["id"]
		);
	}
	if (isset($heritageKeys)) $tpl -> Loop("heritageOverrideList", $heritageKeys);
	
	
	/*
		Loop all the configuration items to form the drop down list
	*/
	foreach ($CONF as $configVar => $configVal) {
		if (!in_array($configVar, array_keys($heritageArray[$_GET["id"]]["CONF"]))) {
			$configReplaceArray[] = array(
				"var" => $configVar
			);
		}
	}
	
	$tpl -> Loop("configDropDownOptions", $configReplaceArray);


	
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