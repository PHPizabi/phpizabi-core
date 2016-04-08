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
	$tpl = new template;
	$tpl -> Load("mails");
	$tpl -> GetObjects();

	// USERS / GUESTS CONTROL ///////////////////////////////////////////////////////// FINAL //
	/*
		Make sure the user is logged in, guests can't
		access this page!
	*/
	if (me("id") != "") {
		$tpl -> Zone("mailsPage", "enabled");

		// LOAD MAILBOXES ///////////////////////////////////////////////////////////////// FINAL //
		/*
			Load the user's mailboxes array
		*/
		$customMailboxes = unpk(me("mailboxes"));
		if (!is_array($customMailboxes)) $customMailboxes = array();
	
		/*
			We will also append the hardcoded mailboxes to the
			end of that array
		*/
		$myMailboxes = array_merge(
			array($CONF["MAILS_INBOX_NAME"]), 
			$customMailboxes, 
			array($CONF["MAILS_SENTBOX_NAME"]),
			array($CONF["MAILS_TRASHBOX_NAME"])
		);
	
		// HANDLE POSTED MAILBOX ////////////////////////////////////////////////////////// FINAL //
		/* 
			If a mailbox "add" signal has been received and tha the mailbox is 
			not already in the array...
		*/
		if (isset($_POST["boxName"]) && $_POST["boxName"] != "" && !_fnc("in_iarray", $_POST["boxName"], $myMailboxes)) {
			
			/*
				Does the system allows custom mailboxes?
			*/
			if ($CONF["MAILS_CUSTOM_MAILBOX_ALLOWED"]) {
				
				/*
					Are we over the max mailboxes allowed?
				*/
				if (count($myMailboxes) < ($CONF["MAILS_CUSTOM_MAILBOX_MAX_BOXES"]+2)) {
				
					/*
						Don't allow mailboxes with a name longer than allowed
					*/
					if (strlen($_POST["boxName"]) <= $CONF["MAILS_CUSTOM_MAILBOX_NAME_MAX_LEN"]) {
					
						/*
							Add the mailbox to the array
						*/
						$myMailboxes[] = $_POST["boxName"];
				
						/*
							... then save the new mailboxes array, note that
							we will remove the two hardcoded boxes from the
							saved version
						*/
						$saveThoseBoxes = _fnc("array_remove", $CONF["MAILS_INBOX_NAME"], $myMailboxes);
						$saveThoseBoxes = _fnc("array_remove", $CONF["MAILS_SENTBOX_NAME"], $saveThoseBoxes);
						$saveThoseBoxes = _fnc("array_remove", $CONF["MAILS_TRASHBOX_NAME"], $saveThoseBoxes);
				
						myQ("UPDATE `[x]users` SET `mailboxes`='".pk($saveThoseBoxes)."' WHERE `id`='".me("id")."'");
						
						$tpl->Zone("createMailboxMessage", "success");
					}
					
					/*
						Mailbox name was too long, let's show a message
					*/
					else $tpl->Zone("createMailboxMessage", "tooLong");
				}
				
				/*
					Too many mailboxes
				*/
				else $tpl->Zone("createMailboxMessage", "overQuota");
			
			}
			/*
				User is not allowed to create mailboxes
			*/
			$tpl->Zone("createMailboxMessage", "notAllowed");
		}
		
		// HANDLE MAILBOX DELETION //////////////////////////////////////////////////////// FINAL //
		/* 
			Remove a custom mailbox if requested, let's check
			if we got the signal first.
		*/
		if (isset($_GET["rembox"])) {
		
			/*
				Prior to anything ... decode the box name
			*/
			$_GET["rembox"] = base64_decode($_GET["rembox"]);
		
			/*
				Make sure that... 
				1. The posted mailbox name is not null, 
				2. The mailbox exists
			*/
			if ($_GET["rembox"] != "" && _fnc("in_iarray", $_GET["rembox"], $myMailboxes)) {
	
				/*
					Make sure that the mailbox is not a hardcoded one
				*/
				if (
					$_GET["rembox"] != $CONF["MAILS_INBOX_NAME"] && 
					$_GET["rembox"] != $CONF["MAILS_TRASHBOX_NAME"] &&
					$_GET["rembox"] != $CONF["MAILS_SENTBOX_NAME"]
				) {
					
					/*
						Ok, unset that!
					*/				
					$myMailboxes = _fnc("array_remove", $_GET["rembox"], $myMailboxes);
					
					/*
						first, move all mails in that box to the INBOX
					*/	
					myQ("
						UPDATE `[x]messages` 
						SET `box`='{$CONF["MAILS_INBOX_NAME"]}' 
						WHERE `box`='{$_GET["rembox"]}' 
						AND `to`='".me('id')."'
					");
					
					/*
						... then save the new mailboxes array, note that
						we will remove the two hardcoded boxes from the
						saved version
					*/
					$saveThoseBoxes = _fnc("array_remove", $CONF["MAILS_INBOX_NAME"], $myMailboxes);
					$saveThoseBoxes = _fnc("array_remove", $CONF["MAILS_SENTBOX_NAME"], $saveThoseBoxes);
					$saveThoseBoxes = _fnc("array_remove", $CONF["MAILS_TRASHBOX_NAME"], $saveThoseBoxes);
					
					myQ("UPDATE `[x]users` SET `mailboxes`='".pk($saveThoseBoxes)."' WHERE `id`='".me('id')."'");
				}
			}
		}
	
		// HANDLE EMPTY TRASH SIGNAL ////////////////////////////////////////////////////// FINAL //
		if (isset($_GET["emptytrash"])) {
			myQ("DELETE FROM `[x]messages` WHERE `to`='".me("id")."' AND `box`='{$CONF["MAILS_TRASHBOX_NAME"]}'");
		}
	
		// HANDLE MULTICHECK POSTS //////////////////////////////////////////////////////// FINAL //
		/*
			This will handle the multiselect / multiactions
			posts... Let's first check that we got the signal
			from the button, that the chkMulti field is set and
			that it is an array
		*/
		if (isset($_POST["withSelectPost"]) && isset($_POST["chkMulti"]) && is_array($_POST["chkMulti"])) {
			
			/*
				Now we will make sure an action has been selected
			*/
			if (isset($_POST["checkedMailsOptions"]) && $_POST["checkedMailsOptions"] != "") {
				
				/*
					Find out what kind of action we're supposed to do 
					here ... This is the "DELETE" action
				*/
				if ($_POST["checkedMailsOptions"] == "delete") {
					/*
						Generate the query IDS string, this will create a conditional
						set for each mail ID that where checked - This is faster
						than running many queries with one ID per query
					*/
					foreach ($_POST["chkMulti"] as $mailID) {
						if (!isset($delIDQuery)) $delIDQuery = "`id`='{$mailID}' ";
						else $delIDQuery .= "OR `id`='{$mailID}' ";
					}
	
					/*
						Run the update!
					*/
					myQ("
						DELETE 
						FROM `[x]messages` 
						WHERE ((`to`='".me("id")."') OR (`from`='".me("id")."' AND `sent_copy`='1'))
						AND ({$delIDQuery})
					");
				}
				
				/*
					This is the "MOVE TO" action
				*/
				elseif (substr($_POST["checkedMailsOptions"], 0, 7) == "moveTo_") {
					/*
						Explode the "moveTo" value to get the mailbox name, make
						sure the box name is not empty.
					*/
					$moveToArray = explode("_", $_POST["checkedMailsOptions"]);
					if ($moveToArray[1] != "" and $moveToArray[1] != $CONF["MAILS_SENTBOX_NAME"]) {
						
						/*
							Generate the query IDS string, this will create a conditional
							set for each mail ID that where checked - This is faster
							than running many queries with one ID per query
						*/
						foreach ($_POST["chkMulti"] as $mailID) {
							if (!isset($moveIDQuery)) $moveIDQuery = "`id`='{$mailID}' ";
							else $moveIDQuery .= "OR `id`='{$mailID}' ";
						}
	
						/*
							Run the update!
						*/
						myQ("
							UPDATE `[x]messages` 
							SET `box`='{$moveToArray[1]}' 
							WHERE ((`to`='".me("id")."') OR (`from`='".me("id")."' AND `sent_copy`='1'))
							AND ({$moveIDQuery})
						");
					}
				}
				
				/*
					This is the spam option
				*/
				elseif ($_POST["checkedMailsOptions"] == "spam") {

					/*
						Loop in each checked mail in the array
					*/
					foreach ($_POST["chkMulti"] as $mailID) {
						/*
							Get the mail "from" and "body" fields for that entry
						*/
						$spamMailRow = myF(myQ("
							SELECT `from`,`body` 
							FROM `[x]messages` 
							WHERE ((`to`='".me("id")."') OR (`from`='".me("id")."' AND `sent_copy`='1'))
							AND `id`='{$mailID}' 
						"));
						
						/*
							Prepare a spam report array entity
						*/
						$spamReportArray["reported_by"] = me("id");
						$spamReportArray["date"] = date("U");
						$spamReportArray["user"] = $spamMailRow["from"];
						$spamReportArray["type"] = "mail";
						$spamReportArray["body"] = $spamMailRow["body"];
						
						/*
							Get the user's actual spam reports array, make
							it an array if its not
						*/
						$userSpamReports = unpk(_fnc("user", $spamMailRow["from"], "spam_reports"));
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
							WHERE `id`='{$spamMailRow["from"]}'
						");
					}
				}
				
				/*
					This is the abuse option
				*/
				elseif ($_POST["checkedMailsOptions"] == "abuse") {

					/*
						Loop in each checked mail in the array
					*/
					foreach ($_POST["chkMulti"] as $mailID) {
						/*
							Get the mail "from" and "body" fields for that entry
						*/
						$abuseMailRow = myF(myQ("
							SELECT `from`,`body` 
							FROM `[x]messages` 
							WHERE ((`to`='".me("id")."') OR (`from`='".me("id")."' AND `sent_copy`='1'))
							AND `id`='{$mailID}' 
						"));
						
						/*
							Prepare an abuse report array entity
						*/
						$abuseReportArray["reported_by"] = me("id");
						$abuseReportArray["date"] = date("U");
						$abuseReportArray["user"] = $abuseMailRow["from"];
						$abuseReportArray["type"] = "mail";
						$abuseReportArray["body"] = $abuseMailRow["body"];
						
						/*
							Get the user's actual abuse reports array, make
							it an array if its not
						*/
						$userAbuseReports = unpk(_fnc("user", $abuseMailRow["from"], "abuse_reports"));
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
							WHERE `id`='{$abuseMailRow["from"]}'
						");
					}
				}
			}
		}
	
		// LOAD UP MAILBOXES CONTENT ////////////////////////////////////////////////////// FINAL //
		/*
			Init some cyclic variables that will act
			as counters
		*/
		$i=0;
		$totalMailsCount = 0;
		$totalNewMailsCount = 0;
		$totalMailboxesCount = 0;
		$totalMailBytes = 0;
		
		/* 
			Loop in all the mailboxes
		*/
		foreach ($myMailboxes as $mailboxName) {
			
			/*
				Increment the total mailboxes counter
			*/
			$totalMailboxesCount++;
			
			/*
				We will query the db and get all the mails in the
				currently looped box...
			*/
			if ($mailboxName != $CONF["MAILS_SENTBOX_NAME"])
			$mailSelect = myQ("
				SELECT * 
				FROM `[x]messages` 
				WHERE `to`='".me("id")."' 
				AND `box`='{$mailboxName}'
				AND `sent_copy` != '1'
				ORDER BY `read` ASC, `date` DESC
			");
			
			else 
			$mailSelect = myQ("
				SELECT *
				FROM `[x]messages`
				WHERE `from`='".me("id")."'
				AND `sent_copy` = '1'
				ORDER BY `date` DESC
			");
						
			/*
				Init some cyclic variables
			*/
			$mailboxMailsCount = 0;
			$mailboxNewMailsCount = 0;
			$mailRowsConcatResult = NULL;
			$mailReplacementArray = NULL;
			
			/*
				Now we cycle into the array if it exists!
			*/
			while ($mailRow = myF($mailSelect)) {
			
				/*
					Increment the mails counters, and
					the "new mails" counter if required
				*/
				$totalMailsCount++;
				$mailboxMailsCount++;
				if ($mailRow["read"]==0) {	
					$totalNewMailsCount++;
					$mailboxNewMailsCount++;
				}
				$totalMailBytes = $totalMailBytes + strlen($mailRow["body"]) + strlen($mailRow["subject"]);
				
				/*
					We will find out which template object should be used for that 
					mail row, load it into the template engine and inject the replacement
					content into it.
				*/
				$mailTpl = new template();
				
				if ($mailRow["read"]==0 && $mailRow["attachment"]!="") $mailTpl->LoadThis($GLOBALS["OBJ"]["newMailWithAttachmentRow"]);
				elseif ($mailRow["read"]==0 && $mailRow["attachment"]=="") $mailTpl->LoadThis($GLOBALS["OBJ"]["newMailRow"]);
				elseif ($mailRow["read"]!=0 && $mailRow["attachment"]!="") $mailTpl->LoadThis($GLOBALS["OBJ"]["mailWithAttachmentRow"]);
				else $mailTpl->LoadThis($GLOBALS["OBJ"]["mailRow"]);
				
				$mailReplacementArray = array(
					"mail.username" => _fnc("user", $mailRow["from"], "username"),
					"mail.mainpicture" => _fnc("user", $mailRow["from"], "mainpicture"),
					"mail.subject" => _fnc("strtrim", $mailRow["subject"], 45),
					"mail.date" => date($CONF["LOCALE_SHORT_DATE_TIME"], $mailRow["date"]),
					"mail.id" => $mailRow["id"]
				);
				
				/*
					Attribute the replacement array to that template object
				*/
				$mailTpl -> AssignArray($mailReplacementArray);
				
				/*
					... and flush the processed result into a catchall variable
					that will contain all the rows for this mailbox
				*/
				$mailRowsConcatResult .= $mailTpl->Flush(1);
	
			}
	
			/*
				Build up an array of all the mailboxes, their values,
				and their mails content, this is used for the main 
				area (tabs)
			*/
			$mailBoxesReplacementArray[$i]["box.name"] = $mailboxName;
			$mailBoxesReplacementArray[$i]["box.newCount"] = $mailboxNewMailsCount;
			$mailBoxesReplacementArray[$i]["box.mailsContent"] = (!is_null($mailRowsConcatResult)?$mailRowsConcatResult:$GLOBALS["OBJ"]["emptyBox"]);
			if ($mailboxName == $CONF["MAILS_TRASHBOX_NAME"]) {
				$mailBoxesReplacementArray[$i]["box.emptyTrash"] = $GLOBALS["OBJ"]["emptyTrashLink"];
			} else $mailBoxesReplacementArray[$i]["box.emptyTrash"] = NULL;
			
			/*
				Now we build up another array of all the mailboxes.
				This one is used in the right pane part.
			*/
			$mailBoxesControlReplacementArray[$i]["controlBoxes.name"] = $mailboxName;
			$mailBoxesControlReplacementArray[$i]["controlBoxes.newMails"] = $mailboxNewMailsCount;
			$mailBoxesControlReplacementArray[$i]["controlBoxes.mailsCount"] = $mailboxMailsCount;
			
			/*
				Can we delete that mailbox? Push the delete object if
				this is possible.
			*/
			if (
				$mailboxName != $CONF["MAILS_INBOX_NAME"] && 
				$mailboxName != $CONF["MAILS_SENTBOX_NAME"] && 
				$mailboxName != $CONF["MAILS_TRASHBOX_NAME"]
			) {
				$mailBoxesControlReplacementArray[$i]["controlBoxes.delete"] = 
					str_replace("{delete.boxName}", base64_encode($mailboxName), $GLOBALS["OBJ"]["deleteBox"]);
			} else $mailBoxesControlReplacementArray[$i]["controlBoxes.delete"] = NULL;
			
			
			/*
				... And once again, we create another array of all
				the mailboxes. This one will be used in the dropdown
				menu item... Note that a user can't move mails to
				his "SENT" box as it is a special box that can't
				hold normal mails.
			*/
			if ($mailboxName != $CONF["MAILS_SENTBOX_NAME"]) $mailBoxesDropDownField[$i]["dropdownMailbox.name"] = $mailboxName;
			
			$i++;
		
		}
		
		/*
			Loop the mailboxesreplacementarray against the 
			template engine
		*/
		$tpl -> Loop("mailBoxes", $mailBoxesReplacementArray);
		
		$usedStorageAllotment = round((($totalMailBytes / 1024) / $CONF["MAILS_QUOTA_MAX_KILOBYTES"]) * 100);

		$tpl -> AssignArray(array(
			"mailsCounter.newMails"=>$totalNewMailsCount,
			"mailsCounter.mails"=>$totalMailsCount,
			"mailsCounter.boxes"=>$totalMailboxesCount,
			"quota.kBytesInUse"=>round($totalMailBytes/1024, 1),
			"quota.allotment"=>$CONF["MAILS_QUOTA_MAX_KILOBYTES"],
			"quota.percentageInUse" => ($usedStorageAllotment <= 100 ? $usedStorageAllotment : 100)
		));
		
		/*
			Loop the mailboxes control array
		*/
		$tpl -> Loop("mailBoxesControl", $mailBoxesControlReplacementArray);
	
		/*
			Loop the maiboxes dropdown array
		*/
		$tpl -> Loop("dropDownBoxNames", $mailBoxesDropDownField);

	/*
		User is not logged in...
	*/	
	} else {
		$tpl -> Zone("mailsPage", "disabled");
		_fnc("reload", 3, "?L");
	}


	$tpl -> CleanZones();
	$tpl -> Flush();
		
?>