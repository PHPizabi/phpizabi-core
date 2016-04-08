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
	$tpl -> Load("login");
	

	// Handle submit order ///////////////////////////////////////////////////////////
	if (isset($_POST["Submit"])) {
		$saveList = array(
			"SESSION_CACHE_EXPIRE",
			"SESSION_CACHE_LIMITER",
			"SESSION_NAME",
			"SESSION_SAVE_PATH",
			"LOGIN_SIGNAL_TRIGGER",
			"LOGIN_REQUIRE_ACTIVE",
			"LOGIN_ROUTE_TO",
			"LOGIN_FIRST_ROUTE_TO",
			"LOGIN_FAILED_ERROR_MESSAGE",
			"LOGIN_BRUTEFORCE_PROTECT:ENABLE",
			"LOGIN_BRUTEFORCE_FAILCOUNT",
			"LOGIN_BRUTEFORCE_DISABLE_DURATION",
			"LOGIN_BRUTEFORCE_SHOWERROR",
			"LOGIN_BRUTEFORCE_ERROR_MESSAGE",
			"LOGIN_REMEMBERME_ENABLED",
			"LOGIN_REMEMBERME_COOKIENAME",
			"LOGIN_REMEMBERME_SHOWOPTION",
			"LOGIN_REMEMBERME_TIMETOLIVE",
			"LOGOUT_SIGNAL_TRIGGER",
			"LOGOUT_ROUTE_TO"
		);
		
		foreach ($saveList as $saveEntry) {
			if (isset($_POST[$saveEntry])) _fnc("saveConfig", $saveEntry, $_POST[$saveEntry]);
			else _fnc("saveConfig", $saveEntry, 0);
		}
		$tpl -> Zone("save", "success");
	}
	
	// Replace tags for their actual values //////////////////////////////////////////
	$replaceTagsFor = array(
		"SESSION_CACHE_EXPIRE",
		"SESSION_NAME",
		"LOGIN_SIGNAL_TRIGGER",
		"LOGIN_ROUTE_TO",
		"LOGIN_FIRST_ROUTE_TO",
		"LOGIN_FAILED_ERROR_MESSAGE",
		"LOGIN_BRUTEFORCE_FAILCOUNT",
		"LOGIN_BRUTEFORCE_DISABLE_DURATION",
		"LOGIN_BRUTEFORCE_ERROR_MESSAGE",
		"LOGIN_REMEMBERME_COOKIENAME",
		"LOGIN_REMEMBERME_TIMETOLIVE",
		"LOGOUT_SIGNAL_TRIGGER",
		"LOGOUT_ROUTE_TO"
	);
	
	foreach ($replaceTagsFor as $confTag) $replaceArray["CONF.{$confTag}"] = $CONF[$confTag];
	$tpl -> AssignArray($replaceArray);
	
	// Checkmark checkmarkable boxes /////////////////////////////////////////////////
	$checkMarkFor = array(
		"SESSION_CACHE_LIMITER",
		"SESSION_SAVE_PATH",
		"LOGIN_REQUIRE_ACTIVE",
		"LOGIN_BRUTEFORCE_PROTECT:ENABLE",
		"LOGIN_BRUTEFORCE_SHOWERROR",
		"LOGIN_REMEMBERME_ENABLED",
		"LOGIN_REMEMBERME_SHOWOPTION",
	);
	
	foreach ($checkMarkFor as $ckMarkEntity) {
		$ckMarkArray["ck.{$ckMarkEntity}"] = (ckBool($CONF[$ckMarkEntity]) ? "checked=\"checked\"" : NULL);
	}
	$tpl -> AssignArray($ckMarkArray);	

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