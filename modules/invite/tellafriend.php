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
	$tpl -> Load("tellafriend");
	$tpl -> GetObjects();
	
	/*
		Let's see if we got an origin value, set one
		if we got nothing
	*/
	if (isset($_GET["origin"])) $origin = base64_decode($_GET["origin"]);
	else $origin = "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF']);
	
	/*
		Assign the origin address to the template
	*/
	$tpl -> AssignArray(array("origin.address" => substr($origin, 0, 40)));
	
	
	// HANDLE POST /////////////////////////////////////////////////////////////////////
	if (isset($_POST["Submit"]) && isset($_POST["email"])) {
			
		$emailAddressesArray = explode(",", $_POST["email"]);
			
		foreach ($emailAddressesArray as $email) {
		
			$email = trim($email);
		
			if (preg_match($CONF["REGEXP_EMAIL"], $email)) {
		
				if (isset($_POST["type"]) && $_POST["type"] == "invite") {
				
					// INVITE MODE //
				
					$mail = new template;
					$mail -> LoadThis(file_get_contents("theme/templates/GLOBALS/mails/invite.tpl"));
					$mail -> AssignArray(array(
						"invite.url" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF']),
						"invite.email" => $email,
						"invite.body" => $_POST["body"],
						"site.name" => $CONF["SITE_NAME"],
						"site.url" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF']),
						"me.username" => (me("username")?me("username"):$GLOBALS["OBJ"]["guest"])
					));
				
					$mailContent = explode("\n", $mail -> Flush(1), 2);
					mail($email, $mailContent[0], $mailContent[1]);
			
				} else {

					// TELL A FRIEND MODE //
						
					$mail = new template;
					$mail -> LoadThis(file_get_contents("theme/templates/GLOBALS/mails/tellafriend.tpl"));
					$mail -> AssignArray(array(
						"tell.url" => $origin,
						"tell.email" => $email,
						"tell.body" => $_POST["body"],
						"site.name" => $CONF["SITE_NAME"],
						"site.url" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF']),
						"me.username" => (me("username")?me("username"):$GLOBALS["OBJ"]["guest"])
					));
						
					$mailContent = explode("\n", $mail->Flush(1), 2);
					mail($email, $mailContent[0], $mailContent[1]);
				}
			}			
		}
	}
	
	$tpl -> Flush();
	
?>