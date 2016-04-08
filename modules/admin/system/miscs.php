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
	$tpl -> Load("miscs");
	

	// Handle submit order ///////////////////////////////////////////////////////////
	if (isset($_POST["Submit"])) {
		$saveList = array(
			"ALLOW_USERNAMES_URL_CALLS",
			"USE_SELFDATA_DUAL_BUFFERING",
			"BAN_INFO_FILE",
			"BAN_TEMPLATE_FILE",
			"TRANSLATOR_ENABLED",
			"TRANSLATOR_FLAT_MODE",
			"HOROSCOPES_DATAFILE",
			"NOTIFICATIONS_DATAFILE",
			"USE_VIRTUAL_HOSTS",
			"VIRTUAL_HOSTS_AUTO_TRY_PREFIX",
			"VIRTUAL_HOSTS_INFOFILE",
			"ENABLE_USER_LEVEL_HERITAGE",
			"HERITAGE_INFOFILE",
			"BODY_TRIM_METHOD_STRLEN",
			"HTTPS_ROLLBACK",
			"DISTANCE_VALUES_UNIT:MILES",
			"POST_PROCESS_CLEAN_OUTPUT",
			"POST_PROCESS_COMPRESS_OUTPUT",
			"POST_PROCESS_COMPRESSION_RATE"
		);
		
		foreach ($saveList as $saveEntry) {
			if (isset($_POST[$saveEntry])) _fnc("saveConfig", $saveEntry, $_POST[$saveEntry]);
			else _fnc("saveConfig", $saveEntry, 0);
		}
		$tpl -> Zone("save", "success");
	}
	
	// Replace tags for their actual values //////////////////////////////////////////
	$replaceTagsFor = array(
		"BAN_INFO_FILE",
		"BAN_TEMPLATE_FILE",
		"HOROSCOPES_DATAFILE",
		"NOTIFICATIONS_DATAFILE",
		"VIRTUAL_HOSTS_INFOFILE",
		"HERITAGE_INFOFILE",
		"POST_PROCESS_COMPRESSION_RATE"
	);
	
	foreach ($replaceTagsFor as $confTag) $replaceArray["CONF.{$confTag}"] = $CONF[$confTag];
	$tpl -> AssignArray($replaceArray);
	
	// Checkmark checkmarkable boxes /////////////////////////////////////////////////
	$checkMarkFor = array(
		"ALLOW_USERNAMES_URL_CALLS",
		"USE_SELFDATA_DUAL_BUFFERING",
		"BAN_INFO_FILE",
		"BAN_TEMPLATE_FILE",
		"TRANSLATOR_ENABLED",
		"TRANSLATOR_FLAT_MODE",
		"TRANSLATOR_REGEXP",
		"HOROSCOPES_DATAFILE",
		"NOTIFICATIONS_DATAFILE",
		"USE_VIRTUAL_HOSTS",
		"VIRTUAL_HOSTS_AUTO_TRY_PREFIX",
		"VIRTUAL_HOSTS_INFOFILE",
		"ENABLE_USER_LEVEL_HERITAGE",
		"HERITAGE_INFOFILE",
		"BODY_TRIM_METHOD_STRLEN",
		"HTTPS_ROLLBACK",
		"DISTANCE_VALUES_UNIT:MILES",
		"POST_PROCESS_CLEAN_OUTPUT",
		"POST_PROCESS_COMPRESS_OUTPUT",
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