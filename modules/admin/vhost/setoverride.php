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
	
	// LOAD VHOST DATA /////////////////////////////////////////////////////
	$vhostArray = unpk(file_get_contents($CONF["VIRTUAL_HOSTS_INFOFILE"]));
	if (!is_array($vhostArray)) $vhostArray = array();
	
	// HANDLE VHOST OVERRIDE INJECTION ///////////////////////////////////////
	if (isset($_POST["Submit"])) {
		$vhostArray[$_GET["id"]][$_POST["entity"]] = $_POST["value"];
		
		if ($handle = fopen($CONF["VIRTUAL_HOSTS_INFOFILE"], "w")) {
			fwrite($handle, pk($vhostArray));
			fclose($handle);
		}
	}
	
	// HANDLE VHOST OVERRIDE REMOVAL ////////////////////////////////////////
	if (isset($_GET["rm"])) {
		unset($vhostArray[$_GET["id"]][$_GET["rm"]]);
		
		if ($handle = fopen($CONF["VIRTUAL_HOSTS_INFOFILE"], "w")) {
			fwrite($handle, pk($vhostArray));
			fclose($handle);
		}
		_fnc("reload", 0, "?L=admin.vhost.setoverride&id={$_GET["id"]}");
	}

	// ASSIGN ARRAY ////////////////////////////////////////////////////////////
	$tpl -> AssignArray(array(
		"vhost.name" => $_GET["id"]
	));
	
	foreach ($vhostArray[$_GET["id"]] as $overrideKey => $overrideVal) {
		$vhostKeys[] = array(
			"override.var" => $overrideKey,
			"override.val" => substr($overrideVal, 0, 50),
			"override.conf" => substr((string)$CONF[$overrideKey], 0, 50),
			"override.id" => $overrideKey,
			"override.vhost" => $_GET["id"]
		);
	}
	if (isset($vhostKeys)) $tpl -> Loop("vhostOverrideList", $vhostKeys);
	
	
	/*
		Loop all the configuration items to form the drop down list
	*/
	foreach ($CONF as $configVar => $configVal) {
		if (!in_array($configVar, array_keys($vhostArray[$_GET["id"]]))) {
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