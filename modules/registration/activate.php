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

	if (me("id")) _fnc("reload", 0, "?L=users.desktop");

	$tpl = new template;
	$tpl -> Load("activate");
	
	if (isset($_POST["Submit"]) and !me("id")) {
		
		if ($_POST["email"] != "") 
			$userRow = myF(myQ("
				SELECT * 
				FROM `[x]users` 
				WHERE LCASE(`email`) = '".strtolower($_POST["email"])."'
				LIMIT 1
			"));
		
		else if ($_POST["username"] != "") 
			$userRow = myF(myQ("
				SELECT * 
				FROM `[x]users` 
				WHERE LCASE(`username`) = '".strtolower($_POST["username"])."'
				LIMIT 1
			"));
			
		else $tpl -> Zone("reactivate", "error");
		
		if ($userRow["id"] > 0) {
			
			/*
				Send the mail out!
			*/
			$mail = new template;
			$mail -> LoadThis(file_get_contents("theme/templates/GLOBALS/mails/activate.tpl"));
			$mail -> AssignArray(array(
				"site.name" => $CONF["SITE_NAME"],
				"site.url" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF']),
				"reg.confirmURL" => "?L=registration.confirm&id={$userRow["id"]}&code=".md5($userRow["email"].$userRow["username"].$userRow["password"]),
				"username" => $userRow["username"]
			));
			
			/*
				Split the body and the subject, then
				send the mail
			*/
			$mailContent = explode("\n", $mail->Flush(1), 2);
			
			/* Include the mail class and prepare it for the mailing */
			include_once("system/functions/classes/mail.class.php");
																	
			$mail = new SendMail;
			$mail -> From = 			"{$CONF["SITE_NAME"]} <{$CONF["SITE_SYSTEM_EMAIL"]}>";
			$mail -> To =				$userRow["email"];
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
			
			$tpl -> Zone("reactivate", "completed");
		
		}
		
		else $tpl -> Zone("reactivate", "error");
			
	}
	
	else $tpl -> Zone("reactivate", "enabled");
	
	$tpl -> Flush();
?>