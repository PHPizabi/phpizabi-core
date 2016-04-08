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

	// CRON FUNCTIONS //////////////////////////////////////////////////////////////////
	if (!function_exists("writeLogEntry")) {
		function writeLogEntry($data) {
			global $CONF;
			
			touch($CONF["CRON_LOGFILE"]);
		
			if ($handle = fopen($CONF["CRON_LOGFILE"], "a")) {
				fwrite($handle, "[".date($CONF["LOCALE_LONG_DATE_TIME"])."] $data \n");
				fclose($handle);
			}
		}
	}
		
	if (!function_exists("ucp")) {
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
	}
		
	if (!function_exists("gcp")) {
		function gcp($column) {
			global $CONF;
			
			touch("system/cache/temp/cron_pid.dat");
			
			$cronPidArray = unserialize(file_get_contents("system/cache/temp/cron_pid.dat"));
			if (!is_array($cronPidArray)) $cronPidArray = array();
			
			if (isset($cronPidArray[$column])) return $cronPidArray[$column];
			else return false;
		}
	}

	writeLogEntry("Cron cycle started");
	
	// Re-include the conf ... //
	@include("system/conf.inc.php");
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// CLEAR CHAT IO BUFFER //////////////////////////////////////////////////////////////////////////////////
	if ($CONF["CRON_CLEAR_CHAT_IO"]) {
		
		if (
			(gcp("clear_chat_io_buffer") && gcp("clear_chat_io_buffer") < (date("U") - $CONF["CRON_CLEAR_CHAT_IO_DELAY"] - 1))
			||
			!gcp("clear_chat_io_buffer")
		) {
			
			if ($handle = fopen("system/cache/chat/io.dat", "w")) {
				fwrite($handle, "", 0);
				fclose($handle);
				
				ucp("clear_chat_io_buffer", date("U"));
				writeLogEntry("# Successfully cleared chat IO buffer data");
			}
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// CLEAR OLD LANE TOKENS /////////////////////////////////////////////////////////////////////////////////
	if ($CONF["CRON_CLEAR_LANE_TOKEN"]) {
		
		if (
			(gcp("clear_lane_tokens") && gcp("clear_lane_tokens") < (date("U") - $CONF["CRON_CLEAR_LANE_TOKEN_DELAY"] - 1))
			||
			!gcp("clear_lane_tokens")
		) {
			
			$laneClearCount = 0;
			
			if ($directoryHandle = opendir("system/cache/lane/")) {
				while (($file = readdir($directoryHandle)) !== false) {
					if (strpos($file, ".tk")) {
					
						/*
							Explode the token name at ".", we will get 3
							values, 0: User ID, 1: Token timestamp, 2: file extention
						*/
						$token = explode(".", $file);
						if ($token[1] < date("U") - $CONF["CRON_CLEAR_LANE_TOKEN_OLD_THRESHOLD"]) {

							unlink("system/cache/lane/{$file}");
							$laneClearCount ++;

						}
					}
				}
				
				closedir($directoryHandle);
				
				ucp("clear_lane_tokens", date("U"));
				writeLogEntry("# Successfully cleared $laneClearCount LANE tokens");

			}
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// OPTIMIZE DATABASE TABLES //////////////////////////////////////////////////////////////////////////////
	if ($CONF["CRON_OPTIMIZE_DATABASE"]) {
		
		if (
			(gcp("optimize_db") && gcp("optimize_db") < (date("U") - $CONF["CRON_OPTIMIZE_DATABASE_DELAY"] - 1))
			||
			!gcp("optimize_db")
		) {
			
			$countTables = 0;

			if (!isset($GLOBALS["MYSQL_CONNECTION"]) || !$GLOBALS["MYSQL_CONNECTION"]) myConnect();
			
			if ($select = mysql_list_tables($CONF["MYSQL_DATABASE_DATABASENAME"])) {
				while ($row = mysql_fetch_row($select)) {

					$result = mysql_query("OPTIMIZE TABLE `{$row[0]}`");
					$countTables ++;

				}
					
				ucp("optimize_db", date("U"));
				writeLogEntry("# Successfully optimized {$countTables} database tables");

			}
		}
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// BACKUP CONFIGURATION FILE /////////////////////////////////////////////////////////////////////////////
	if ($CONF["CRON_BACKUP_CONFIGURATIONS"]) {
		
		if (
			(gcp("backup_conf") && gcp("backup_conf") < (date("U") - $CONF["CRON_BACKUP_CONFIGURATIONS_DELAY"] - 1))
			||
			!gcp("backup_conf")
		) {

			if (copy("system/conf.inc.php", str_replace("[DATE]", date("d-m-Y-H-i-s"), $CONF["CRON_BACKUP_CONFIG_FILE"]))) {
			
				ucp("backup_conf", date("U"));
				writeLogEntry("# Successfully backed up configuration file");
				
			}
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// UPDATE USERS AGE VALUE ////////////////////////////////////////////////////////////////////////////////
	if ($CONF["CRON_UPDATE_AGE_VALUE"]) {
		
		if (
			(gcp("update_age") && gcp("update_age") < (date("U") - $CONF["CRON_UPDATE_AGE_VALUE_DELAY"] - 1))
			||
			!gcp("update_age")
		) {

			$select = myQ("SELECT `id`,`birthdate`,`age` FROM `[x]users`");
			$ageUpdateCount = 0;
			while ($row = myF($select)) {
				
				if (_fnc("age", $row["birthdate"]) != $row["age"]) {
					
					myQ("UPDATE `[x]users` SET `age`='"._fnc("age", $row["birthdate"])."' WHERE `id`='{$row["id"]}'");
					$ageUpdateCount ++;
					
				}
			}
			
			ucp("update_age", date("U"));
			writeLogEntry("# Successfully updated {$ageUpdateCount} user age values");
		}
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// UPDATE GEODATA ////////////////////////////////////////////////////////////////////////////////////////
	if ($CONF["CRON_UPDATE_GEODATA"]) {
		
		if (
			(gcp("update_geodata") && gcp("update_geodata") < (date("U") - $CONF["CRON_UPDATE_GEODATA_DELAY"] - 1))
			||
			!gcp("update_geodata")
		) {

			$select = myQ("SELECT `id` FROM `[x]users` WHERE `latitude`='0' AND `longitude`='0'");
			$geoUpdateCount = 0;
			while ($row = myF($select)) {
				
				$geoArray[] = $row["id"];
				$geoUpdateCount ++;

			}
			
			if (isset($geoArray)) _fnc("geoLocalize", $geoArray);
			
			ucp("update_geodata", date("U"));
			writeLogEntry("# Successfully updated {$geoUpdateCount} geographic values");
		}
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// PARSE AND COMPUTE STATS FROM LOGS /////////////////////////////////////////////////////////////////////
	if ($CONF["CRON_BUILD_STATS"]) {
		
		if (
			(gcp("build_stats") && gcp("build_stats") < (date("U") - $CONF["CRON_BUILD_STATS_DELAY"] - 1))
			||
			!gcp("build_stats")
		) {
			
			$statsUpdateCount = 0;
		
			if ($handle = opendir("system/cache/logs/")) {
		
				while (false !== ($fileName = readdir($handle))) {
		
					$file = explode(".", $fileName, 2);
		
					if (
						$file[1] == "log" 
						and is_numeric($file[0]) 
						and !is_file("system/cache/logs/{$file[0]}.dat") 
						and $file[0] < date("U", mktime(0, 0, 0, date("m"), date("d"), date("Y")))
					) {
						
						$stats["ip_list"] = array();
						$stats["users_list"] =  array();
						$stats["hits_counter"] = 0;
						
						
						/* parse the log */
						if ($f_handle = fopen("system/cache/logs/{$fileName}", "r")) {
						
							while (!feof($f_handle)) {
								@list ($null, $username, $ip, $null, $null, $null, $null, $null) = @explode("||", fgets($f_handle, 4096));
								unset($logData);
								
								/* Build a distinct ip, a distinct users list and increment the counter values */
								$stats["ip_list"][$ip] = 1;
								$stats["users_list"][$username] = 1;
								$stats["hits_counter"] ++;
							}
							fclose($f_handle);
							
							$stats["distinct_ip"] = count($stats["ip_list"]);
							$stats["distinct_users"] = count($stats["users_list"]);
							
							if ($l_handle = fopen("system/cache/logs/{$file[0]}.dat", "w")) {
								fwrite($l_handle, serialize($stats));
								fclose($l_handle);

								$statsUpdateCount ++;
							}
							unset($stats);
						}
					}
				}
			}
			closedir($handle);

			ucp("build_stats", date("U"));
			writeLogEntry("# Successfully built stats from {$statsUpdateCount} analysed log files");
		}
	}
	

	writeLogEntry("Cron cycle ended");


?>