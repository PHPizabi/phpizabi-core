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
	$tpl -> Load("install");
	$tpl -> GetObjects();

	/*
		Get the MoLo object <info ...> data
	*/
	$moloBuffer = file_get_contents($_GET["f"]);
	if (preg_match('/<info ([A-Z0-9+&@#\/%=~_|!:,.;\/ "]*)>/si',  $moloBuffer, $moloMatch)) {
			
		/*
			The molo "info" is now stored in $mooloMatch[1]... we will now get 
			each individual element of it and split that into another array
		*/
		preg_match_all('/([A-Z0-9]*) ?= ?"(.*?)"/si', $moloMatch[1], $moloInfo, PREG_SET_ORDER);
				
		foreach ($moloInfo as $key => $moloArray) {
	
			switch($moloInfo[$key][1]) {
				case("name"):		$molo["molo.name"] =		$moloInfo[$key][2]; break;
				case("version"):	$molo["molo.version"] =		$moloInfo[$key][2]; break;
				case("author"):		$molo["molo.author"] =		$moloInfo[$key][2]; break;
				case("support"):	$molo["molo.support"] =		$moloInfo[$key][2]; break;
				case("url"):		$molo["molo.url"] = 		$moloInfo[$key][2]; break;
				case("body"):		$molo["molo.body"] =		$moloInfo[$key][2]; break;
			}
		}
		$molo["molo.id"] = md5($molo["molo.name"].$molo["molo.version"]);
		$molo["molo.file"] = $_GET["f"];
	}
	
	// HANDLE INSTALLATION /////////////////////////////////////////////////////
	if (isset($_POST["Install"], $_POST["run"])) {
		
		$errorCount = 0;
		
		mLog("<strong>Preparing module installation ...</strong>");
		/*
			Load the appropriate section of the molo 
			file according to the mode we got through
			GET[mode], this may be "install", "update", or "uninstall".
			The content of the mode method without its
			surrounding tags is sent in the second array object (moloData[1]).
		*/
		
		if (
			preg_match(
				'/<'.$_GET["mode"].'>(.*)<\/'.$_GET["mode"].'>/si',
				file_get_contents($_GET["f"]),
				$moloMatch
			)
		) {
		
			/*
				We will now split all of the mode methods tags
				in separated "lines" / array objects. This will
				capture the tag content into the $moloTag[1][] 
				array objects
			*/
			if (preg_match_all('/<(.*?)>/si', $moloMatch[1], $moloTags)) {
				
				/*
					We will now loop in each molotag, get the first word out
					which constitutes the command name, and all the parameters
					into an array. The command name is captured into $tag[0], the 
					rest of the command parameters are stored into $tag[1].
				*/
				mLog("Found ".count($moloTags[1])." total instructions ... Running");
				foreach ($moloTags[1] as $tag) {
					
					$tag = explode(" ", $tag, 2);
					$moloFunction = $tag[0];

					/*
						Split the parameters and their values. The param is stored
						into $tagParams[1], its value is stored in $tagParams[2]
					*/
					preg_match_all('/([A-Z0-9]*) ?= ?"(.*?)"/si', $tag[1], $tagParams, PREG_PATTERN_ORDER);
					
					/*
						Combine the $moloMethod["METHOD NAME"] = "VALUE" into a
						single array
					*/
					foreach($tagParams[1] as $id => $key) $moloMethod[$key] = $tagParams[2][$id];
					mLog("&nbsp;Running instruction: {$tag[0]} (".strlen($tag[1])." bytelen) ...");
					if (function_exists("molo_exec_".$moloFunction)) {
						if (in_array($moloFunction, $_POST["run"])) {
							if (call_user_func("molo_exec_".$moloFunction, $moloMethod)) {
								mLog("&nbsp;&nbsp;<span style=\"color:green;\">Success</span>");
							}
							else {
								$errorCount ++;
								mLog("&nbsp;&nbsp;<span style=\"color:red;\">Failed</span>");
							}
						}
					}
					else {
						$errorCount ++;
						mLog("&nbsp;&nbsp;<span style=\"color:red;\">Failure: Unrecognized function ({$tag[0]})</span>");
					}
				}
			}
		}
		
		/*
			Update the installation status on the system
		*/
		if (!is_array($iMoLoArray = unpk(file_get_contents("system/cache/molo.dat")))) $iMoLoArray = array();
		
		if ($_GET["mode"] == "install" or $_GET["mode"] == "update") {
			$iMoLoArray[] = array(
				"INSTALLED_ID" => $molo["molo.id"],
				"INSTALLED_NAME" => $molo["molo.name"],
				"INSTALLED_VERSION" => $molo["molo.version"]
			);
		}
		
		elseif ($_GET["mode"] == "uninstall") {
			foreach ($iMoLoArray as $iMoLoKey => $iMoLoObject) {
				if ($iMoLoObject["INSTALLED_ID"] == $molo["molo.id"]) {
					unset($iMoLoArray[$iMoLoKey]);
					break;
				}
			}
		}
		
		if ($handle = fopen("system/cache/molo.dat", "w")) {
			fwrite($handle, pk($iMoLoArray));
			fclose($handle);
		}
		
		mLog("<strong>Installation process terminated</strong>");
		
		$tpl -> Zone("install", "installLog");
		$tpl -> AssignArray(array(
			"install.log" => mLog("", 1),
			"install.errorCount" => $errorCount
		));
	}
	
	// PRE-INSTALLATION MODE ///////////////////////////////////////////////////////////////////
	else {
		
		$tpl -> Zone("install", "preinstall");
		
		if (is_dir("theme/") && $handle = opendir("theme/")) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != ".." && $file != "templates") {
					$themeList[] = array("theme" => $file);
				}
			}
		}
		$tpl -> Loop("themes", $themeList);
		$tpl -> AssignArray($molo);
		$tpl -> AssignArray(array("install.mode" => strtoupper($_GET["mode"])));
	}
	
	// FUNCTIONS ////////////////////////////////////////////////////////////////////////////
	function molo_exec_tpl($array) {
		/* 
			Array MAP:
				mode => Describes the TPL mode (append, remove)
				reference => TPL file to modify
				location => Reference marker to get in the file
				position => left or right (top = left, bottom = right) specify where to apply modification
				value => What to inject
		*/
		if (
			isset($array["reference"]) 
			and 
			is_file("theme/{$_POST["theme"]}/templates/".$array["reference"])
			and
			is_writable("theme/{$_POST["theme"]}/templates/".$array["reference"])
		) {
		
			$tplBuffer = file_get_contents("theme/{$_POST["theme"]}/templates/".$array["reference"]);

			if (isset($array["mode"])) switch ($array["mode"]) {
				
				case("append"):
					/* 
						In append mode, we will add a value to the TPL file. First: Let's try
						to load the specified location.
					*/
					if (
						preg_match(
							'%<!-- ?'.$array["location"].' ?-->(.*)<!-- ?/'.$array["location"].' ?-->%si',
							$tplBuffer,
							$setMatch
						)
					) {

						if (!strstr($setMatch[0], $array["value"])) {
							
							/*
								We found the location ... We will append to it.
							*/
							$left = (!isset($array["position"]) or $array["position"] == "left" or $array["position"] == "top"?1:0);
							$newSet = "<!-- {$array["location"]} -->".($left?urldecode($array["value"]):NULL).$setMatch[1].(!$left?urldecode($array["value"]):NULL)."<!-- /{$array["location"]} -->";
							$tplBuffer = str_replace($setMatch[0], $newSet, $tplBuffer);
	
							/*
								Write the file
							*/
							if ($handle = fopen("theme/{$_POST["theme"]}/templates/".$array["reference"], "w")) {
								fwrite($handle, $tplBuffer);
								fclose($handle);
								return true;
							}
						}
					}
					else mLog("&nbsp;&nbsp;&nbsp;Can not find a corresponding location");
						
					
				break;
				
				case("remove"):
					/* 
						In remove mode, we will remove [value] from a the specified location
					*/
					if (
						preg_match(
							'%<!-- ?'.$array["location"].' ?-->(.*)<!-- ?/'.$array["location"].' ?-->%si',
							$tplBuffer,
							$setMatch
						)
					) {

						if (strstr($setMatch[0], $array["value"])) {
							
							/*
								We found the location and the value to remove ... We will do it!
							*/
							$newSet = "<!-- {$array["location"]} -->".str_replace(urldecode($array["value"]), NULL, $setMatch[1])."<!-- /{$array["location"]} -->";
							$tplBuffer = str_replace($setMatch[0], $newSet, $tplBuffer);
	
							/*
								Write the file
							*/
							if ($handle = fopen("theme/{$_POST["theme"]}/templates/".$array["reference"], "w")) {
								fwrite($handle, $tplBuffer);
								fclose($handle);
								return true;
							}
						}
					}
					else mLog("&nbsp;&nbsp;&nbsp;Can not find a corresponding location");
				break;
			}
		}
		else mLog("&nbsp;&nbsp;&nbsp;The file theme/{$_POST["theme"]}/templates/".$array["reference"]." must be writable");
		return false;
	}
	
	function molo_exec_conf($array) {
		global $CONF;
		
		/* 
			Array MAP:
				mode => Describes the TPL mode (append, remove)
				reference => TPL file to modify
				location => Reference marker to get in the file
				position => left or right (top = left, bottom = right) specify where to apply modification
				value => What to inject
		*/
		if (isset($array["mode"])) switch($array["mode"]) {

			case("append"):
				/*
					Check if we can write that file
				*/
				if (is_writable("system/conf.inc.php")) {
			
					/*
						Create the new line to be inserted
					*/
					$newLine = "\$CONF[\"".strtoupper($array["reference"])."\"] = ";
			
					/*
						Play with values types, we will try
						to assign the value as integer, bool,
						or string.
					*/
					if (is_numeric($array["value"])) $newLine .= $array["value"];
					elseif (is_bool($array["value"])) $newLine .= ($array["value"]?"true":"false");
					else $newLine .= "\"".str_replace("\"", "\\\"", stripslashes($array["value"]))."\"";
			
					/*
						Append line termination
					*/
					$newLine .= ";";

					/*
						Load the configuration file body into a buffer
					*/
					$configBody = @file_get_contents("system/conf.inc.php");
			
					/*
						Add the new line to the configuration body
					*/
					$configBody = str_replace("?>", "\n".$newLine."\n?>", $configBody);
			
					/*
						Backup the configuration file before we make any change
					*/
					copy("system/conf.inc.php", "system/cache/backups/autobackup_".date("dmyhi")."conf.inc.php");
			
					/*
						Save the buffer into the configuration file ...
					*/
					ignore_user_abort(true);
					if ($handle = fopen("system/conf.inc.php", "w")) {
				
						/*
							Try to lock the file and write
						*/
						flock($handle, LOCK_EX);
						fwrite($handle, $configBody);
						flock($handle, LOCK_UN);
						fclose($handle);
						ignore_user_abort(false);
				
						return true;
					}
				}
			break;
			
			case("modify"):
				/*
					Check if we can write that file
				*/
				if (is_writable("system/conf.inc.php")) {
			
					/*
						Create the new line to be inserted
					*/
					$newLine = "\$CONF[\"".strtoupper($array["reference"])."\"] = ";
			
					/*
						Play with values types, we will try
						to assign the value as integer, bool,
						or string.
					*/
					if (is_numeric($array["value"])) $newLine .= $array["value"];
					elseif (is_bool($array["value"])) $newLine .= ($array["value"]?"true":"false");
					else $newLine .= "\"".str_replace("\"", "\\\"", stripslashes($array["value"]))."\"";
			
					/*
						Append line termination
					*/
					$newLine .= ";";

					/*
						Load the configuration file body into a buffer
					*/
					$configBody = @file_get_contents("system/conf.inc.php");
			
					/*
						Swap the old line with the new one
					*/
					$configBody = preg_replace(
						'/\\$CONF\\["'.preg_quote(strtoupper($array["reference"])).'"\\].*/', 
						$newLine, 
						$configBody
					);
			
					/*
						Backup the configuration file before we make any change
					*/
					copy("system/conf.inc.php", "system/cache/backups/autobackup_".date("dmyhi")."conf.inc.php");
			
					/*
						Save the buffer into the configuration file ...
					*/
					ignore_user_abort(true);
					if ($handle = fopen("system/conf.inc.php", "w")) {
				
						/*
							Try to lock the file and write
						*/
						flock($handle, LOCK_EX);
						fwrite($handle, $configBody);
						flock($handle, LOCK_UN);
						fclose($handle);
						ignore_user_abort(false);
				
						return true;
					}
				}
			break;
			
			case("remove"):
				/*
					Check if we can write that file
				*/
				if (is_writable("system/conf.inc.php")) {
			
					/*
						Load the configuration file body into a buffer
					*/
					$configBody = @file_get_contents("system/conf.inc.php");
			
					/*
						Swap the old line with the new one
					*/
					$configBody = preg_replace(
						'/\\$CONF\\["'.preg_quote(strtoupper($array["reference"])).'"\\].*/',
						NULL,
						$configBody
					);
			
					/*
						Backup the configuration file before we make any change
					*/
					copy("system/conf.inc.php", "system/cache/backups/autobackup_".date("dmyhi")."conf.inc.php");
			
					/*
						Save the buffer into the configuration file ...
					*/
					ignore_user_abort(true);
					if ($handle = fopen("system/conf.inc.php", "w")) {
				
						/*
							Try to lock the file and write
						*/
						flock($handle, LOCK_EX);
						fwrite($handle, $configBody);
						flock($handle, LOCK_UN);
						fclose($handle);
						ignore_user_abort(false);
				
						return true;
					}
				}
			break;
		}
	}
	
	function molo_exec_map($array) {
		if (is_writable("system/cache/languages/map.txt")) {
			$mapBody = file_get_contents("system/cache/languages/map.txt");
			
			switch($array["mode"]) {
				case("append"):
					$mapBody .= "\n".$array["reference"].":".$array["location"].":".urldecode($array["value"]);
					
					if ($handle = fopen("system/cache/languages/map.txt", "w")) {
						fwrite($handle, $mapBody);
						fclose($handle);
						return true;
					}					
				break;
			}
		}
	}
	
	function molo_exec_db($array) {
		switch($array["mode"]) {
			
			case("query"):
				myQ(urldecode($array["value"]));
				if (!mysql_error()) return true;
				else mLog("&nbsp;&nbsp;&nbsp;MySQL returned: ".mysql_error());
			break;
		}
	}
	
	function molo_exec_io($array) {
		switch($array["mode"]) {
			
			case("make"):
				if (@touch($array["value"])) {
					@chmod($array["value"], $array["chmod"]);
					return true;
				}				
			break;
			
			case("unlink"):
				if (@unlink($array["value"])) return true;
			break;
		}
	}
	
	function mLog($data, $flush=0) {
		if (isset($GLOBALS["mlog_data"])) $GLOBALS["mlog_data"] .= $data."<br />";
		else $GLOBALS["mlog_data"] = $data."<br />";
		
		if ($flush) return $GLOBALS["mlog_data"];
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