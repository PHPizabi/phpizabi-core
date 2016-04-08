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
	$tpl -> Load("gallery");
	$tpl -> GetObjects();

	/*
		Make sure something was passed as a user ID
	*/
	if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
		
		/*
			Assign that user to the template engine
		*/
		$tpl -> AssignUser($_GET["id"]);
		
		/*
			Handle a couple show / don't show things
		*/
		if (_fnc("user", $_GET["id"], "header") != "") $tpl->Zone("personalHeader", "printHeader");
		
		/*
			Load the user's contacts array and set a boolean for future use
		*/
		$contacts = unpk(_fnc("user", $_GET["id"], "contacts"));
		$inContacts = (is_array($contacts) && _fnc("in_multiarray", $contacts, me("id"))?true:false);
		
		/*
			Load some counters variables
		*/
		$totalPicturesCounter = 0;
		$privatePicturesCounter = 0;
		$totalGroupsCounter = 0;
		
		/* 
			Load the user's pictures, make it an array
			if its not
		*/
		$myPictures = unpk(_fnc("user", $_GET["id"], "pictures"));
		if (!is_array($myPictures)) $myPictures = array();
		
		/*
			Now that we've got the array, we will loop in it.
		*/
		$i=0;
		foreach ($myPictures as $pictureArray) {
			
			if ((!isset($_GET["pid"]) && $pictureArray["MAIN"]) || (isset($_GET["pid"]) && $pictureArray["ID"] == $_GET["pid"])) {
				
			
				$shownPictureID = $pictureArray["ID"];
				
				$shownPictureArray["shownPicture.pid"] = $pictureArray["ID"];
				$shownPictureArray["shownPicture.title"] = $pictureArray["NAME"];
				$shownPictureArray["shownPicture.date"] = date($CONF["LOCALE_LONG_DATE_TIME"], $pictureArray["DATE"]);
				$shownPictureArray["shownPicture.description"] = _fnc("convertBodyCodes", $pictureArray["DESCRIPTION"]);
				$shownPictureArray["shownPicture.file"] = $pictureArray["FILE"];
				$shownPictureArray["shownPicture.id"] = $pictureArray["ID"];
				
				/* 
					Count comments on this picture
				*/		
				$shownPictureArray["shownPicture.comments"] = myNum(myQ("
					SELECT `id`
					FROM `[x]comments` 
					WHERE `relative`='{$_GET["id"]}.{$shownPictureID}' 
					AND `type`='picture'
				"));
				
				/*
					Increment the counter
				*/
				$totalPicturesCounter++;
			}
			
			else {
				
				/*
					Create an array of all the pictures (but the one we show or
					the private ones if we're not allowed to access those) grouped 
					by library name
				*/
				if ((($pictureArray["PRIVATE"] && $inContacts) || ($_GET["id"] == me("id"))) || (!$pictureArray["PRIVATE"])) {
					$picturesInGroups[$pictureArray["LIBRARY"]][] = $pictureArray;
				}
			}
		}
		
		if (isset($shownPictureArray)) {
			$tpl -> Zone("shownPictureBlock", "enabled");
			$tpl -> AssignArray($shownPictureArray);
		}
		
		/*
			No picture at all?
		*/
		else {
			$tpl -> Zone("shownPictureBlock", "noPicture");
			$tpl -> Zone("writeComment", "noPicture");
		}
		
		
				
		/*
			Loop inside grouped pictures, we will create the list
			array!
		*/
		if (isset($picturesInGroups) && is_array($picturesInGroups)) {
			$i=0;
			foreach (array_keys($picturesInGroups) as $groupName) {
	
				/*
					Increment the groups count
				*/
				$totalGroupsCounter++;
	
				$groupsReplacementArray[$i]["group.groupName"] = $groupName;
				$groupsReplacementArray[$i]["group.picturesSet"] = NULL;
				
				foreach ($picturesInGroups[$groupName] as $pictureArray) {
					
					/*
						Increment the total pictures count
					*/
					$totalPicturesCounter++;
					if ($pictureArray["PRIVATE"]) $privatePicturesCounter++;
	
					/*
						Create a new template instance, we will process the picture
						container object with it.
					*/
					$pictureTemplate = new template;
					$pictureTemplate -> LoadThis($GLOBALS["OBJ"]["pictureBox"]);
					
					$pictureTemplate -> AssignArray(array(
						"picture.id" => $pictureArray["ID"],
						"picture.userID" => $_GET["id"],
						"picture.file" => $pictureArray["FILE"]
					));
					
					$groupsReplacementArray[$i]["group.picturesSet"] .= $pictureTemplate -> Flush(1);
					
				}
				
				$i++;
			}
		}
		
		if (isset($groupsReplacementArray)) {
			$tpl->Zone("picturesGroupsBlock", "enabled");
			$tpl->Loop("picturesGroups", $groupsReplacementArray);
		} else $tpl->Zone("picturesGroupsBlock", "noGroups");

		/*
			Assign the counters variables
		*/
		$tpl->AssignArray(array(
			"counter.totalPictures" => $totalPicturesCounter,
			"counter.privatePictures" => $privatePicturesCounter,
			"counter.groups" => $totalGroupsCounter
		));

		// SELF-USER SWITCHING /////////////////////////////////////////////////////////////////////
		/*
			This shows more stuff to the self user
		*/
		if ($_GET["id"] == me("id")) $tpl -> Zone("selfUserOptions", "enabled");

		// HANDLE POSTED VOTES /////////////////////////////////////////////////////////////////////
		/*
			Got a vote "GET"? Let's make sure this user
			didn't voted on this picture yet... We will save
			a bit on database accesses with this!
		*/
		if (isset($_GET["vote"]) && is_numeric($_GET["vote"]) && $_GET["vote"] <= 5 && $_GET["vote"] > 0) {
			
			if ((isset($_SESSION["LAST_PICTURE_VOTE"]) && $_SESSION["LAST_PICTURE_VOTE"] != $shownPictureID) || (!isset($_SESSION["LAST_PICTURE_VOTE"]))) {
			
				/*
					Create the vote session info
				*/
				$_SESSION["LAST_PICTURE_VOTE"] = $shownPictureID;
							
			
				/*
					We will now handle posted vote. As usual... get the data pack
				*/
				$pictureVotesArray = unpk(_fnc("user", $_GET["id"], "pictures_votes"));
				if (!is_array($pictureVotesArray)) $pictureVotesArray = array();
			
				/*
					We only want to allow one vote per user... let's 
					check if this one already voted!
				*/
				if (!isset($pictureVotesArray[$shownPictureID][me("id")])) {
					
					/* 
						Ok, you never voted! We'll create a new
						vote entry in the array.
					*/
					$pictureVotesArray[$shownPictureID][me("id")] = $_GET["vote"];
					
					/*
						... and save it to the database
					*/
					myQ("UPDATE `[x]users` SET `pictures_votes`='".pk($pictureVotesArray)."' WHERE `id`='{$_GET["id"]}'");
					
					/*
						Show something
					*/
					$tpl -> Zone("castVoteBlock", "success");
				}
			}
		}

		// SHOW / HIDE THE "CAST VOTE" OPTION ////////////////////////////////////////////////////////
		/*
			We will only show the "cast vote" zone if the user is actually
			allowed to vote. Let's get the votes array if we don't already
			have it
		*/
		if (!isset($pictureVotesArray)) {
			$pictureVotesArray = unpk(_fnc("user", $_GET["id"], "pictures_votes"));
			if (!is_array($pictureVotesArray)) $pictureVotesArray = array();
		}
			
		/*
			We only want to allow one vote per user... let's 
			check if this one already voted!
		*/
		if (
			isset($shownPictureID) 
			and 
			!isset($pictureVotesArray[$shownPictureID][me("id")])
		) $tpl -> Zone("castVoteBlock", "enabled");


		// COMPUTE VOTE DATA STATS ///////////////////////////////////////////////////////////////////
		/*
			This will compute all the votes for this picture. Actually
			we MAY have this data pack as we may have computed it 
			with the previous few lines, let's see if we got it, or
			get it if needed
		*/
		if (!isset($pictureVotesArray)) $pictureVotesArray = unpk(_fnc("user", $_GET["id"], "pictures_votes"));
		if (!is_array($pictureVotesArray)) $pictureVotesArray = array();
		
		/*
			Ininitalize some cyclic variables
		*/
		$i=0;
		$totalVotes=0;
		
		/*
			Loop inside the votes array, we will generate
			the total votes and the average...
		*/
		if (
			isset($shownPictureID)
			and
			isset($pictureVotesArray[$shownPictureID])
		) foreach($pictureVotesArray[$shownPictureID] as $voteFromUser => $voteValue) {
			
			/*
				In order to generate an agerage, we need
				a compiled total vote points for that user, 
				the following line adds the actual vote to a 
				global total
			*/
			$totalVotes = $totalVotes + $voteValue;

			$i++;

		}
		
		/*
			Now we can generate the average - rocket science 
			here: total points divided by total votes = average.
			A good think to notice tho is the little conditional
			element that prevents division by zero.
			
			The "i" cyclic variable is used as a total votes 
			counter here
		*/
		$votesAverage = ($i>0?round($totalVotes/$i):0);
		
		/*
			...and we assign that to the template!
		*/
		$tpl -> AssignArray(array(
			"votes.average"=>$votesAverage, 
			"votes.total"=>$i
		));
		
		// HANDLE COMMENT REMOVAL ///////////////////////////////////////////////////
		if (isset($_GET["rmcomment"]) and is_mop()) {
			myQ("DELETE FROM `[x]comments` WHERE `id`='{$_GET["rmcomment"]}'");
		}

		// POST COMMENT HANDLING ////////////////////////////////////////////////////
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
							'{$_GET["id"]}.{$shownPictureID}',
							'picture',
							'{$_POST["title"]}',
							'{$_POST["body"]}',
							'neutral'
						)
					");
	
				}
				
			}
			/* 
				Nothing was submitted but this user
				is not a guest, we will show the "write"
				comment form if a picture can be shown
			*/
			elseif (isset($shownPictureID)) $tpl->Zone("writeComment", "enabled");
		}
		
		/*
			Guests are not allowed to post comments
			so we will show an error message instead
			of the "write comment" form box.
		*/
		else $tpl ->Zone("writeComment", "guest");
	
		// COMMENTS LISTING /////////////////////////////////////////////////////////
		if (isset($shownPictureID)) {
			/*
				Select all the comments relate to this picture
				from the database
			*/
			$commentsSelect = myQ("
				SELECT *
				FROM `[x]comments` 
				WHERE `relative`='{$_GET["id"]}.{$shownPictureID}' 
				AND `type`='picture'
			");
			
			/*
				If there was more than 0 (at least one) comments
				for this picture, we will show the zone. 
			*/
			if (myNum($commentsSelect) > 0) {
				$tpl->Zone("pictureCommentsBlock", "enabled");
				
				/*
					Loop inside the comments and generate the
					comments replacement array
				*/
				while ($commentRow = myF($commentsSelect)) {
				
					$commentsArray[] = array(
						"comment.id" => 				$commentRow["id"],
						"comment.body" => 				_fnc("clearBodyCodes", _fnc("strtrim", $commentRow["body"], 250)),
						"comment.title" => 				_fnc("strtrim", $commentRow["title"], 50),
						"comment.date" => 				date($CONF["LOCALE_LONG_DATE"], $commentRow["date"]),
						"comment.username" => 			_fnc("user", $commentRow["user"], "username"),
						"comment.usermainpicture" => 	_fnc("user", $commentRow["user"], "mainpicture"),
						"comment.userid" => 			$commentRow["user"]
					);
				}
	
				/*
					If the array exists, we got some comments to 
					show. Let's turn that zone on and loop
				*/
				if (isset($commentsArray)) {
					$tpl->Zone("pictureCommentsBlock", "enabled");
					$tpl->Loop("pictureComments", $commentsArray);
				}
				
				/*
					No comments? Hurm ... this shouldnt be possible
					here but we will handle it anyway.
				*/
				else $tpl->Zone("pictureCommentsBlock", "disabled");
			}
			
			/*
				If the query returned zero results, we will
				show the "no comments" zone
			*/
			else $tpl->Zone("pictureCommentsBlock", "disabled");
		}
		
		/*
			There was no shownpictureid variable, no picture
			can be shown (the user probably has no picture
			at all)
		*/
		else $tpl->Zone("pictureCommentsBlock", "disabled");
		

		
		/*
			[NAME] => BLANK!!!
			[DESCRIPTION] => BLANK TOO :(
			[FILE] => 969_s3600008.jpg
			[LIBRARY] => 
			[PRIVATE] => 
			[MAIN] => 1
			[DATE] => 1155262291
			[APPROVED] => 
			[ID] => 044dbe75370a50
		*/

	}

	$tpl -> CleanZones();
	$tpl -> Flush();
	
	
?>