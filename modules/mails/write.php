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
	$tpl -> load("write");
	
	// HANDLE MAIL POST //////////////////////////////////////////////////
	/* 
		A mail has been sent ...
	*/
	if (isset($_POST["Submit"]) && me("id")!="") {
		
		/*
			Flood control... We will check if a lastmail value
			exists, and if it is greater than the minimal value.
		*/
		if (
			(isset($_SESSION["LAST_SENT_MAIL"]) && $_SESSION["LAST_SENT_MAIL"]+$CONF["MAILS_MIN_REMAIL_DELAY"] < date("U")) 
			|| 
			(!isset($_SESSION["LAST_SENT_MAIL"]))
		) {
		
			/*
				Find out to who the mail is supposed to be
				sent - if a username is specified in the "to contact"
				dropdown field, it will be prioritized over the
				others
			*/		
			if (isset($_POST["contact"]) && $_POST["contact"] != "") $username = $_POST["contact"];
			elseif (isset($_POST["username"]) && $_POST["username"] != "") $username = $_POST["username"];
			
			if (isset($username)) {
				
				/*
					Now make sure the subject and body are not 
					empty
				*/
				if (isset($_POST["subject"]) && $_POST["subject"] != "" && isset($_POST["body"]) && $_POST["body"] != "") {
					
					/*
						Get the user's array from the database and
						make sure the user exists
					*/
					$userRow = myF(myQ("SELECT `id`,`username` FROM `[x]users` WHERE LCASE(`username`)='".strtolower($username)."'"));
					
					if (!$userRow["id"]) {
						
						if ($username != "") {
							/*
								OoPs... That username doesn't exist. Can we find
								another username?
							*/
							$usernameSoundRow = myF(myQ("
								SELECT `username` 
								FROM `[x]users` 
								WHERE `username` SOUNDS LIKE '{$username}'
								LIMIT 1"
							));
							
							/*
								Yeah there was something similar, we will show
								the suggestion zone and give it a username value
							*/
							if ($usernameSoundRow["username"] != "") {
								
								$tpl->Zone("usernameSuggest", "enabled");
								$tpl->AssignArray(array("usernameSuggest.username"=>$usernameSoundRow["username"]));
							
							}
						}
					
						/*
							Show the template zone saying no such
							user name exists on this system
						*/
						$tpl -> Zone("sendMailHeader", "noSuchUser");
					} 
					
					/*
						A user has been found.. let's get that user's block array
						and make sure we're not blocked
					*/
					else {
						
						$blockList = unpk(_fnc("user", $userRow["id"], "block"));
						if (!is_array($blockList)) $blockList = array();
						
						/*
							So .. are we?
						*/
						if (!in_array(me("id"), $blockList)) {
							
							/* Check user's quota */
							myQ("SET GROUP_CONCAT_MAX_LEN = ".($CONF["MAILS_QUOTA_MAX_KILOBYTES"] * 1024));
							$mailBoxLen = myF(myQ("
								SELECT LENGTH(GROUP_CONCAT(`body` SEPARATOR '')) AS `body_len` 
								FROM `[x]messages` 
								WHERE (
									(`to` = '{$userRow["id"]}' AND `sent_copy` != '1') 
									OR
									(`from` = '{$userRow["id"]}' AND `sent_copy` = '1')
								)
							"));

							if ($mailBoxLen["body_len"] < (($CONF["MAILS_QUOTA_MAX_KILOBYTES"] * 1024) - 1)) {
								
								/*
									Ok everything is fine, let's send the mail!
								*/
								myQ("
									INSERT INTO `[x]messages`
									(`to`,`from`,`subject`,`body`,`box`,`date`,`sent_copy`) 
									VALUES
									(
										'{$userRow["id"]}',
										'".me('id')."',
										'{$_POST["subject"]}',
										'{$_POST["body"]}',
										'{$CONF["MAILS_INBOX_NAME"]}',
										'".date("U")."',
										'0'
									)
								");
								
								if ($CONF["MAILS_AUTO_KEEP_SENT"]) {
									myQ("
										INSERT INTO `[x]messages`
										(`to`,`from`,`subject`,`body`,`date`,`read`,`sent_copy`) 
										VALUES
										(
											'{$userRow["id"]}',
											'".me('id')."',
											'{$CONF["MAILS_SENT_SUBJECT_PREFIX"]} {$userRow["username"]} {$_POST["subject"]}',
											'{$_POST["body"]}',
											'".date("U")."',
											'1',
											'1'
										)
									");
								}
								
								// CREATE A LANE TOKEN //////////////////////////////////////////////////////////////////////
								_fnc("laneMakeToken", "new_mail", $userRow["id"], array(
									"{user.username}" => me("username"),
									"{user.id}" => me("id")							
								));
								
								// SEND NOTIFICATION ///////////////////////////////////////////////////////////////////////
								if (is_file("theme/templates/GLOBALS/mails/notification_newmail.tpl")) {
									$nBuf = file_get_contents("theme/templates/GLOBALS/mails/notification_newmail.tpl");
								
									$mailContent =  explode("\n", strtr($nBuf, array(
										"{touser.username}" => _fnc("user", $userRow["id"], "username"),
										"{site.name}" => $CONF["SITE_NAME"],
										"{fromuser.username}" => me("username"),
										"{site.url}" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF'])
									)), 2);
	
									$userSettings = unpk(_fnc("user", $userRow["id"], "settings"));
									if (!is_array($userSettings)) $userSettings = array();
	
									if (ckbool($userSettings["MAIL"]["NOTIFICATION"]["MESSAGES"])) {
					
										/* Send the mail */
										/* Include the mail class and prepare it for the mailing */
										include_once("system/functions/classes/mail.class.php");
																	
										$mail = new SendMail;
										$mail -> From = 			"{$CONF["SITE_NAME"]} <{$CONF["SITE_SYSTEM_EMAIL"]}>";
										$mail -> To =				_fnc("user", $userRow["id"], "email");
										$mail -> Subject = 			$mailContent[0];
										$mail -> Body = 			$mailContent[1];
										$mail -> SMTPHost = 		$CONF["MAIL_SMTP_HOST"];
										$mail -> SMTPPort = 		$CONF["MAIL_SMTP_PORT"];
										$mail -> SMTPUser = 		$CONF["MAIL_SMTP_USER"];
										$mail -> SMTPPassword = 	$CONF["MAIL_SMTP_PASSWORD"];
										$mail -> SMTPTimeout = 		$CONF["MAIL_SMTP_TIMEOUT"];
										$mail -> MailMethod = 		$CONF["MAIL_METHOD"];
										$mail -> Charset = 			$CONF["MAIL_CHARSET"];
										$mail -> Encoding = 		$CONF["MAIL_ENCODING"];
										$mail -> SendmailPath = 	$CONF["MAIL_SENDMAIL_PATH"];
										$mail -> Send();										

									}
				
									if (
										ckbool($userSettings["MOBILE"]["SMS"]["NOTIFICATION"]["MESSAGES"])
										&&
									(
											!ckbool($userSettings["MOBILE"]["EXCLUDEONLINE"])
											||
											($userSettings["MOBILE"]["EXCLUDEONLINE"] && _fnc("user", $userRow["id"], "last_load") < date("U")-300)
										)								
									) {

										/* Include the mail class and prepare it for the mailing */
										include_once("system/functions/classes/mail.class.php");
										
										$mail = new SendMail;
										$mail -> From = 			"{$CONF["SITE_NAME"]} <{$CONF["SITE_SYSTEM_EMAIL"]}>";
										$mail -> To =				$userSettings["MOBILE"]["SMSADDRESS"];
										$mail -> Subject = 			$mailContent[0];
										$mail -> Body = 			$mailContent[1];
										$mail -> SMTPHost = 		$CONF["MAIL_SMTP_HOST"];
										$mail -> SMTPPort = 		$CONF["MAIL_SMTP_PORT"];
										$mail -> SMTPUser = 		$CONF["MAIL_SMTP_USER"];
										$mail -> SMTPPassword = 	$CONF["MAIL_SMTP_PASSWORD"];
										$mail -> SMTPTimeout = 		$CONF["MAIL_SMTP_TIMEOUT"];
										$mail -> MailMethod = 		$CONF["MAIL_METHOD"];
										$mail -> Charset = 			$CONF["MAIL_CHARSET"];
										$mail -> Encoding = 		$CONF["MAIL_ENCODING"];
										$mail -> SendmailPath = 	$CONF["MAIL_SENDMAIL_PATH"];
										$mail -> Send();	

									}
								}
								
								
								/*
									Set the last mail session value (flood control)
								*/
								$_SESSION["LAST_SENT_MAIL"] = date("U");
								
								/*
									Tell the user
								*/
								$tpl -> Zone("sendMailHeader", "success");
								_fnc("reload", 2, "?L=mails.mails");
							}
							
							/* 
								User is over quota 
							*/
							else $tpl -> Zone("sendMailHeader", "quota");
							
						}
		
						/*
							Oh la la, we're blocked! Let's show 
							an error message
						*/
						else $tpl -> Zone("sendMailHeader", "blocked");
	
					}
				}
				
				/*
					The subject field or the body field was empty, let's show 
					a message
				*/
				else $tpl -> Zone("sendMailHeader", "emptyField");
	
			}
	
			/*
				No username specified
			*/
			else $tpl -> Zone("sendMailHeader", "noUserSpecified");
		}
		
		else {
			/*
				Host is mailflooding ... we will give the lsm value
				the actual date and show the messsage
			*/
			$_SESSION["LAST_SENT_MAIL"] = date("U");
			$tpl -> Zone("sendMailHeader", "floodControl");
		}
	} 
		
	/*
		Form was not posted, show the normal welcome header
	*/
	else $tpl -> Zone("sendMailHeader", "enabled");
	
	// DEAL WITH GUESTS ////////////////////////////////////////////////////////
	if (me("id")!="") $tpl->Zone("sendMailForm", "enabled");
	else $tpl->Zone("sendMailForm", "guest");
	
	// POST FIELDS POPULATION /////////////////////////////////////////////////
	/*
		We will populate the form fields with what was posted,
		so the user doesn't have to start over writing a long
		mail! We're so fine :)
	*/
	$tpl->AssignArray(array(
		"post.body"=>(isset($_POST["body"])?$_POST["body"]:NULL),
		"post.subject"=>(isset($_POST["subject"])?$_POST["subject"]:NULL),
		"post.username"=>(isset($_POST["username"])?$_POST["username"]:(isset($_GET["to"])?$_GET["to"]:NULL))
	));

	// CONTACTS LIST ///////////////////////////////////////////////////////////
	/* 
		List contacts groups 
	*/
	if (me("id")) {
		$myContacts = unpk(me("contacts"));
		$i=0;
		if (is_array($myContacts)) foreach($myContacts as $groupName => $usersArray) {
			if (is_array($usersArray)) foreach($usersArray as $userID) {
				$contactsReplacementArray[$i]["contact.username"] = _fnc("user", $userID, "username");
				$i++;
			}
		}
	
		/*
			Loop the array if it exists
		*/
		if (isset($contactsReplacementArray) && is_array($contactsReplacementArray)) {
			$tpl -> Zone("contactsListDropdown", "enabled");
			$tpl -> Loop("contactsListDropdownOptions", $contactsReplacementArray);
		}
		
		else $tpl -> Zone("contactsListDropdown", "noContact");
	}
	
		
	$tpl -> CleanZones();
	$tpl -> Flush();
	
?>