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
	$tpl -> Load("cron");
	

	// Handle submit order ///////////////////////////////////////////////////////////
	if (isset($_POST["Submit"])) {
		$saveList = array(
			"CRON_CYCLE_DELAY",
			"CRON_CLEAR_CHAT_IO",
			"CRON_CLEAR_CHAT_IO_DELAY",
			"CRON_CLEAR_LANE_TOKEN",
			"CRON_CLEAR_LANE_TOKEN_DELAY",
			"CRON_CLEAR_LANE_TOKEN_OLD_THRESHOLD",
			"CRON_OPTIMIZE_DATABASE",
			"CRON_OPTIMIZE_DATABASE_DELAY",
			"CRON_BACKUP_CONFIGURATIONS",
			"CRON_BACKUP_CONFIGURATIONS_DELAY",
			"CRON_BACKUP_CONFIG_FILE",
			"CRON_UPDATE_AGE_VALUE",
			"CRON_UPDATE_AGE_VALUE_DELAY",
			"CRON_UPDATE_GEODATA",
			"CRON_UPDATE_GEODATA_DELAY",
			"CRON_LOGFILE",
			"CRON_DATABASE_BACKUP",
			"CRON_DATABASE_BACKUP_METHOD:PHP",
			"CRON_DATABASE_BACKUP_FILE"
		);
		
		foreach ($saveList as $saveEntry) {
			if (isset($_POST[$saveEntry])) _fnc("saveConfig", $saveEntry, $_POST[$saveEntry]);
			else _fnc("saveConfig", $saveEntry, 0);
		}
		$tpl -> Zone("save", "success");
	}
	
	// Replace tags for their actual values //////////////////////////////////////////
	$replaceTagsFor = array(
		"CRON_CYCLE_DELAY",
		"CRON_CLEAR_CHAT_IO_DELAY",
		"CRON_CLEAR_LANE_TOKEN_DELAY",
		"CRON_CLEAR_LANE_TOKEN_OLD_THRESHOLD",
		"CRON_OPTIMIZE_DATABASE_DELAY",
		"CRON_BACKUP_CONFIGURATIONS_DELAY",
		"CRON_BACKUP_CONFIG_FILE",
		"CRON_UPDATE_AGE_VALUE_DELAY",
		"CRON_UPDATE_GEODATA_DELAY",
		"CRON_LOGFILE",
		"CRON_DATABASE_BACKUP_FILE"
	);
	
	foreach ($replaceTagsFor as $confTag) $replaceArray["CONF.{$confTag}"] = $CONF[$confTag];
	$tpl -> AssignArray($replaceArray);
	
	// Checkmark checkmarkable boxes /////////////////////////////////////////////////
	$checkMarkFor = array(
		"CRON_CLEAR_CHAT_IO",
		"CRON_CLEAR_LANE_TOKEN",
		"CRON_OPTIMIZE_DATABASE",
		"CRON_BACKUP_CONFIGURATIONS",
		"CRON_UPDATE_AGE_VALUE",
		"CRON_UPDATE_GEODATA",
		"CRON_DATABASE_BACKUP",
		"CRON_DATABASE_BACKUP_METHOD:PHP"
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