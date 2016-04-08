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

	// TEMPLATE HANDLING ////////////////////////////////////////////////////////////// FINAL //
	/* 
		Initialize the template 
	*/
	$tpl = new template;
	$tpl -> Load("read");

	// LOAD MAILBOXES ///////////////////////////////////////////////////////////////// FINAL //
	/*
		Load the user's mailboxes array
	*/
	$customMailboxes = unpk(me("mailboxes"));
	if (!is_array($customMailboxes)) $customMailboxes = array();
	
	/*
		We will also append the hardcoded mailboxes to the
		beginning and the end of that array
	*/
	$myMailboxes = array_merge(
		array($CONF["MAILS_INBOX_NAME"]), 
		$customMailboxes, 
		array($CONF["MAILS_SENTBOX_NAME"]),
		array($CONF["MAILS_TRASHBOX_NAME"])
	);
	
	// MAILBOX LIST ARRAY ///////////////////////////////////////////////////////////// FINAL //
	/*
		We will generate a mailboxes list array for looping.
		this is used in the dropdown menu "with mail..."
	*/
	$i=0;
	foreach ($myMailboxes as $mailboxName) {
		if ($mailboxName != $CONF["MAILS_SENTBOX_NAME"]) $mailboxesListArray[$i]["mailbox.name"] = $mailboxName;
		$i++;
	}

	/*
		We will attribute it twice, once for the right
		pane option dropdown list, and one for the bottom
		one... Actually the template engine is able to 
		loop both with one instruction but its a bug
		more than a feature
	*/
	$tpl -> Loop("mailboxesList", $mailboxesListArray);
	$tpl -> Loop("mailboxesListTwo", $mailboxesListArray);

	// HANDLE MAIL DATA /////////////////////////////////////////////////////////////// FINAL //
	/* 
		Make sure a ID has been provided and that its
		an integer value
	*/
	if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
		
		/*
			Get the mail data from the databae
		*/
		$mailRow = myF(myQ("
			SELECT * 
			FROM `[x]messages` 
			WHERE 
				((`to`='".me("id")."') OR (`from`='".me("id")."' AND `sent_copy`='1'))
			AND `id`='{$_GET["id"]}'
		"));
		
		/*
			Assign the sender user for replacement
		*/
		$tpl -> AssignUser($mailRow["from"]);

		/*
			Generate the replacement array for this mail entity
		*/				
		$mailReplacementArray["mail.subject"] = $mailRow["subject"];
		$mailReplacementArray["mail.body"] = _fnc("convertBodyCodes", $mailRow["body"]);
		$mailReplacementArray["mail.date"] = date($CONF["LOCALE_LONG_DATE_TIME"], $mailRow["date"]);
		$mailReplacementArray["mail.id"] = $mailRow["id"];
			
		/*
			And pass it to the template engine
		*/	
		$tpl -> AssignArray($mailReplacementArray);
			
		/*
			We will update the mail entry in the database
			to mark it as read
		*/
		myQ("
			UPDATE `[x]messages` 
			SET `read`='1' 
			WHERE 
				((`to`='".me("id")."') OR (`from`='".me("id")."' AND `sent_copy`='1'))
			AND `id`='{$_GET["id"]}'
		");

		// HANDLE POSTED SHORTCUT ///////////////////////////////////////////////////// FINAL //
		if (isset($_POST["reply"])) {
			_fnc("reload", 0, "?L=mails.reply&id={$_GET["id"]}");
		}
		
		if (isset($_POST["delete"])) {
			myQ("
				DELETE FROM `[x]messages` 
				WHERE 
					((`to`='".me("id")."') OR (`from`='".me("id")."' AND `sent_copy`='1'))
				AND `id`='{$_GET["id"]}'
			");

			_fnc("reload", 0, "?L=mails.mails");
		}
		
		// HANDLE POSTED ACTION /////////////////////////////////////////////////////// FINAL //
		/*
			we will handle all the posted actions with the following, 
			check if we got the signal and that an option has been selected
		*/
		if (isset($_POST["withMailSelect"]) && $_POST["withMailSelect"] != "") {
			
			/*
				Action: Reply
			*/
			if ($_POST["withMailSelect"] == "reply") {
				_fnc("reload", 0, "?L=mails.reply&id={$_GET["id"]}");
			}
			
			/*
				Action: Forward
			*/
			if ($_POST["withMailSelect"] == "forward") {
				_fnc("reload", 0, "?L=mails.forward&id={$_GET["id"]}");
			}
			
			/*
				Action: moveTo_
			*/
			if (substr($_POST["withMailSelect"], 0, 7) == "moveTo_") {
				
				/*
					Break the posted "withMailSelect" value at the underscore, the
					second value in the array will be the destination box.
				*/
				$destinationArray = explode("_", $_POST["withMailSelect"]);
				if (isset($destinationArray[1])) {
					
					/*
						Update the database
					*/
					myQ("
						UPDATE `[x]messages` 
						SET `box`='{$destinationArray[1]}' 
						WHERE 
							((`to`='".me("id")."') OR (`from`='".me("id")."' AND `sent_copy`='1'))
						AND `id`='{$_GET["id"]}'
					");			
					
					/*
						and keep on moving!
					*/
					_fnc("reload", 0, "?L=mails.mails");
				}
			}
			
			/*
				Action: delete (or block + delete)
			*/
			if ($_POST["withMailSelect"] == "delete" || $_POST["withMailSelect"] == "blockdelete") {
				
				myQ("
					DELETE FROM `[x]messages` 
					WHERE 
						((`to`='".me("id")."') OR (`from`='".me("id")."' AND `sent_copy`='1'))
					AND `id`='{$_GET["id"]}'
				");
				
				_fnc("reload", 0, "?L=mails.mails");
			}
			
			/*
				Action: Block user (or block + delete)
			*/
			if ($_POST["withMailSelect"] == "block" || $_POST["withMailSelect"] == "blockdelete") {
				
				$myBlockList = unpk(me("block"));
				if (!is_array($myBlockList)) $myBlockList = array();
				
				$myBlockList[] = $mailRow["from"];
				myQ("UPDATE `[x]users` SET `block`='".pk($myBlockList)."' WHERE `id`='".me("id")."'");
				
				_fnc("reload", 0, "?L=mails.mails");
			}
			
			/*
				Action: mark as spam
			*/
			if ($_POST["withMailSelect"] == "spam") {
				
				/*
					Prepare a spam report array entity
				*/
				$spamReportArray["reported_by"] = me("id");
				$spamReportArray["date"] = date("U");
				$spamReportArray["user"] = $mailRow["from"];
				$spamReportArray["type"] = "mail";
				$spamReportArray["body"] = $mailRow["body"];
						
				/*
					Get the user's actual spam reports array, make
					it an array if its not
				*/
				$userSpamReports = unpk(_fnc("user", $mailRow["from"], "spam_reports"));
				if (!is_array($userSpamReports)) $userSpamReports = array();
						
				/*
					Add this new report to the array
				*/
				$userSpamReports[] = $spamReportArray;
					
				/*
					... and save it
				*/
				myQ("
					UPDATE `[x]users` 
					SET `spam_reports`='".pk($userSpamReports)."' 
					WHERE `id`='{$mailRow["from"]}'
				");
				
				_fnc("reload", 0, "?L=mails.mails");
			}
			
			/*
				Action: Mark as abuse
			*/
			if ($_POST["withMailSelect"] == "abuse") {

				/*
					Prepare an abuse report array entity
				*/
				$abuseReportArray["reported_by"] = me("id");
				$abuseReportArray["date"] = date("U");
				$abuseReportArray["user"] = $mailRow["from"];
				$abuseReportArray["type"] = "mail";
				$abuseReportArray["body"] = $mailRow["body"];
						
				/*
					Get the user's actual abuse reports array, make
					it an array if its not
				*/
				$userAbuseReports = unpk(_fnc("user", $mailRow["from"], "abuse_reports"));
				if (!is_array($userAbuseReports)) $userAbuseReports = array();
						
				/*
					Add this new report to the array
				*/
				$userAbuseReports[] = $abuseReportArray;
						
				/*
					... and save it
				*/
				myQ("
					UPDATE `[x]users` 
					SET `abuse_reports`='".pk($userAbuseReports)."' 
					WHERE `id`='{$mailRow["from"]}'
				");
				
				_fnc("reload", 0, "?L=mails.mails");
			}
		}
	
	}

	// FLUSH TEMPLATE ///////////////////////////////////////////////////////////////// FINAL //
	/*
		Flush the template buffer
	*/
	$tpl -> Flush();
	
?>