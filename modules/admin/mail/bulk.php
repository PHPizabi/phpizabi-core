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
	$tpl -> Load("bulk");
	
	// HANDLE THE POST //////////////////////////////////////////////////////////
	if (isset($_POST["Submit"]) || isset($_POST["Preview"])) {
	
		// GENERATE USERS LIST ////////////////////////////////////////////////////
		/*
			Generate the users list
		*/
		switch($_POST["mode"]) {
		
			case("all"): default:
				$select = myQ("SELECT `id` FROM `[x]users`");
				while($row = myF($select)) (isset($usersList)?$usersList.=",".$row["id"]:$usersList=$row["id"]);
			break;
			
			case("active"):
				$select = myQ("SELECT `id` FROM `[x]users` WHERE `active`='1'");
				while($row = myF($select)) (isset($usersList)?$usersList.=",".$row["id"]:$usersList=$row["id"]);
			break;
			
			case("nonactive"):
				$select = myQ("SELECT `id` FROM `[x]users` WHERE `active`='0'");
				while($row = myF($select)) (isset($usersList)?$usersList.=",".$row["id"]:$usersList=$row["id"]);
			break;
			
			case("admin"):
				$select = myQ("SELECT `id` FROM `[x]users` WHERE (`is_administrator`='1' OR `is_superadministrator`='1')");
				while($row = myF($select)) (isset($usersList)?$usersList.=",".$row["id"]:$usersList=$row["id"]);
			break;
			
			case("cemail"):
				$select = myQ("SELECT `id` FROM `[x]users` WHERE `email_verified`='1'");
				while($row = myF($select)) (isset($usersList)?$usersList.=",".$row["id"]:$usersList=$row["id"]);
			break;
			
			case("uncemail"):
				$select = myQ("SELECT `id` FROM `[x]users` WHERE `email_verified`='0'");
				while($row = myF($select)) (isset($usersList)?$usersList.=",".$row["id"]:$usersList=$row["id"]);
			break;
			
			case("customlist"):
				$usersList = str_replace(" ", "", $_POST["userslist"]);
			break;
			
			case("customwhere"):
				$select = myQ("SELECT `id` FROM `[x]users` WHERE {$_POST["where"]}");
				while($row = myF($select)) (isset($usersList)?$usersList.=",".$row["id"]:$usersList=$row["id"]);
			break;

		}
		
		// PREVIEW MAIL //////////////////////////////////////////////////////////////////
		if (isset($_POST["Preview"])) {
		
			$tpl -> Zone("massmail", "preview");
			$tpl -> AssignArray(array(
				"users.count" => (isset($usersList)&&$usersList!=""?substr_count($usersList, ",")+1:0)
			));
		}
		
		// SEND MAILS /////////////////////////////////////////////////////////////////////
		if (isset($_POST["Submit"])) {
			
			/*
				Force the system to stay alive
			*/
			ignore_user_abort();
			set_time_limit(0);
			
			/* Include the mail class and prepare it for the mailing */
			include_once("system/functions/classes/mail.class.php");
			
			$mail = new SendMail;
			$mail -> From = 			"{$CONF["SITE_NAME"]} <{$CONF["SITE_SYSTEM_EMAIL"]}>";
			$mail -> Subject = 			$_POST["subject"];
			$mail -> Body = 			$_POST["body"];
			$mail -> SMTPHost = 		$CONF["MAIL_SMTP_HOST"];
			$mail -> SMTPPort = 		$CONF["MAIL_SMTP_PORT"];
			$mail -> SMTPUser = 		$CONF["MAIL_SMTP_USER"];
			$mail -> SMTPPassword = 	$CONF["MAIL_SMTP_PASSWORD"];
			$mail -> SMTPTimeout = 		$CONF["MAIL_SMTP_TIMEOUT"];
			$mail -> MailMethod = 		$CONF["MAIL_METHOD"];
			$mail -> Charset = 			$CONF["MAIL_CHARSET"];
			$mail -> Encoding = 		$CONF["MAIL_ENCODING"];
			$mail -> SendmailPath = 	$CONF["MAIL_SENDMAIL_PATH"];
			
			
			$list = explode(",", $usersList);
			foreach ($list as $userId) {
				$mail -> To = _fnc("user", $userId, "email");
				$mail -> Send();
			}
			
			$tpl -> Zone("massmail", "success");
		}
		
	}
	
	/*
		Assign Replacement Array
	*/
	
	$tpl -> AssignArray(array(
		"field.subject" => (isset($_POST["subject"])?$_POST["subject"]:NULL),
		"field.userslist" => (isset($_POST["userslist"])?$_POST["userslist"]:(isset($_SESSION["BULK_LIST"])?implode(",", $_SESSION["BULK_LIST"]):NULL)),
		"field.where" => (isset($_POST["where"])?$_POST["where"]:NULL),
		"field.body" => (isset($_POST["body"])?$_POST["body"]:NULL),
		
		"ck.mode.all" => (!isset($_POST["mode"])||(isset($_POST["mode"])&&$_POST["mode"]=="all")?"selected":NULL),
		"ck.mode.active" => (isset($_POST["mode"]) && $_POST["mode"] == "active" ? "selected" : NULL),
		"ck.mode.nonactive" => (isset($_POST["mode"]) && $_POST["mode"] == "nonactive" ? "selected" : NULL),
		"ck.mode.admin" => (isset($_POST["mode"]) && $_POST["mode"] == "admin" ? "selected" : NULL),
		"ck.mode.cemail" => (isset($_POST["mode"]) && $_POST["mode"] == "cemail" ? "selected" : NULL),
		"ck.mode.uncemail" => (isset($_POST["mode"]) && $_POST["mode"] == "uncemail" ? "selected" : NULL),
		"ck.mode.customlist" => (isset($_POST["mode"]) && $_POST["mode"] == "customlist" ? "selected" : NULL),
		"ck.mode.customwhere" => (isset($_POST["mode"]) && $_POST["mode"] == "customwhere" ? "selected" : NULL)

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