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
	$tpl -> load("reply");

	// LOAD THE ORIGINAL MAIL /////////////////////////////////////////////////
	$mailRow = myF(myQ("SELECT * FROM `[x]messages` WHERE `to`='".me("id")."' AND `id`='{$_GET["id"]}'"));
	if ($mailRow["id"] != "") {
		
		$tpl->AssignUser($mailRow["from"]);
		
		// POST FIELDS POPULATION /////////////////////////////////////////////////
		/*
			We will populate the form fields with what was posted,
			so the user doesn't have to start over writing a long
			mail! We're so fine :)
		*/
		$tpl->AssignArray(array(
			"mail.body"=>(isset($_POST["body"])?$_POST["body"]:$mailRow["body"]),
			"mail.subject"=>(isset($_POST["subject"])?$_POST["subject"]:$mailRow["subject"]),
		));
		
		// SYSTEM FIELDS POPULATION ///////////////////////////////////////////////
		/*
			We will assign some system variables to the
			replacement array
		*/
		$tpl->AssignArray(array(
			"sys.quoteSeparator.prefix" => $CONF["MAILS_REPLY_QUOTE_SEPARATOR_PREFIX"],
			"sys.quoteSeparator.suffix" => $CONF["MAILS_REPLY_QUOTE_SEPARATOR_SUFFIX"],
			"sys.re" => $CONF["MAILS_REPLY_SUBJECT_PREFIX"]
		));
		
		// HANDLE MAIL POST //////////////////////////////////////////////////
		/* 
			A mail has been sent ...
		*/
		if (isset($_POST["Submit"])) {
			
			/*
				Now make sure the subject and body are not empty
			*/
			if (isset($_POST["subject"]) && $_POST["subject"] != "" && isset($_POST["body"]) && $_POST["body"] != "") {
					
				/*
					Get the user's array from the database and
					make sure the user exists
				*/
				$userRow = myF(myQ("SELECT `id`,`block` FROM `[x]users` WHERE `id`='{$mailRow["from"]}'"));
					
				if (!$userRow["id"]) {
						
					/*
						Show the template zone saying no such
						user name exists in this system
					*/
					$tpl -> Zone("replyMailHeader", "noSuchUser");
				} 
					
				/*
					A user has been found.. let's get that user's block array
					and make sure we're not blocked
				*/
				else {
						
					$blockList = unpk($userRow["block"]);
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
								(`to`,`from`,`subject`,`body`,`box`,`date`) 
								VALUES
								(
									'{$userRow["id"]}',
									'".me('id')."',
									'{$_POST["subject"]}',
									'{$_POST["body"]}',
									'{$CONF["MAILS_INBOX_NAME"]}',
									'".date("U")."'
								)
							");
								
							$tpl -> Zone("replyMailHeader", "success");
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
					else $tpl -> Zone("replyMailHeader", "blocked");
	
				}

			}
			/*
				The subject field or the body field was empty, let's show 
				a message
			*/
			else $tpl -> Zone("replyMailHeader", "emptyField");
		
		} 
			
		/*
			Form was not posted, show the normal welcome header
		*/
		else $tpl -> Zone("replyMailHeader", "enabled");

	}	
		
	$tpl -> CleanZones();
	$tpl -> Flush();
	
?>