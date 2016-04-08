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
	$tpl -> Load("contact");
	
	$tpl -> AssignArray(array("site.name" => $CONF["SITE_NAME"]));
	
	/*
		Decompose and prepare the contacts array
	*/
	$contactsArray = explode(",", $CONF["SITE_CONTACT_US"]);
	
	/*
		Loop in the contacts array, generate the replacement array
		and the destination array
	*/
	$i=0;
	foreach($contactsArray as $contactMatch) {
		$contact = explode(":", $contactMatch);
		$contactsReplacementArray[$i]["contact.option"] = $contact[0];

		/*
			Prepare the destinations array
		*/
		$contactDestination[$contact[0]] = $contact[1];
		
		$i++;
	}

	/*
		Assign the array to loop
	*/
	if (isset($contactsReplacementArray)) $tpl -> Loop("contactOptions", $contactsReplacementArray);
	
	
	// HANDLE POST /////////////////////////////////////////////////////////////////////
	if (isset($_POST["Submit"])) {
		
		if (isset($_POST["destination"]) && isset($_POST["body"]) && $_POST["body"] != "") {
			
			$mail = new template;
			$mail -> LoadThis(file_get_contents("theme/templates/GLOBALS/mails/contact.tpl"));
			$mail -> ConvertSelf();
			$mail -> AssignArray(array(
				"contact.body" => $_POST["body"],
				"site.name" => $CONF["SITE_NAME"],
				"site.url" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF'])
			));
			
			
			/*
				Lets see... Is this an email address? If it
				is, we send an email out, if not, we send
				an internal mail instead...
			*/
			if (preg_match($CONF["REGEXP_EMAIL"], $contactDestination[$_POST["destination"]])) {
				
				/*
					Split the body and the subject, then
					send the mail
				*/
				$mailContent = explode("\n", $mail->Flush(1), 2);

				/* Include the mail class and prepare it for the mailing */
				include_once("system/functions/classes/mail.class.php");
											
				$mail = new SendMail;
				$mail -> From = 			"{$CONF["SITE_NAME"]} <{$CONF["SITE_SYSTEM_EMAIL"]}>";
				$mail -> To =				$contactDestination[$_POST["destination"]];
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
				
				$tpl -> Zone("contactHeader", "success");

			} 
			
			/*
				Internal mail mode
			*/
			else {
				
				/*
					Get the destination user's id from the database
				*/
				$userRow = myF(myQ("
					SELECT `username`,`id`
					FROM `[x]users` 
					WHERE LCASE(`username`) = '".strtolower($contactDestination[$_POST["destination"]])."'
					LIMIT 1
				"));
				
				if ($userRow["id"] != "") {
					
					/*
						Split the subject and the body
					*/
					$mailContent = explode("\n", $mail->Flush(1), 2);
					
					/*
						Save that
					*/
					myQ("
						INSERT INTO `[x]messages`
						(`to`,`from`,`subject`,`body`,`box`,`date`) 
						VALUES
						(
							'{$userRow["id"]}',
							'".(me('id')!=""?me('id'):"0")."',
							'{$mailContent[0]}',
							'{$mailContent[1]}',
							'{$CONF["MAILS_INBOX_NAME"]}',
							'".date("U")."'
						)
					");
					
					/*
						Mail sent successfully, say the word!
					*/
					$tpl -> Zone("contactHeader", "success");
				}
				
				/*
					user does not exist, we're in troubles!
				*/
				else $tpl -> Zone("contactHeader", "internalError");			
			}
		}
		
		else $tpl -> Zone("contactHeader", "emptyBody");
	}
	
	
	else $tpl -> Zone("contactHeader", "enabled");
	
	
	
	
	$tpl -> Flush();
	
?>