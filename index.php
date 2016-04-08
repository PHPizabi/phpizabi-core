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

// INITIALIZE SYSTEM //////////////////////////////////////////////////////////////////

	/* System Internal Check */
	define("CORE_STRAP", true);

	/* Check System installation and/or include the configuration file */
	@include("system/conf.inc.php");
	if (!defined("INSTALLED")) header("Location: install/index.php");

	/* Database configurations alternative inclusion */
	@include("system/db.inc.php");

	/* System Retrocompatibility with 0844 modules */
	/*
		This is a deprecated set. Next versions will NOT include this
		retrocompatibility fix; any module using one of the functions below
		will have to convert its calls to use the _fnc() transit method.
	*/
	if (isset($CONF["RETRO_844_COMPAT_MODE"]) and $CONF["RETRO_844_COMPAT_MODE"]) {
		include("system/functions/age.php");
		include("system/functions/array_remove.php");
		include("system/functions/clearBodyCodes.php");
		include("system/functions/convertBodyCodes.php");
		include("system/functions/convertEmoticons.php");
		include("system/functions/distance.php");
		include("system/functions/geoLocalize.php");
		include("system/functions/heritage_override.php");
		include("system/functions/in_iarray.php");
		include("system/functions/in_multiarray.php");
		include("system/functions/laneMakeToken.php");
		include("system/functions/moneyFormat.php");
		include("system/functions/prepare_user.php");
		include("system/functions/reload.php");
		include("system/functions/saveConfig.php");
		include("system/functions/sendmail.php");
		include("system/functions/str_spot.php");
		include("system/functions/strtrim.php");
		include("system/functions/user.php");
	}

	/* UTF8 Header Override */
	($CONF["LOCALE_FORCE_UTF8_HEADER_OVERRIDE"]?header('Content-type: text/html; charset=utf-8'):false);

	/* Set globalized variables */
	$GLOBALS["SYSTEM_VERSION"] = "PHPizabi v2.01 Alpha [Madison]";
	$GLOBALS["CHROMELESS_MODE"] = false;

	/* Set session parameters */
	session_start();

	/* Include core-level functions and classes */
	require("system/functions/classes/template.class.php");
	require("system/functions/database/mysql.fnc.php");

// ERROR HANDLING AND REPORTING PROCEDURE CALL ////////////////////////////////////////
	/* Set error reporting values */
	error_reporting(
		($CONF["ERROR_REPORT_ERRORS"]?		E_ERROR:	false) |
		($CONF["ERROR_REPORT_WARNINGS"]?	E_WARNING:	false) |
		($CONF["ERROR_REPORT_PARSES"]?		E_PARSE:	false) |
		($CONF["ERROR_REPORT_NOTICES"]?		E_NOTICE:	false)
	);

// SQL INJECTIONS / XSS HACKS PROTECTION //////////////////////////////////////////////
	$entities = array(";"=>"&#059;", "\""=>"&quot;", "'"=>"&#039;", "<"=>"&lt;", ">"=>"&gt;", "\\"=>"&#092;", "^"=>"&#094;");

	if (isset($_POST)) foreach($_POST as $var => $val)
		if (!is_array($val) and substr($var, 0, 1) != "_")
			$_POST[$var] = trim(strtr(stripslashes($val), $entities));

	if (isset($_GET)) foreach($_GET as $var => $val)
		if (!is_array($val) and substr($var, 0, 1) != "_")
			$_GET[$var] = trim(strtr(stripslashes($val), $entities));

	unset ($var, $val, $entities);

// SELF USER DATA PREPARATION CALL ////////////////////////////////////////////////////
	me('id');

// VIRTUAL HOSTS PRECOMPUTING /////////////////////////////////////////////////////////
	if ($CONF["USE_VIRTUAL_HOSTS"]) {

		if (!is_array($vhosts = unpk(file_get_contents($CONF["VIRTUAL_HOSTS_INFOFILE"])))) $vhosts = array();
		$uPointer = (isset($vhosts[$_SERVER["HTTP_HOST"]])
			? $_SERVER["HTTP_HOST"]
			: (isset($vhosts["www.".$_SERVER["HTTP_HOST"]])
			 	? "www.".$_SERVER["HTTP_HOST"]
				: NULL
			)
		);

		if (!is_null($uPointer)) {
			$GLOBALS["VHOST"] = true;
			foreach($vhosts[$uPointer] as $key => $override_value) $CONF[$key] = $override_value;
		}
	}
	unset ($vhosts, $override_value);

