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
	
	

	$tpl = new template;
	$tpl -> Load("settings");
	$tpl -> ConvertSelf();
	
	
	// HANDLE SUBMITTED NOTIFICATIONS BEHAVIOR CONFIG //
	if (isset($_POST["SubmitNotifications"])) {
		
		$mySettings = unpk(me("settings"));
		if (!is_array($mySettings)) $mySettings = array();
		
		/* Save submited data notification behavior configuration */
		if (!isset($_POST["notify_mail"]) || !is_array($_POST["notify_mail"])) $_POST["notify_mail"] = array();
		
		$mySettings["MAIL"]["NOTIFICATION"]["MESSAGES"] = (in_array("message", $_POST["notify_mail"])?true:false);
		$mySettings["MAIL"]["NOTIFICATION"]["EVENTS"] = (in_array("event", $_POST["notify_mail"])?true:false);
		$mySettings["MAIL"]["NOTIFICATION"]["BIRTHDAY"] = (in_array("birthday", $_POST["notify_mail"])?true:false);
		$mySettings["MAIL"]["NOTIFICATION"]["PROFILECOMMENT"] = (in_array("comment", $_POST["notify_mail"])?true:false);
		$mySettings["MAIL"]["NOTIFICATION"]["CONTACTREQUEST"] = (in_array("request", $_POST["notify_mail"])?true:false);
		$mySettings["MAIL"]["NOTIFICATION"]["NUDGE"] = (in_array("nudge", $_POST["notify_mail"])?true:false);

		if (!isset($_POST["notify_sms"]) || !is_array($_POST["notify_sms"])) $_POST["notify_sms"] = array();

		$mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["MESSAGES"] = (in_array("message", $_POST["notify_sms"])?true:false);
		$mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["EVENTS"] = (in_array("event", $_POST["notify_sms"])?true:false);
		$mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["BIRTHDAY"] = (in_array("birthday", $_POST["notify_sms"])?true:false);
		$mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["PROFILECOMMENT"] = (in_array("comment", $_POST["notify_sms"])?true:false);
		$mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["CONTACTREQUEST"] = (in_array("request", $_POST["notify_sms"])?true:false);
		$mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["NUDGE"] = (in_array("nudge", $_POST["notify_sms"])?true:false);

		myQ("UPDATE `[x]users` SET `settings`='".pk($mySettings)."' WHERE `id`='".me("id")."'");
	}


	// HANDLE SUBMITTED MOBILE BEHAVIOR CONFIG //
	if (isset($_POST["SubmitMobile"])) {
		
		if (!isset($mySettings)) $mySettings = unpk(me("settings"));
		if (!is_array($mySettings)) $mySettings = array();

		$mySettings["MOBILE"]["SMSADDRESS"] = (preg_match($CONF["REGEXP_EMAIL"], $_POST["sms_address"])?$_POST["sms_address"]:NULL);
		$mySettings["MOBILE"]["TRUSTCONTACTS"] = (ckbool($_POST["sms_trustcontacts"])?true:false);
		$mySettings["MOBILE"]["EXCLUDEONLINE"] = (ckbool($_POST["sms_excludeonline"])?true:false);
		
		myQ("UPDATE `[x]users` SET `settings`='".pk($mySettings)."' WHERE `id`='".me("id")."'");

	}
	
	// HANDLE SUBMITTED DISPLAY SETTINGS //
	if (isset($_POST["SubmitDisplay"])) {
		
		if (!isset($mySettings)) $mySettings = unpk(me("settings"));
		if (!is_array($mySettings)) $mySettings = array();
		
		$mySettings["RANDOM_DISPLAY"]["GENDER"] = (isset($_POST["random_gender"]) ? $_POST["random_gender"] : NULL);
		
		myQ("
			UPDATE `[x]users` 
			SET 
				`use_theme` = '{$_POST["theme"]}', 
				`language`='{$_POST["language"]}',
				`settings`='".pk($mySettings)."'
			WHERE `id`='".me('id')."' 
			LIMIT 1
		");
	}


	// POPULATE FORM FIELDS ///////////////////////////////////////////////////////////////////////////
	/*
		Load the preferences array
	*/
	if (!isset($mySettings)) $mySettings = unpk(me("settings"));
	if (!is_array($mySettings)) $mySettings = array();
	
	$tpl -> AssignArray(array(
		"no.ma.ck.message" => (ckbool($mySettings["MAIL"]["NOTIFICATION"]["MESSAGES"])?"checked":NULL),
		"no.ma.ck.event" => (ckbool($mySettings["MAIL"]["NOTIFICATION"]["EVENTS"])?"checked":NULL),
		"no.ma.ck.birthday" => (ckbool($mySettings["MAIL"]["NOTIFICATION"]["BIRTHDAY"])?"checked":NULL),
		"no.ma.ck.comment" => (ckbool($mySettings["MAIL"]["NOTIFICATION"]["PROFILECOMMENT"])?"checked":NULL),
		"no.ma.ck.request" => (ckbool($mySettings["MAIL"]["NOTIFICATION"]["CONTACTREQUEST"])?"checked":NULL),
		"no.ma.ck.nudge" => (ckbool($mySettings["MAIL"]["NOTIFICATION"]["NUDGE"])?"checked":NULL),

		"no.sms.ck.message" => (ckbool($mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["MESSAGES"])?"checked":NULL),
		"no.sms.ck.event" => (ckbool($mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["EVENTS"])?"checked":NULL),
		"no.sms.ck.birthday" => (ckbool($mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["BIRTHDAY"])?"checked":NULL),
		"no.sms.ck.comment" => (ckbool($mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["PROFILECOMMENT"])?"checked":NULL),
		"no.sms.ck.request" => (ckbool($mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["CONTACTREQUEST"])?"checked":NULL),
		"no.sms.ck.nudge" => (ckbool($mySettings["MOBILE"]["SMS"]["NOTIFICATION"]["NUDGE"])?"checked":NULL),
		
		"sms_address" => (isset($mySettings["MOBILE"]["SMSADDRESS"])?$mySettings["MOBILE"]["SMSADDRESS"]:NULL),
		"mob.ck.trustcontacts" => (ckbool($mySettings["MOBILE"]["TRUSTCONTACTS"])?"checked":NULL),
		"mob.ck.excludeonline" => (ckbool($mySettings["MOBILE"]["EXCLUDEONLINE"])?"checked":NULL),

	));
	
	
	/* Populate the site themes */
	if ($handle = opendir("theme/")) {

		$themeInUse = (me("use_theme") != "" ? me("use_theme") : $CONF["DEFAULT_THEME"]);

		while (false !== ($file = readdir($handle))) {
		
			if ($file != "." and $file != ".." and $file != "templates" and is_dir("theme/".$file)) {
				$themesReplacementArray[] = array(
					"theme" => $file,
					"select" => ($file == $themeInUse ? "selected=\"selected\"" : ""),
				);
			}
		}
		closedir($handle);
	}
	$tpl -> Loop("themes", $themesReplacementArray);
	
	/* Populate the language */
	$langInUse = (me("language") != "" ? me("language") : $CONF["LOCALE_SITE_DEFAULT_LANGUAGE"]);
	
	foreach (explode(",", $CONF["LOCALE_SITE_LANGUAGES"]) as $language) {
		$languagesReplacementArray[] = array(
			"language" => $language,
			"select" => ($language == $langInUse ? "selected=\"selected\"" : ""),
		);
	}
	$tpl -> Loop("languages", $languagesReplacementArray);
	
	/* Populate the genders */
	$genders = explode(",", $CONF["USERS_GENDERS"]);
	if (!isset($mySettings)) $mySettings = unpk(me("settings"));
	if (!is_array($mySettings)) $mySettings = array();

	$randomGender = (isset($mySettings["RANDOM_DISPLAY"]["GENDER"]) ? $mySettings["RANDOM_DISPLAY"]["GENDER"] : NULL);
		
	foreach ($genders as $genderType) {
		
		$genderReplacementArray[] = array(
			"g.gender" => $genderType,
			"g.select" => ($randomGender == $genderType ? "selected=\"selected\"" : ""),
		);
	}
	$tpl -> Loop("genders", $genderReplacementArray);
	//


	$tpl -> Flush();
	
	
	
	
	/* PREFERENCES ARRAY DETAILS */
	
	/*
	
		$mySettings = unpk(me("settings"));
		if (!is_array($mySettings)) $mySettings = array();
	
		[x]users > settings

		$pref["MAIL"]["NOTIFICATION"]["MESSAGES"] = true/false   ( notification for new messages)
		$pref["MAIL"]["NOTIFICATION"]["EVENTS"] = true/false     ( notification for incomming events)
		$pref["MAIL"]["NOTIFICATION"]["BIRTHDAY"] = true/false   ( notifiaction for contact birthday)
		$pref["MAIL"]["NOTIFICATION"]["PROFILECOMMENT"] = true/false ( notification for new profile comment)
		$pref["MAIL"]["NOTIFICATION"]["CONTACTREQUEST"] = true/false ( notification for new contact request)
		$pref["MAIL"]["NOTIFICATION"]["NUDGE"] = true/false      ( notification for new nudge)

		$pref["MOBILE"]["SMSADDRESS"] = xxx  (sms address)
		
		$pref["MOBILE"]["SMS"]["NOTIFICATION"]["MESSAGES"] = true/false   (sms notification for new messages)
		$pref["MOBILE"]["SMS"]["NOTIFICATION"]["EVENTS"] = true/false     (sms notification for incomming events)
		$pref["MOBILE"]["SMS"]["NOTIFICATION"]["BIRTHDAY"] = true/false   (sms notifiaction for contact birthday)
		$pref["MOBILE"]["SMS"]["NOTIFICATION"]["PROFILECOMMENT"] = true/false (sms notification for new profile comment)
		$pref["MOBILE"]["SMS"]["NOTIFICATION"]["CONTACTREQUEST"] = true/false (sms notification for new contact request)
		$pref["MOBILE"]["SMS"]["NOTIFICATION"]["NUDGE"] = true/false      (sms notification for new nudge)
		
		
		$mySettings["MOBILE"]["TRUSTCONTACTS"] = true/false (only send sms when I'm not online)
		$mySettings["MOBILE"]["EXCLUDEONLINE"] true/false (forward PAGE from my contacts to SMS)

	*/

?>