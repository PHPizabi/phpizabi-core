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


	// HANDLE CLEAR CRON LOG ENTRIES REQUEST //////////////////////////////////////////
	if (isset($_GET["clearlog"])) {
		if (is_file("system/cache/logs/cron.log")) unlink("system/cache/logs/cron.log");
		_fnc("reload", 0, "?L=admin.cron.cron");
	}
	
	// HANDLE THE RUN NOW REQUEST /////////////////////////////////////////////////////
	if (isset($_GET["launch"])) {
		include("system/v_cron_proc.php");
		_fnc("reload", 0, "?L=admin.cron.cron");
	}
	
	/*
		Get the cron pid array file, decompress it.
	*/
	if (is_file("system/cache/temp/cron_pid.dat")) {
		$cronPAD = unserialize(file_get_contents("system/cache/temp/cron_pid.dat"));
		if (!is_array($cronPAD)) $cronPAD = array();
		
		/*
			if the last cron cycle is greater than now minus cycle delay minus
			one second ... if it is, cron is probably running.
		*/
		if (isset($cronPAD["last_cycle"])) {
			$lastCronCycle = $cronPAD["last_cycle"];
			if ($cronPAD["last_cycle"] > date("U")-$CONF["CRON_CYCLE_DELAY"]-1) $tpl -> Zone("cronStatus", "running");
		} else $tpl -> Zone("cronStatus", "dead");
	}

	else $tpl -> Zone("cronStatus", "dead");

	if (isset($lastCronCycle)) {
		$tpl -> AssignArray(array("cron.lastCycle" => date($CONF["LOCALE_LONG_DATE_TIME"], $lastCronCycle)));
	} else $tpl -> AssignArray(array("cron.lastCycle" => 0));
	
	/*
		Get and inject the cron log
	*/
	if (is_file("system/cache/logs/cron.log")) {
		$tpl -> AssignArray(array("cron.log" => file_get_contents("system/cache/logs/cron.log")));
	} else $tpl -> AssignArray(array("cron.log" => NULL));
	
	
	

	
	// RUN CRON //
	if (isset($_GET["run"])) {
		include("system/v_cron.php");
	}
	
	// STOP CRON //
	if (isset($_GET["abort"])) {
		touch("system/cache/temp/cron_sigsegv.tmp");
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