// USER LEVEL HERITAGE ////////////////////////////////////////////////////////////////
	if ($CONF["ENABLE_USER_LEVEL_HERITAGE"]) _fnc("heritage_override", "me");

// WAP CONTROL ////////////////////////////////////////////////////////////////////////
	/*
		WAP
		Control the user agent ...
	*/
	if ($CONF["WAP_GATEWAY_ENABLED"] && strpos($_SERVER["HTTP_ACCEPT"], "application/vnd.wap.xhtml+xml")) {
		$GLOBALS["WAP_MODE"] = true;
		$GLOBALS["CHROMELESS_MODE"] = true;
	} else $GLOBALS["WAP_MODE"] = false;

// LOGIN & LOGOUT SYSTEM //////////////////////////////////////////////////////////////
	if (isset($_POST["username"], $_POST["password"], $_POST[$CONF["LOGIN_SIGNAL_TRIGGER"]])) {

		/*
			If we got a login signal, a password and a username, we will
			proceed to check login information. We will first extract
			the user row from the db.
		*/
		$user = myF(myQ("
			SELECT `username`,`password`,`id`,`disable_until`,`active`
			FROM `[x]users`
			WHERE LCASE(`username`)='".strtolower($_POST["username"])."'
		"));

		if (!$user["id"]) $GLOBALS["LOGIN_FAIL_TYPE"] = "e.user";
		elseif ($user["active"] != 1 && $CONF["LOGIN_REQUIRE_ACTIVE"]) $GLOBALS["LOGIN_FAIL_TYPE"] = "e.active";

		else {
			/*
				If the user's account 'disabled' value is greater than
				the actual date value, and that the bruteforce protection
				system is enabled, we will show an error message
			*/
			if (($user["disable_until"] > date("U")) && ($CONF["LOGIN_BRUTEFORCE_PROTECT:ENABLE"])) {
				 $GLOBALS["LOGIN_FAIL_TYPE"] = "e.bruteforce";
				(isset($_SESSION["loginFailCount"])?session_unregister('loginFailCount'):false);
			}

			/*
				Account is not disabled
			*/
			else {
				if ((isset($_SESSION["loginFailCount"])) && ($_SESSION["loginFailCount"] > $CONF["LOGIN_BRUTEFORCE_FAILCOUNT"])) {

					myQ("UPDATE `[x]users`
						SET `disable_until` = ".(date("U")+$CONF["LOGIN_BRUTEFORCE_DISABLE_DURATION"])."
						WHERE LCASE(`username`)='".strtolower($_POST["username"])."'
						LIMIT 1"
					);

					(isset($_SESSION["loginFailCount"])?session_unregister('loginFailCount'):false);
					$GLOBALS["LOGIN_FAIL_TYPE"] = "e.bruteforce";
				}

				else {

					/*
						All the information correct, we will proceed to login
					*/
					if ($user["password"] == md5(trim($_POST["password"]))) {
						$_SESSION["id"] = (integer)$user["id"];

						session_write_close();

						/*
							Update the last login key
						*/
						$me_last_login = me("last_login");
						myQ("UPDATE `[x]users` SET `last_login`='".date("U")."' WHERE `id`='".me('id')."'");

						/*
							Route the user
						*/
						if (!$GLOBALS["WAP_MODE"]) {
							header("Location: ".(!$me_last_login?$CONF["LOGIN_FIRST_ROUTE_TO"]:$CONF["LOGIN_ROUTE_TO"]));
						} else header("Location: {$CONF["WAP_LOGIN_ROUTE_TO"]}");

					}

					else {
						(isset($_SESSION["loginFailCount"])?$_SESSION["loginFailCount"]++:$_SESSION["loginFailCount"]=1);
						$GLOBALS["LOGIN_FAIL_TYPE"] = "e.password";
					}
				}
			}
		}
	}

	if ((isset($_GET[$CONF["LOGOUT_SIGNAL_TRIGGER"]])) && (!isset($_POST[$CONF["LOGIN_SIGNAL_TRIGGER"]]))) {

		/*
			Handle admin swapping
		*/
		if (isset($_SESSION["swap_id"])) {
			$_SESSION["id"] = $_SESSION["swap_id"];
			session_unregister("swap_id");
			header("Location: ?L=admin.index");
		}

		else {
			(isset($_SESSION["id"])?session_unregister('id'):false);
			(isset($_SESSION["SELF_USER_DATA"])?session_unregister('SELF_USER_DATA'):false);

			header("Location: {$CONF["LOGOUT_ROUTE_TO"]}");
		}
	}

// ROUTING & ACCESS CONTROL ///////////////////////////////////////////////////////////

	// THEME HANDLING /////////////////////////////////////////////////////////////////
	if (($CONF["ALLOW_THEME_OVERRIDE"]) && (me('use_theme'))) $GLOBALS["THEME"] = me('use_theme');
	else ($CONF["DEFAULT_THEME"]?$GLOBALS["THEME"]=$CONF["DEFAULT_THEME"]:$GLOBALS["THEME"]="default");

	// BANNING CHECK SYSTEM ///////////////////////////////////////////////////////////
	if ($CONF["BAN_ENABLE_BANCHECK"]) {

		$ip = ip2long(
			($CONF["BAN_CHECK_PROXY"] && isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != ""
				?$_SERVER['HTTP_X_FORWARDED_FOR']
				:$_SERVER['REMOTE_ADDR']
			)
		);

		/* Ban Layer 1 (Persistant cookie) */
		if ($CONF["BAN_ENFORCE"] && isset($_COOKIE["b_expire"]) && $_COOKIE["b_expire"] > date("U")) {
			$GLOBALS["BANNED"] = true;
		}

		/* Ban layer 2 (IP Based) */
		$banArray = unpk(file_get_contents($CONF["BAN_INFOFILE"]));

		if (is_array($banArray)) {
			foreach($banArray as $banEntity) {
				if (($banEntity["FROM"] <= $ip && $banEntity["TO"] >= $ip) && ($banEntity["EXPIRE"] > date("U"))) {

					$GLOBALS["BANNED"] = true;
					$GLOBALS["BANARRAY"] = $banEntity;
					break;
		}	}	}

		if (isset($GLOBALS["BANNED"]) && $GLOBALS["BANNED"]) {

			if ($CONF["BAN_ENFORCE"]) {
				setcookie("b_expire", $expire=(isset($GLOBALS["BANARRAY"])&&is_array($GLOBALS["BANARRAY"]?$GLOBALS["BANARRAY"]["EXPIRE"]:date("U")+3600)), $expire);
			}

			$banTemplate = new template;
			$banTemplate -> LoadThis(file_get_contents("theme/{$GLOBALS["THEME"]}/templates/GLOBALS/banned.tpl"));
			$banTemplate -> AssignArray(array(
				"expire" => date($CONF["LOCALE_LONG_DATE_TIME"], $GLOBALS["BANARRAY"]["EXPIRE"]),
				"body" => $GLOBALS["BANARRAY"]["BODY"],
				"by" => $GLOBALS["BANARRAY"]["BY"]
			));
			$banTemplate -> Flush();

			if ($CONF["BAN_FORCE_SUICIDE"]) {
				die($CONF["BAN_FORCE_SUICIDE_MESSAGE"]);
			}
		}
	}

	// CHROME CONTROL /////////////////////////////////////////////////////////////////
	if (isset($_GET["chromeless"]) and $CONF["ALLOW_CHROME_CONTROL"]) $GLOBALS["CHROMELESS_MODE"] = true;

	// MAINTENANCE MODE HANDLING //////////////////////////////////////////////////////
	if ($CONF["MAINTENANCE_MODE_ON"]) {
		if (!$GLOBALS["CHROMELESS_MODE"] and (me('is_administrator') or me('is_super_administrator'))) {

			$tpl = new template;
			$tpl -> Load($CONF["MAINTENANCE_MODE_ADMIN_TEMPLATE"]);
			$tpl -> Flush();
		}

		else if (!$GLOBALS["CHROMELESS_MODE"]) {
			$tpl = new template;
			$tpl -> Load($CONF["MAINTENANCE_MODE_TEMPLATE"]);
			$tpl -> Flush();
			(isset($_GET["L"])?$_GET["L"]="":false);
			$GLOBALS["CHROMELESS_MODE"] = true;
			die();
		}
	}

	// SWAP MODE HEADER HANDLING //////////////////////////////////////////////////////
	if (isset($_SESSION["swap_id"]) && !$GLOBALS["CHROMELESS_MODE"]) {
		$tpl = new template;
		$tpl -> Load("!theme/{$GLOBALS["THEME"]}/templates/GLOBALS/swap_mode.tpl");
		$tpl -> Flush();
	}

	// READ THE CALLED PAGE INTO AN OB BUFFER /////////////////////////////////////////
	ob_start("theme_ob_callback");

	/* Check if the user is banned */
	if (!(isset($GLOBALS["BANNED"]) && $GLOBALS["BANNED"])) {

		/* Run against the "L" call and form a path to the file to be loaded */
		if (isset($_GET["L"]) && $_GET["L"] != "") {

			$file = NULL;
			for ($i=0; $i <= count($load = explode(".", $_GET["L"]))-1; $i++) {
				if (($i != 0) && ($i != count($load))) { $file .= "/"; }
				$file .= $load[$i];
			}
		}

		/* Home Page */
		elseif ($GLOBALS["WAP_MODE"]) $file = $CONF["WAP_HOME_FILE"];
		else $file = $CONF["HOME_THEME_FILE"];

		/*
			Check access restrictions - If the user is an admin or a superadmin,
			it is defaulted to $grant. All other users are checked against
			the access database through the checkaccess function
		*/
		if (me('is_administrator') or me('is_superadministrator') or !isset($_GET["L"])) $grant = true;
		elseif (isset($load) && is_array($load) && in_array("admin", $load)) $grant = false;
		else $grant = checkaccess();

		if ($grant) {
			/* User is allowed to load the requested page. Let's try to do it. */
			if (!is_file("modules/{$file}.php")) echo $CONF["404_NOT_FOUND_ERROR_MESSAGE"]."\n";
			else {
				$GLOBALS["THIS_PATH"] = (isset($_GET["L"])?$_GET["L"]:"HOME");
				include ("modules/{$file}.php");
			}
		}

		else {
			/*
				User is NOT allowed to load the requested page. We will try to find
				an appropriate error template and throw it to the buffer. If we can't
				get one, we will just use the generic error message.
			*/
			if (isset($_GET["L"]) and is_file($errFile = "theme/templates/GLOBALS/errors/{$_GET["L"]}.tpl")) {
				echo "!";
				$tpl = new template;
				$tpl -> Load("!{$errFile}");
				$tpl -> Flush();
			}

			elseif (is_file($errFile = "theme/templates/GLOBALS/errors/generic.tpl")) {
				$tpl = new template;
				$tpl -> Load("!{$errFile}");
				$tpl -> Flush();
			}

			else echo $CONF["NO_ACCESS_MESSAGE"]."\n";
		}

	} else echo $GLOBALS["BANTEMPLATE"];

	ob_end_flush();

	// INCLUDE THE MAIN THEME FRAME AND PARSE IT //////////////////////////////////////
	function theme_ob_callback($buffer) {
		global $CONF;

		/*
			Some web servers (e.g. Apache) change the working directory of a script
			when calling the callback function. Removing the following on those
			servers will change the global path thus prevent PHPizabi from getting
			the theme file thus producing an error output. The following function
			will change the working directory back to its original value.
		*/
		if (!ckbool($CONF["IIS_COMPATIBILITY_MODE"]))
			@chdir(@dirname((strstr($_SERVER["SCRIPT_FILENAME"], $_SERVER["PHP_SELF"])
				? $_SERVER["SCRIPT_FILENAME"]
				: $_SERVER["PATH_TRANSLATED"]
			)));

		/*
			in WAP mode, no theme is required, each template constitutes
			the theme AND the template content. We will just flush the
			buffer to our WAP client.
		*/
		if ($GLOBALS["WAP_MODE"]) return $buffer;

		/*
			Handle the chromeless & WAP calls
		*/
		if ($GLOBALS["CHROMELESS_MODE"]) {
			$tpl = new template;
			$tpl -> LoadThis($buffer);
		}

		else {
			/*
				Handle unshared frame file for home
			*/
			if (!$CONF["SHARE_FRAME_FILE_WITH_HOME"] && (!isset($_GET["L"]) or $_GET["L"] == "" or $_GET["L"] == "HOME")) {
				$tpl = new template;
				$tpl -> LoadThis($buffer);
			}

			else {

				/*
					Check if the file exists
				*/
				if (is_file("theme/".$GLOBALS["THEME"]."/".$CONF["FRAME_THEME_FILE"])) {

					/*
						The THEME file is loaded into the template conversion
						system and procesed. The following will create the new
						template object and push the theme file content into
						its buffer
					*/
					$tpl = new template;
					$tpl -> LoadThis(file_get_contents("theme/".$GLOBALS["THEME"]."/".$CONF["FRAME_THEME_FILE"]));
				}

				/*
					There has been an error trying to load the theme file... Throw it.
				*/
				else return "Failed to load the theme frame and / or home file";
			}
		}

		/*
			We will now assign the generic theme-related replacement
			items, the JUMP call and the ThemePath values are passed
			with the next line.
		*/
		$tpl->AssignArray(array(
			"jump"=>$buffer,
			"themePath"=>"theme/{$GLOBALS["THEME"]}",
			"systemVersion"=>$GLOBALS["SYSTEM_VERSION"],
			"siteName"=>$CONF["SITE_NAME"],
			"siteURL"=>"http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF'])
		));

		/*
			Include the theme-based bufferProcParse function file if
			it exists, and run it on the buffer.
		*/
		if (is_file("theme/{$GLOBALS["THEME"]}/proc.inc.php") && include("theme/{$GLOBALS["THEME"]}/proc.inc.php")) {
			if (function_exists("bufferProcParse")) $buffer_flush_value = bufferProcParse($tpl->Flush(1));
		}
		if (!isset($buffer_flush_value)) $buffer_flush_value = $tpl->Flush(1);

		/*
			The following is the output compression and cleanup
			process. It will at first clean unnecessary codes
			from the output, then gunzip the buffer.
		*/
		if (!$GLOBALS["CHROMELESS_MODE"]) {

			if (ckbool($CONF["POST_PROCESS_CLEAN_OUTPUT"])) {
				$characters_entities = array('/\\r/', '/\\n/', '/\\t/', ' {2,}+/');
				$replacement_values = array('', '', '', ' ');
				$buffer_flush_value = preg_replace($characters_entities, $replacement_values, $buffer_flush_value);
			}

			if (ckbool($CONF["POST_PROCESS_COMPRESS_OUTPUT"]) and strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
				header("Content-Encoding: gzip");
				$buffer_flush_value = gzencode(
					$buffer_flush_value."<!-- Powered by {$GLOBALS["SYSTEM_VERSION"]} - http://www.phpizabi.org/?L= -->",
					$CONF["POST_PROCESS_COMPRESSION_RATE"]
				);
			}
			else $buffer_flush_value .= "<!-- Powered by {$GLOBALS["SYSTEM_VERSION"]} - http://www.phpizabi.org/?L= -->";
		}

		/*
			The template buffer is flushed and passed back to
			the OB system.
		*/
		return (!is_null($buffer_flush_value)?$buffer_flush_value:false);

	}

	// ACCESS CONTROL CHECKUP AND VALIDATION PROCEDURE ////////////////////////////////
	function checkaccess() {
		global $CONF;

		/*
			Automatically allow admins to load any page
			without any verification.
		*/
		if (me("is_administrator") || me("is_superadministrator")) return true;

		else {

			/*
				Make sure we got a L key or return true...
			*/
			if (!isset($_GET["L"]) or $_GET["L"] == "") return true;

			/*
				Lane is a bit special... let's let it go
			*/
			if ($_GET["L"] == "lane.lane") return true;

			/*
				Load the user's page loads history and
				set the actual date ustamp
			*/
			if (!is_array($history = unpk(me("act_history")))) $history = array();
			$uStamp = date("U", mktime(0,0,0,date("m"),date("d"),date("Y")));

			/*
				Load the access control array
			*/
			if (!is_array($accessControl = unpk(file_get_contents("system/cache/access.dat")))) $accessControl = array();

			/*
				Check if the user's account type is
				a part of the access control array
			*/
			if (me("account_type") != 0 && isset($accessControl[me("account_type")])) {
				if (isset($accessControl[me("account_type")][$_GET["L"]])) {
					if (
						($accessControl[me("account_type")][$_GET["L"]]["ALLOW"])
						&&
						(
							(
								$accessControl[me("account_type")][$_GET["L"]]["BYCOUNT"] != 0
								&&
								$accessControl[me("account_type")][$_GET["L"]]["BYCOUNT"] > $history[$_GET["L"]][$uStamp]
							)
							||
							$accessControl[me("account_type")][$_GET["L"]]["BYCOUNT"] == 0
						)
					) return true;
					else return false;
				} else return ($CONF["DEFAULT_ACCESS_RULE:ALLOW"] ? true : false);
			}

			/*
				If we got no account type, we will check
				if we're logged in or not
			*/
			elseif (isset($_SESSION["id"]) && isset($accessControl["U"])) {
				if (isset($accessControl["U"][$_GET["L"]])) {
					if (
						($accessControl["U"][$_GET["L"]]["ALLOW"])
						&&
						(
							(
								$accessControl["U"][$_GET["L"]]["BYCOUNT"] != 0
								&&
								$accessControl["U"][$_GET["L"]]["BYCOUNT"] > $history[$_GET["L"]][$uStamp]
							)
							||
							$accessControl["U"][$_GET["L"]]["BYCOUNT"] == 0
						)
					) return true;
					else return false;
				} else return ($CONF["DEFAULT_ACCESS_RULE:ALLOW"] ? true : false);
			}

			elseif (isset($accessControl["G"])) {
				if (isset($accessControl["G"][$_GET["L"]])) {
					if ($accessControl["G"][$_GET["L"]]["ALLOW"]) return true;
					else return false;
				} else return ($CONF["DEFAULT_ACCESS_RULE:ALLOW"] ? true : false);
			}

			/*
				No access restriction value found. Return the default
				access value instead.
			*/
			else return ($CONF["DEFAULT_ACCESS_RULE:ALLOW"] ? true : false);
		}
	}

	// LOGGING & STATISTICS APPENDING PROCESS /////////////////////////////////////////
	if ($CONF["LOG_ENABLED"] && !$GLOBALS["CHROMELESS_MODE"]) {
		$GLOBALS["LAST_LOG_ENTRY"] =
			 me('id').$CONF["LOG_DATA_SEPARATORS"]
			.me('username').$CONF["LOG_DATA_SEPARATORS"]
			.(isset($_SERVER["REMOTE_ADDR"])?$_SERVER["REMOTE_ADDR"]:false).$CONF["LOG_DATA_SEPARATORS"]
			.(isset($_SERVER["REMOTE_PORT"])?$_SERVER["REMOTE_PORT"]:false).$CONF["LOG_DATA_SEPARATORS"]
			.(isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:false).$CONF["LOG_DATA_SEPARATORS"]
			.(isset($_SERVER["HTTP_USER_AGENT"])?$_SERVER["HTTP_USER_AGENT"]:false).$CONF["LOG_DATA_SEPARATORS"]
			.(isset($_GET["L"])?$_GET["L"]:false).$CONF["LOG_DATA_SEPARATORS"]
			.date("U")
			.$CONF["LOG_LINE_SEPARATORS"];

		if ($CONF["LOG_DAILY_MODE"]) {
			$GLOBALS["LOGFILE"] = $CONF["LOG_DIRECTORY"]."/".date("U", mktime(0,0,0,date("m"),date("d"),date("Y"))).".".$CONF["LOG_FILE_EXTENTION"];
		} else {
			$GLOBALS["LOGFILE"] = $CONF["LOG_DIRECTORY"]."/".$CONF["LOG_UNILOG_FILE"];
		}

		if ($logHandle = @fopen($GLOBALS["LOGFILE"], 'a')) {
			fwrite($logHandle, $GLOBALS["LAST_LOG_ENTRY"]);
			fclose($logHandle);
		}
	}

	// UPDATE USER'S LASTLOAD & HISTORY ENTRY IN THE DATABASE /////////////////////////
	if (!isset($history)) if (!is_array($history = unpk(me("act_history")))) $history = array();

	if (isset($_GET["L"]) && !$GLOBALS["CHROMELESS_MODE"]) {
		$uStamp = date("U", mktime(0,0,0,date("m"),date("d"),date("Y")));
		(isset($history[$_GET["L"]][$uStamp]) ? $history[$_GET["L"]][$uStamp]++ : $history[$_GET["L"]][$uStamp] = 1);
	}

	myQ("
		UPDATE `[x]users`
		SET
			`last_load` = '".date("U")."',
			`act_history` = '".pk($history)."'
		WHERE `id`='".me('id')."'
	");

	unset($history);

	// SCHEDULED TASKS ////////////////////////////////////////////////////////////////
	/*
		Let's check if the CRON job has been running lately. We will run it if
		it hasnt been running for too long. This is a "random" process (like the
		garbage collector within PHP), if the site is popular enough to trigger the
		random often enough, it means that the cron job should be checked more often.
	*/
	if (rand(0,200) == 1) {

		/* Check the cron pid file last modification date */
		if (!is_file("system/cache/temp/cron_pid.dat") or filemtime("system/cache/temp/cron_pid.dat") < time() - 43200) {
			include_once("system/v_cron_proc.php");
		}
	}

	// CLOSE DATABASE LINK ////////////////////////////////////////////////////////////
	myClose();

	// CORE LEVEL FUNCTIONS ///////////////////////////////////////////////////////////
	function _fnc() {
		$args = func_get_args();
		$path = "system/functions/";

		if ($loc = strrpos($args[0], '/')) list($path, $func) = split('-l-', chunk_split($args[0], $loc+1, '-l-'));
		else $func = $args[0];

		unset($args[0]);

		if (!function_exists($func)) include_once($path.$func.'.php');
		return call_user_func_array($func, $args);
	}

	function me($content) {
		global $CONF;

		if ($content == "flush") {
			unset($GLOBALS["SELF_USER_DATA"]);
			session_unregister("SELF_USER_DATA");
			return true;
		}

		else {
			if (isset($GLOBALS["SELF_USER_DATA"])) {
				if (isset($GLOBALS["SELF_USER_DATA"][$content])) return $GLOBALS["SELF_USER_DATA"][$content];

				else {
					$me = myF(myQ("SELECT `{$content}` FROM `[x]users` WHERE `id`='{$_SESSION["id"]}' LIMIT 1"));
					return ($GLOBALS["SELF_USER_DATA"][$content] = $me[$content] ? $me[$content] : NULL);
				}

			}

			else if (isset($_SESSION["id"])) {
				$GLOBALS["SELF_USER_DATA"] = myF(myQ("
					SELECT `id`, `last_load`, `last_login`, `username`, `password`, `email`, `email_verified`, `city`,
						`state`, `country`, `zipcode`, `latitude`, `longitude`, `birthdate`, `age`, `gender`, `language`,
						`use_theme`, `mainpicture`, `account_type`, `is_administrator`
					FROM [x]users
					WHERE `id`='{$_SESSION["id"]}'
					LIMIT 1
				"));
				return me($content);
			}
		}
		return false;
	}

	function pk($data) {
		return urlencode(serialize($data));
	}

	function unpk($data) {
		return unserialize(urldecode($data));
	}

	function ckbool(&$var) {
		if (!isset($var)) return false;
		elseif ((bool)$var) return true;
		return false;
	}

	function is_op($id=NULL) {
		if (is_null($id))
			$id = me("id");

		$row = myF(myQ("
			SELECT `is_administrator`, `is_superadministrator`
			FROM `[x]users`
			WHERE `id` = '{$id}'
			LIMIT 1
		"));

		if ($row["is_administrator"] or $row["is_superadministrator"])
			return true;

		return false;
	}

	function is_mop($id=NULL) {
		if (is_null($id))
			$id = me("id");

		$row = myF(myQ("
			SELECT `is_moderator`, `is_administrator`, `is_superadministrator`
			FROM `[x]users`
			WHERE `id` = '{$id}'
			LIMIT 1
		"));

		if ($row["is_moderator"] or $row["is_administrator"] or $row["is_superadministrator"])
			return true;

		return false;
	}

?>
