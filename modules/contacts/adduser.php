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
	
	/* 
		Initialize the template engine and 
		load the template file
	*/
	$tpl = new template;
	$tpl -> Load("adduser");

	/*	
		Check if a user ID has been provided, and that
		it is valid.
	*/
	if (isset($_GET["id"]) && is_numeric($_GET["id"])) {		
		
		/*
			Ok a user ID has been provided... Let's tell
			the template system to convert that
		*/
		$tpl->AssignUser($_GET["id"]);
		
		/*
			Check if the user is trying to add him/herself to
			his/her own contacts list (nooo ... this isnt 
			allowed! This is just plain stupid ;)
		*/
		if (me('id') != $_GET["id"]) {

			/*
				We will load the actual user's contacts and
				prepare the array for further processing. If
				this is NOT an array, create one!
			*/
			$myContactsArray = unpk(me("contacts"));
			if (!is_array($myContactsArray)) $myContactsArray = array();
			
			/*
				Check if the user is already in the contacts
				array, we won't allow the same user twice
			*/
			if (!_fnc("in_multiarray", $myContactsArray, $_GET["id"])) {
			
				/*
					Load up the "blocked" users array and 
					check if the given user ID has been blocked
					as we don't allow blocked users to be in
					the contacts lists.
				*/
				$myBlockedUsers = unpk(me("block"));
				if ((is_array($myBlockedUsers) && !in_array($_GET["id"], $myBlockedUsers)) || (!is_array($myBlockedUsers))) {
				
					// HANDLE POSTED DATA /////////////////////////////////////////////////////////////////////
					/*
						Everything is ready, all checkups gone through,
						lets see if we got a confirmation to add this user!
					*/
					if (isset($_POST["addToThisGroup"])) {
						$myContactsArray[base64_decode($_POST["groupSelect"])][] = $_GET["id"];
						/*
							Update the db record entry
						*/
						myQ("UPDATE `[x]users` SET `contacts`='".pk($myContactsArray)."' WHERE `id`='".me("id")."'");
						
						/*
							We will check and remove the relationship request for
							self user as he/she may arrived here through that link. We
							don't want the relationship request from that user to be
							still there if the user added the 3rd user ;)
						*/
						// DISMISS RELATIONSHIP REQUEST ///////////////////////////////////////////////////
						/*
							Get the contacts notification array
						*/
						$relationshipArray = unpk(me("relationship_requests"));
						
						if (is_array($relationshipArray) && in_array($_GET["id"], $relationshipArray)) {
							/*
								Pop the element off the array
							*/
							$relationshipArray = _fnc("array_remove", $_GET["id"], $relationshipArray);
							
							/*
								Save the results
							*/
							myQ("
								UPDATE `[x]users` 
								SET `relationship_requests` = '".pk($relationshipArray)."' 
								WHERE `id`='".me("id")."'
							");
						}
						
						/*
							Give good news to the user
						*/
						$tpl->Zone("addContact", "success");
						_fnc("reload", 5, "?L=contacts.contacts");
						
						/*
							Get the third party user (GET[ID]) blocks dat and check
							if we're blocked!
						*/
						$userBlocksArray = unpk(_fnc("user", $_GET["id"], "block"));
						if ((is_array($userBlocksArray) && (!in_array(me("id"), $userBlocksArray))) || (!is_array($userBlocksArray))) {
							
							/*
								Ok we're not blocked (pheeew!) Lets get the third 
								party user (GET[ID]) relationship requests array and update it
								if the user is not already in the array
							*/
							$userRequestsArray = unpk(_fnc("user", $_GET["id"], "relationship_requests"));
							if (!is_array($userRequestsArray)) $userRequestsArray = array();
							
							/*
								Make sure we don't already have a resuest
							*/
							if (!in_array(me("id"), $userRequestsArray)) {
							
								/*
									Make sure we're not in the user's contacts list (we 
									won't add a request if we're already in his/her
									contacts)
								*/
								$userContactsArray = unpk(_fnc("user", $_GET["id"], "contacts"));
								if (!is_array($userContactsArray) || !_fnc("in_multiarray", $userContactsArray, me("id"))) {
							
									/*
										Update the array and save it
									*/
									$userRequestsArray[] = me("id");
									myQ("
										UPDATE `[x]users` 
										SET `relationship_requests`='".pk($userRequestsArray)."' 
										WHERE `id`='{$_GET["id"]}'
									");
									
									// SEND NOTIFICATION ///////////////////////////////////////////////////////////////////////
									if (is_file("theme/templates/GLOBALS/mails/notification_newrequest.tpl")) {
										$nBuf = file_get_contents("theme/templates/GLOBALS/mails/notification_newrequest.tpl");
												
										$mailContent =  explode("\n", strtr($nBuf, array(
											"{to.username}" => _fnc("user", $_GET["id"], "username"),
											"{site.name}" => $CONF["SITE_NAME"],
											"{from.username}" => me("username"),
											"{site.url}" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF']))
										), 2);
					
										$userSettings = unpk(_fnc("user", $_GET["id"], "settings"));
										if (!is_array($userSettings)) $userSettings = array();
					
										if (ckbool($userSettings["MAIL"]["NOTIFICATION"]["CONTACTREQUEST"])) {
									
											/* Send the mail */
											/* Include the mail class and prepare it for the mailing */
											include_once("system/functions/classes/mail.class.php");
											
											$mail = new SendMail;
											$mail -> From = 			"{$CONF["SITE_NAME"]} <{$CONF["SITE_SYSTEM_EMAIL"]}>";
											$mail -> To =				_fnc("user", $_GET["id"], "email");
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
											ckbool($userSettings["MOBILE"]["SMS"]["NOTIFICATION"]["CONTACTREQUEST"])
											&&
											(
												!ckbool($userSettings["MOBILE"]["EXCLUDEONLINE"])
												||
												($userSettings["MOBILE"]["EXCLUDEONLINE"] && _fnc("user", $_GET["id"], "last_load") < date("U")-300)
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
								}
							}
						}
					}						
				
					/* 
						Nothing was submitted? Ok! Show the "add 
						contact" / "create group" zone
					*/
					else $tpl->Zone("addContact", "enabled");
					
				} 
				
				/* 
					User was blocked
				*/
				else $tpl->Zone("addContact", "errorBlocked");
			}
			
			/*
				user was already in the contacts list
			*/
			else $tpl->Zone("addContact", "errorAlreadyInList");
			
		}
		/*
			user is trying to add him/herself
		*/
		else $tpl->Zone("addContact", "errorSelfUser");
		
	}
	/*
		No user ID provided
	*/
	else $tpl->Zone("addContact", "errorNoUserID");

	
	// HANDLE POSTED DATA //////////////////////////////////////////////////////////
	
	/*
		A group has been posted
	*/
	if (isset($_POST["addGroup"])) {
		
		/*
			Lets confirm the group doesnt already exist, a 
			user can not have two groups that has the same
			name... that makes some sence eh?
		*/
		if (!isset($myContactsArray[$_POST["group"]])) {
		
			/*
				Now we check if the posted group value is
				not empty ... another senceful check!
			*/
			if ($_POST["group"] != "") {
				
				/*
					Lets add this new group value to the
					array and save it to the database. Note
					that we don't just push that to the
					database but we also update the myContactsArray
					so it is still valid for the next few processes
				*/
				$myContactsArray[$_POST["group"]] = array();
				myQ("UPDATE `[x]users` SET `contacts`='".pk($myContactsArray)."' WHERE `id`='".me("id")."'");
				
				/*
					Let's tell the user about that!
				*/
				$tpl->Zone("createGroupMessage", "success");
			
			}
			
			/*
				No group name specified - was empty or the
				security layer made it blank
			*/
			else $tpl->Zone("createGroupMessage", "errorNoGroupValue");
		
		}

		/* 
			The group already exist
		*/
		else $tpl->Zone("createGroupMessage", "errorGroupAlreadyExist");
		
	}
	

	/*
		We will run inside the user's contact
		groups and generate the dropdown menu 
		options list
	*/
	if (isset($myContactsArray) && is_array($myContactsArray)) {
		
		$i=0;
		/*
			Let's start the loop
		*/
		foreach($myContactsArray as $groupName => $usersArray) {
			$contactGroupsArray[$i]["groupName"] = $groupName;
			$contactGroupsArray[$i]["groupNameEncode"] = base64_encode($groupName);
			
			$i++;
		}
		
		/*
			If the array exists, we will send the 
			options list to the template.
		*/
		if (isset($contactGroupsArray)) {
			$tpl->Loop("contactGroupsOptions", $contactGroupsArray);
			$tpl->Zone("selectGroup", "showGroups");
		}
		
		/* 
			There was no group, the user is 
			forced to create one. Let's show the message
			instead of the "blank" dropdown box
		*/
		else $tpl->Zone("selectGroup", "noGroups");
		
	} 
	
	/* 
		There was no group, the user is 
		forced to create one. Let's show the message
		instead of the "blank" dropdown box
	*/

	else $tpl->Zone("selectGroup", "noGroups");
			

	/*
		Clear the unused zones if there is any
	*/
	$tpl->CleanZones();

	/*
		We're done... Let's flush the results
	*/
	$tpl -> Flush();

?>