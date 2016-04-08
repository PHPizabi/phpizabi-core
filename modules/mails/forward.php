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
	$tpl -> load("forward");
	
	
	/*
		Get the actual mail data row
	*/
	$mailRow = myF(myQ("
		SELECT * 
		FROM `[x]messages`
		WHERE 
			((`to`='".me("id")."') OR (`from`='".me("id")."' AND `sent_copy`='1'))
		AND `id`='{$_GET["id"]}'
	"));
	

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
										'".($CONF["MAILS_FORWARD_FROM_ORIGIN"]?$mailRow["from"]:me('id'))."',
										'{$_POST["subject"]}',
										'{$_POST["body"]}',
										'{$CONF["MAILS_INBOX_NAME"]}',
										'".date("U")."',
										'0'
									)
								");
								
								// CREATE A LANE TOKEN //////////////////////////////////////////////////////////////////////
								_fnc("laneMakeToken", "new_mail", $userRow["id"], array(
									"{user.username}" => me("username"),
									"{user.id}" => me("id")							
								));
								
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
		mail! We're so fine :) -- The forward version use the
		source mail row if nothing was posted, or the POST data
		if a post has been set.
	*/
	$bodyPrefixReplacementArray = array(
		"{originalUsername}" => _fnc("user", $mailRow["from"], "username"),
		"{forwarderUsername}" => me("username")
	);

	$bodyPrefix = strtr($CONF["MAILS_FORWARD_BODY_PREFIX"], $bodyPrefixReplacementArray);
	
	$tpl->AssignArray(array(
		"post.body"=>(isset($_POST["body"])?$_POST["body"]:$bodyPrefix.$mailRow["body"].$CONF["MAILS_FORWARD_BODY_SUFFIX"]),
		"post.subject"=>(isset($_POST["subject"])?$_POST["subject"]:$CONF["MAILS_FORWARD_SUBJECT_PREFIX"].$mailRow["subject"]),
		"post.username"=>(isset($_POST["username"])?$_POST["username"]:NULL)
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