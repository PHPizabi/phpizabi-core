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
	$tpl -> Load("edit");
	$tpl -> GetObjects();
	
	// HANDLE CLEAR REQUEST ////////////////////////////////////////////////////////////
	if (isset($_GET["clear"])) {
		$clearAllowArray = array(
			"profile_data", "pictures", "mainpicture", "contacts", "relationship_request", 
			"block", "profile_views", "profile_votes", "picture_votes", "favorites", "nudges", 
			"settings", "disable_until"
		);
		
		if (in_array($_GET["clear"], $clearAllowArray)) {
			myQ("UPDATE `[x]users` SET `{$_GET["clear"]}`='' WHERE `id`='{$_GET["id"]}`'");
			echo "CLEARED";
		}
	}
	
	// HANDLE POSTED FORM //////////////////////////////////////////////////////////////
	if (isset($_POST["Submit"])) {
		
		myQ("
			UPDATE `[x]users` SET
			`username`='{$_POST["username"]}',
			`email`='{$_POST["email"]}',
			`city`='{$_POST["city"]}',
			`state`='{$_POST["state"]}',
			`country`='{$_POST["country"]}',
			`zipcode`='{$_POST["zipcode"]}',
			`latitude`='{$_POST["latitude"]}',
			`longitude`='{$_POST["longitude"]}',
			`timezone`='{$_POST["timezone"]}',
			`birthdate`='{$_POST["birthdate"]}',
			`gender`='{$_POST["gender"]}',
			`language`='{$_POST["language"]}',
			`quote`='{$_POST["quote"]}',
			`header`='{$_POST["header"]}',
			`account_type`='{$_POST["account_type"]}',
			`account_expire`='{$_POST["account_expire"]}',
			`email_verified`='".(isset($_POST["email_verified"])?1:0)."',
			`active`='".(isset($_POST["active"])?1:0)."',
			`is_administrator`='".(isset($_POST["is_administrator"])?1:0)."',
			`is_moderator`='".(isset($_POST["is_moderator"])?1:0)."'
			WHERE `id`='{$_GET["id"]}'
		");
		echo "UPDATED";
	}
	
	// PRINT DATA //////////////////////////////////////////////////////////////////////
	$user = myF(myQ("SELECT * FROM `[x]users` WHERE `id`='{$_GET["id"]}'"));
	
	$tpl -> AssignArray(array(
		"user.id" => $user["id"],
		"user.username" => $user["username"],
		"user.last_load" => ($user["last_load"] > 0 ? date($CONF["LOCALE_HEADER_DATE_TIME"], $user["last_load"]) : 0),
		"user.last_login" => ($user["last_login"] > 0 ? date($CONF["LOCALE_HEADER_DATE_TIME"], $user["last_login"]) : 0),
		"user.email" => $user["email"],
		"user.city" => $user["city"],
		"user.state" => $user["state"],
		"user.country" => $user["country"],
		"user.zipcode" => $user["zipcode"],
		"user.latitude" => $user["latitude"],
		"user.longitude" => $user["longitude"],
		"user.timezone" => $user["timezone"],
		"user.birthdate" => $user["birthdate"],
		"user.gender" => $user["gender"],
		"user.language" => $user["language"],
		"user.quote" => $user["quote"],
		"user.header" => $user["header"],
		"user.mainpicture" => $user["mainpicture"],
		"user.disable_until" => ($user["disable_until"] > 0 ? date($CONF["LOCALE_HEADER_DATE_TIME"], $user["disable_until"]):0),
		"user.account_type" => $user["account_type"],
		"user.account_expire" => $user["account_expire"],
		"user.registration_date" => ($user["registration_date"] > 0 ? date($CONF["LOCALE_HEADER_DATE_TIME"], $user["registration_date"]):0),
		"user.registration_reference" => $user["registration_reference"]
	
	));
	
	
	//$tpl -> AssignUser($_GET["id"]);
	
	$user = myF(myQ("SELECT * FROM `[x]users` WHERE `id`='{$_GET["id"]}'"));
	
	$tpl -> AssignArray(array(
		"d.profiledata" => round(strlen($user["profile_data"])/1024, 2),
		"d.pictures" => round(strlen($user["pictures"])/1024, 2),
		"d.contacts" => round(strlen($user["contacts"])/1024, 2),
		"d.relationship_requests" => round(strlen($user["relationship_requests"])/1024, 2),
		"d.block" => round(strlen($user["block"])/1024, 2),
		"d.profile_views" => round(strlen($user["profile_views"])/1024, 2),
		"d.profile_votes" => round(strlen($user["profile_votes"])/1024, 2),
		"d.pictures_votes" => round(strlen($user["pictures_votes"])/1024, 2),
		"d.favorites" => round(strlen($user["favorites"])/1024, 2),
		"d.nudges" => round(strlen($user["nudges"])/1024, 2),
		"d.settings" => round(strlen($user["settings"])/1024, 2),
		
		"c.email_verified" => ($user["email_verified"]?"checked":NULL),
		"c.active" => ($user["active"]?"checked":NULL),
		"c.is_administrator" => ($user["is_administrator"]?"checked":NULL),
		"c.is_moderator" => ($user["is_moderator"]?"checked":NULL)
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