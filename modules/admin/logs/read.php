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
	$tpl -> Load("read");
	
	// PAGINATION PREPARATION /////////////////////////////////////////////////////
	if (!isset($_GET["page"]) || !is_numeric($_GET["page"]) || $_GET["page"] == 0) $page = 1;
	else $page = $_GET["page"];
	
	// READ THE LOG FILE //////////////////////////////////////////////////////////
	if ($handle = fopen("system/cache/logs/{$_GET["id"]}.log", "r")) {
		
		$lineSize=0;
		$n=0;
		$i=(($page * 100) - 100);
		$lastRow = $i + 100;
		
		while (!feof($handle) && $i < $lastRow) {
			$logData = fgets($handle, 4096);
			
			/* Keep Stats of 5 Log Lines */
			if ($n <= 5) $lineSize += strlen($logData);
			
			/* Parse the log */
			if ($n >= $i) {
				
				@list ($userId, $username, $ip, $port, $refer, $userAgent, $getL, $date) = @explode("||", $logData);

				$logEntry[] = array(
					"log.id" => $i,
					"log.userid" => $userId,
					"log.username" => $username,
					"log.ip" => $ip,
					"log.l" => $getL,
					"log.date" => date($CONF["LOCALE_SHORT_TIME"], $date)
				);
				$i++;
			}
			$n++;
		}
		if (!feof($handle)) $nextPage = true;
		fclose($handle);
	}
	
	$tpl -> Loop("logRows", $logEntry);
	
	
	// PAGINATION ////////////////////////////////////////////////////////////////
	if (ckBool($nextPage)) {
		$tpl -> Zone("nextPage", "enabled");
		$tpl -> AssignArray(array(
			"next.page" => $page + 1,
			"next.id" => $_GET["id"],
		));
	}

	if ($page > 1) {
		$tpl -> Zone("prevPage", "enabled");
		$tpl -> AssignArray(array(
			"prev.page" => $page - 1,
			"prev.id" => $_GET["id"],
		));
	}

	
	// ASSIGN STATS ///////////////////////////////////////////////////////////////
	$tpl -> AssignArray(array(
		"log.date" => date($CONF["LOCALE_LONG_DATE"], $_GET["id"]),
		"log.size" => round(filesize("system/cache/logs/{$_GET["id"]}.log")/1048576, 2),
		"log.hits" => number_format(round(filesize("system/cache/logs/{$_GET["id"]}.log") / ($lineSize / 5)), 0, ",", " "),
	));
		

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