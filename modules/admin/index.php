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
	$tpl -> Load("index");
	
	
	/* Generate the stats */
	if ($handle = opendir("system/cache/logs/")) {

		$hits_total = 0;
		$hits_peak = 0;
		
		$ip_total = 0;
		$ip_peak = 0;
		
		$us_total = 0;
		$us_peak = 0;

		while (false !== ($fileName = readdir($handle))) {
			$file = explode(".", $fileName, 2);

			if (
				$file[1] == "dat" 
				and is_numeric($file[0]) 
				and $file[0] < date("U", mktime(0, 0, 0, date("m"), date("d"), date("Y")))
				and $file[0] > date("U", mktime(0, 0, 0, date("m"), date("d")-30, date("Y")))
			) {
				$statsBuffer = unserialize(file_get_contents("system/cache/logs/{$fileName}"));
				$hits[date("j", $file[0])] = $statsBuffer["hits_counter"];
				$d_ip[date("j", $file[0])] = $statsBuffer["distinct_ip"];
				$d_us[date("j", $file[0])] = $statsBuffer["distinct_users"];
				
				$hits_total += $statsBuffer["hits_counter"];
				if ($statsBuffer["hits_counter"] > $hits_peak) {
					$hits_peak = $statsBuffer["hits_counter"];
					$hits_peak_date = date("M. jS", $file[0]);
				}
				$hits_avg[] = $statsBuffer["hits_counter"];
				
				$ip_total += $statsBuffer["distinct_ip"];
				if ($statsBuffer["distinct_ip"] > $ip_peak) {
					$ip_peak = $statsBuffer["distinct_ip"];
					$ip_peak_date = date("M. jS", $file[0]);
				}
				$ip_avg[] = $statsBuffer["distinct_ip"];
				
				$us_total += $statsBuffer["distinct_users"];
				if ($statsBuffer["distinct_users"] > $us_peak) {
					$us_peak = $statsBuffer["distinct_users"];
					$us_peak_date = date("M. jS", $file[0]);
				}
				$us_avg[] = $statsBuffer["distinct_users"];
			}
		}
	}
	
	$tpl -> AssignArray(array(
		"s_hits" => base64_encode(serialize($hits)),
		"s_ip" => base64_encode(serialize($d_ip)),
		"s_us" => base64_encode(serialize($d_us)),

		"s.hits_total" => number_format($hits_total),
		"s.hits_peak" => number_format($hits_peak),
		"s.hits_peak_date" => $hits_peak_date,
		"s.hits_avg" => number_format(array_sum($hits_avg) / count($hits_avg), 2),

		"s.ip_total" => number_format($ip_total),
		"s.ip_peak" => number_format($ip_peak),
		"s.ip_peak_date" => $ip_peak_date,
		"s.ip_avg" => number_format(array_sum($ip_avg) / count($ip_avg), 2),

		"s.us_total" => number_format($us_total),
		"s.us_peak" => number_format($us_peak),
		"s.us_peak_date" => $us_peak_date,
		"s.us_avg" => number_format(array_sum($us_avg) / count($us_avg), 2),
	));
	
	/* Stats for today */
	$today_log = "system/cache/logs/".date("U", mktime(0, 0, 0, date("m"), date("d"), date("Y"))).".log";
	if (is_file($today_log)) {
		
		$hits_today = 0;
		
		/* parse the log */
		if ($f_handle = fopen($today_log, "r")) {

			while (!feof($f_handle)) {
				@list ($null, $null, $null, $null, $null, $null, $null, $date) = @explode("||", fgets($f_handle, 4096));
				
				$h_time = date("G", mktime(date("H", $date), 0, 0, date("m"), date("d"), date("Y")));
				$stats_by_time[$h_time] = (isset($stats_by_time[$h_time]) ? $stats_by_time[$h_time] + 1 : 1);
								
				/* Build a distinct ip, a distinct users list and increment the counter values */
				$hits_today ++;
			}
			fclose($f_handle);
			
			for ($i=0; $i < date("H"); $i++) $visitsArray[$i] = (isset($stats_by_time[$i])?$stats_by_time[$i]:0);
			
			$tpl -> AssignArray(array(
				"today.by_hour" => (isset($visitsArray) ? base64_encode(serialize($visitsArray)) : ""),
				"today.total_hits" => number_format($hits_today)
			));
		}
	}
	
	
	

	// TEMPLATE REPROCESS & FLUSH ////////////////////////////////////////////////////
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