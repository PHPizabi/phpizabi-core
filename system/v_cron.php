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
	//if (!defined("CORE_STRAP")) die("Out of structure call");
	
	// INITIALIZATION /////////////////////////////////////////////////////////////////
	/*
		Stabilize the vcron thread with PHP.
		ignore_user_abort will tell PHP to run the script in the background
		set_time_limit will force cron to run forever
	*/
	ignore_user_abort();
	set_time_limit(0);

	$thisCronID = uniqid(rand(0,9999));
	ucp("cron_id", $thisCronID);

	/*
		Clear potential "forgotten" sigsegvs
	*/
	@unlink("system/cache/temp/cron_sigsegv.tmp");

	writeLogEntry("Virtual crontab task manager started");

	// CRON CYCLE /////////////////////////////////////////////////////////////////////
	/*
		Initialize the cron loop. This is a forced "bug" - we use
		an endless loop to keep the cron running
	*/
	do {
		
		// CRON SIGSEGV CONTROL ///////////////////////////////////////////////////////
		/*
			Let's find out if a cron sigsegv signal was received, this
			would mean the cron task should be terminated.
		*/
		if (is_file("system/cache/temp/cron_sigsegv.tmp") || gcp("cron_id") != $thisCronID) {
			unlink("system/cache/temp/cron_sigsegv.tmp");
			unlink("system/cache/temp/cron_pid.dat");
			writeLogEntry("Virtual crontab task manager exited with sigsegv signal");
			break;
		}
		
		include("system/v_cron_proc.php");
		
		// CRON CYCLE TERMINATION /////////////////////////////////////////////////////
		/*
			Update the cron pid data
		*/
		ucp("last_cycle", date("U"));

		/*
			Sleep for some time before initializing
			the next cycle
		*/
		sleep($CONF["CRON_CYCLE_DELAY"]);

	} while(true);
	
	
	// CRON FUNCTIONS //////////////////////////////////////////////////////////////////
	function writeLogEntry($data) {
		global $CONF;
		
		touch($CONF["CRON_LOGFILE"]);
	
		if ($handle = fopen($CONF["CRON_LOGFILE"], "a")) {
			fwrite($handle, "[".date($CONF["LOCALE_LONG_DATE_TIME"])."] $data \n");
			fclose($handle);
		}
	}
	
	function ucp($column, $data) {
		global $CONF;
		
		touch("system/cache/temp/cron_pid.dat");
		
		$cronPidArray = unserialize(file_get_contents("system/cache/temp/cron_pid.dat"));
		if (!is_array($cronPidArray)) $cronPidArray = array();
		
		$cronPidArray[$column] = $data;
		
		if ($handle = fopen("system/cache/temp/cron_pid.dat", "w")) {
			fwrite($handle, serialize($cronPidArray));
			fclose($handle);
		}
	}
	
	function gcp($column) {
		global $CONF;
		
		touch("system/cache/temp/cron_pid.dat");
		
		$cronPidArray = unserialize(file_get_contents("system/cache/temp/cron_pid.dat"));
		if (!is_array($cronPidArray)) $cronPidArray = array();
		
		if (isset($cronPidArray[$column])) return $cronPidArray[$column];
		else return false;
	}
?>