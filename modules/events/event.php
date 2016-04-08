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
	
	// TEMPLATE HANDLING ////////////////////////////////////////////////////////////////// FINAL //
	/*
		Initialize the template engine and
		load the template file. 
	*/
	$tpl = new template;
	$tpl -> Load("event");
	
	/*
		Day.ut conversion
	*/
	$tpl->AssignArray(array("day.ut"=>date("U")));
	
	// HANDLE REMOVAL REQUEST /////////////////////////////////////////////////////////////
	if (isset($_GET["rm"]) and is_mop()) {
		
		/* Remove all comments related to the event */
		myQ("DELETE FROM `[x]comments` WHERE `relative`='{$_GET["id"]}' AND `type`='event'");

		/* Remove the event entry */
		myQ("DELETE FROM `[x]events` WHERE `id`='{$_GET["id"]}'");
		
		_fnc("reload", 0, "?L=events.daily&ut=".date("U"));
		
	}
	
	// HANDLE COMMENT REMOVAL /////////////////////////////////////////////////////////////
	if (isset($_GET["rmcomment"]) and is_mop()) {
		myQ("DELETE FROM `[x]comments` WHERE `id`='{$_GET["rmcomment"]}'");
	}
	
	// HANDLE POSTED COMMENT ////////////////////////////////////////////////////////////// FINAL //
	/* 
		Only let logged-in non-blocked users
		write comments on events
	*/
	if (me("id") != "") {

		/*
			A comment has been submitted, if both the title 
			and the body are not null, we will show the
			"posted" message (instead of the "write comment"
			form) and insert the new comment in the database
		*/
		if (isset($_POST["SubmitComment"]) && $_POST["title"] != "" && $_POST["body"] != "") {
			
			/*
				Show the "posted" zone in the template
			*/		
			$tpl -> Zone("writeComment", "posted");
			
			/*
				We will check if a temporary comment session chipher
				exists... if so, we won't post that comment again.
				(in the case the user reloads the page right after
				the post and re-post!)
			*/
			if (!isset($_SESSION["LAST_COMMENT_BODYCODE"]) || $_SESSION["LAST_COMMENT_BODYCODE"] != md5($_POST["body"])) {
						
				/*
					We will set the temporary comment session data so
					the same comment won't be posted twice 
				*/
				$_SESSION["LAST_COMMENT_BODYCODE"] = md5($_POST["body"]);
				
				/*
					Insert the comment into the database
				*/
				myQ("
					INSERT INTO `[x]comments` 
					(`user`,`date`,`relative`,`type`,`title`,`body`,`polarity`)
					VALUES (
						'".me('id')."',
						'".date("U")."',
						'{$_GET["id"]}',
						'event',
						'{$_POST["title"]}',
						'{$_POST["body"]}',
						'{$_POST["polarity"]}'
					)
				");
			}
		}

		/* 
			Nothing was submitted but this user
			is not a guest, we will show the "write"
			comment form
		*/
		else $tpl->Zone("writeComment", "enabled");
	}
	
	/*
		Guests are not allowed to post comments
		so we will show an error message instead
		of the "write comment" form box.
	*/
	else $tpl ->Zone("writeComment", "guest");
	
	// LOAD COMMENTS ////////////////////////////////////////////////////////////////////// FINAL //
	/*
		We will get all the comments left for this
		event. Note that this occurs AFTER
		any comment got posted so we're sure we are
		getting the updated and accurate data from
		the database.
	*/
	$select = myQ("SELECT * FROM `[x]comments` WHERE `relative`='{$_GET["id"]}' AND `type`='event'");
	
	/*
		If there was more than zero comments found
		for this article, we will show those on the
		comments page.
	*/
	if (myNum($select) > 0) {
		
		/*
			Enabled the article comments block in the
			template
		*/
		$tpl -> Zone("eventCommentsBlock", "enabled");
	
		/*
			Loop inside the results and generate the
			comments row array to be passed to the looping
			engine
		*/
		while ($commentRow = myF($select)) {
			
			$commentsArray[] = array(
				"comment.id" => 				$commentRow["id"],
				"comment.username" => 			_fnc("user", $commentRow["user"], "username"),
				"comment.userid" => 			$commentRow["user"],
				"comment.usermainpicture" => 	_fnc("user", $commentRow["user"], "mainpicture"),
				"comment.date" => 				date($CONF["LOCALE_LONG_DATE_TIME"], $commentRow["date"]),
				"comment.title" => 				_fnc("strtrim", $commentRow["title"], 40),
				"comment.body" => 				_fnc("clearBodyCodes", $commentRow["body"]),
				"comment.polarity" => 			$commentRow["polarity"]
			);
		}
		
		/* 
			If the array exists, we will pass its
			content to the looping engine for replacement.
		*/		
		$tpl -> Loop("eventComments", (isset($commentsArray) ? $commentsArray : array()));
	} 

	/*
		There was no comment for this event.
		We will disable the comments block in the
		template
	*/
	else $tpl -> Zone("eventCommentsBlock", "disabled");
		
	// LOAD EVENT ///////////////////////////////////////////////////////////////////////// FINAL //
	/*
		Make sure we got an ID
	*/
	if (isset($_GET["id"])) {

		/*
			Load the row from the database
		*/		
		$eventRow = myF(myQ("
			SELECT * 
			FROM `[x]events` 
			WHERE `id`='{$_GET["id"]}' 
			AND (
				(`display`='private' AND `user`='".me("id")."')
				OR
				(`display`='shared' AND (`user`='myFriendID' OR `user`='myFriendID2'))
				OR
				(`display`='public')
				OR
				(`display`='system')
			)
			LIMIT 1
		"));
		
		/*
			Make sure the row exists 
		*/
		if ($eventRow["id"] != "") {
			
			$eventReplacementArray = array(
				"event.id" => $eventRow["id"],
				"event.title" => $eventRow["title"],
				"event.date" => date($CONF["LOCALE_LONG_DATE_TIME"], $eventRow["date"]),
				"event.username" => _fnc("user", $eventRow["user"], "username"),
				"event.userID" => $eventRow["user"],
				"event.creationDate" => date($CONF["LOCALE_SHORT_DATE"], $eventRow["set_date"]),
				"event.location" => $eventRow["location"],
				"event.body" => _fnc("convertBodyCodes", $eventRow["body"]),
				"event.mainpicture" => $eventRow["mainpicture"]
			);
			
			if ($eventRow["mainpicture"]) $tpl->Zone("eventPicture", "enabled");
		}
		
		if (isset($eventReplacementArray)) $tpl->AssignArray($eventReplacementArray);
	}
	
	$tpl -> CleanZones();
	$tpl -> Flush();
?>