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
		Only act if a user ID has been provided
	*/
	if (isset($_GET["id"])) {
	
		// GET ID MODS (USERNAMES IN ID) ////////////////////////////////////////////////////////////
		/*
			The following couple lines will handle a USERNAME posted
			as a user ID in the URL, if the "ID" value is not numeric,
			it must be one. Let's try to find a user entry for that username
		*/
		if (!is_numeric($_GET["id"])) {
			$fetchUserName = myF(myQ("SELECT `id` FROM `[x]users` WHERE LCASE(`username`)='".strtolower($_GET["id"])."'"));
			if (is_array($fetchUserName)) $_GET["id"] = $fetchUserName["id"];
		}

		// TEMPLATE HANDLING ////////////////////////////////////////////////////////////////////////
		/* 
			Load up the template, assign the file and the 
			user array, get objects...
		*/
		$tpl = new template;
		$tpl->Load("profile");
		$tpl->AssignUser($_GET["id"]);
		$tpl->GetObjects();

		// CHECK USER (EXIST / ACTIVE) //////////////////////////////////////////////////////////////
		$userRow = myF(myQ("SELECT COUNT(`id`) AS `count` FROM `[x]users` WHERE `id` = '{$_GET["id"]}' AND `active` = '1'"));
		if ($userRow["count"] == 0) 
			$tpl -> Zone("main", "disabled");
		else 
			$tpl -> Zone("main", "enabled");

		// CREATE A LANE TOKEN //////////////////////////////////////////////////////////////////////
		if ($_GET["id"] != me("id") && isset($_SESSION["id"])) _fnc("laneMakeToken", "view_profile", $_GET["id"], array(
			"{user.username}" => me("username"),
			"{user.id}" => me("id")
		));

		// MAP DATA ???????? ////////////////////////////////////////////////////////////////////////
		$tpl->AssignArray(array("map.data"=>_fnc("user", $_GET["id"], "city")."+"._fnc("user", $_GET["id"], "country")."+"._fnc("user", $_GET["id"], "state")));
		
		// DISTANCE DATA ////////////////////////////////////////////////////////////////////////////
		$tpl->AssignArray(array(
			"distance" => _fnc("distance", $_GET["id"], me("id"))
		));

		// MY PAGE SWITCHING ////////////////////////////////////////////////////////////////////////
		if (is_file("system/cache/mypage/".strtolower($_GET["id"]).".dat")) {
			$tpl -> Zone("mypage", "enabled");
		}

		// SELF & GUESTS NOTICES ////////////////////////////////////////////////////////////////////
		/*
			If the user is a guest, or if the user is
			viewing his own profile, we will show a notice
			to the user so he/she knows why all the options
			disapeared!
		*/
		if (!isset($_SESSION["id"])) $tpl->Zone("top_notice", "guest");
		elseif ($_GET["id"] == me('id')) $tpl->Zone("top_notice", "self");
		
		/*
			Some things need to be done if the user is not
			a guest nor self!
		*/
		else {

			// LAST PROFILE VIEWS HANDLING //////////////////////////////////////////////////////////
			/*
				Let's check if this profile is the last profile view
				for this same user, we'll save a bit on database access
				if we stop this here!
			*/
			if (!isset($_SESSION["LAST_PROFILE_VIEW"]) || $_SESSION["LAST_PROFILE_VIEW"] != $_GET["id"]) {
				
				/*
					Ok .. we will go ahead, let's first set this
					session so we don't access the db too much
				*/
				$_SESSION["LAST_PROFILE_VIEW"] = $_GET["id"];
				
				/*
					We will get the user's profile view array and unpack it
				*/				
				$profileViewArray = unpk(_fnc("user", $_GET["id"], "profile_views"));
				if (!is_array($profileViewArray)) $profileViewArray = array();
				
				/*
					So ... is selfuser in that array?
				*/
				if (!_fnc("in_multiarray", $profileViewArray, me("username"))) {
					
					/*
						No, it's not! Let's create that array entry
					*/
					$profileViewArray[] = array(
						"id" => me("id"), 
						"username" => me("username"), 
						"date" => date("U")
					);
					
					/*
						This one isnt that very tricky but a long explanation
						may prevent a VERY LONG guessing. The profile view array
						only holds the last 5 users who visited the profile, BUT
						its keys constitutes the TOTAL views for this user.
						
						The following will pop off the first element of the array
						if its size is greater than 5. Doing so the following
						way will keep the keys of the array.
					*/
					if (count($profileViewArray) > 5) {
						/*
							Make sure the pointer is at the beginning
							of the array so we don't pop any element 
							randomly!
						*/
						reset($profileViewArray);
						
						/*
							The "key" function here will return the key of 
							the row where the pointer is ... unsetting this 
							value pops the first element off.
						*/
						unset($profileViewArray[key($profileViewArray)]);
					}
				
					/*
						Let's save what we got now.
					*/				
					myQ("UPDATE `[x]users` SET `profile_views`='".pk($profileViewArray)."' WHERE `id`='{$_GET["id"]}'");
				}
			}


			// ADD TO MY CONTACTS LINK //////////////////////////////////////////////////////////////
			/*
				If the user is not self nor guest, we may enable a link
				for the user to add this profile user to his contacts
				list. We will first get the selfuser's contacts array.
			*/
			$myContacts = unpk(me("contacts"));
			if (is_array($myContacts)) {
				/*
					Let's see if this user is already in the selfuser's list.
					If it's not, we will tell the template to enabled that zone.
				*/
				if (!_fnc("in_multiarray", $myContacts, $_GET["id"])) $tpl->Zone("addToContacts", "enabled");

			}
			
			/*
				The selfuser contacts array was not an array? Let's
				guess this means the user is not in in! ;)
			*/
			else $tpl->Zone("addToContacts", "enabled");
			
			// ADD TO MY BLOCKS LINK ////////////////////////////////////////////////////////////////
			/*
				If the user is not self, nor guest, he/she may add
				the profile' user to his block list. This only can
				be done if the user is not already blocked, of course.
				Let's first get the array...
			*/
			$myBlockListArray = unpk(me('block'));
			if (is_array($myBlockListArray)) {
				/*
					The followin confirms the user is not already
					in the selfuser's block list. If not, we will
					show that link.
				*/
				if (!in_array($_GET["id"], $myBlockListArray)) $tpl ->Zone("addToBlock", "enabled");
				
				/*
					The user was there, we will show the unblock option instead
				*/
				else $tpl ->Zone("addToBlock", "unBlock");

			}
			
			/*
				The block list was not an array, the user
				is not blocked. Show the block option.
			*/
			else $tpl ->Zone("addToBlock", "enabled");

		}
		
		// PROFILE VIEWS ////////////////////////////////////////////////////////////////////////////
		/*
			Why not compute the last profile views to send
			to the viewport now ... ?! Let's get the profile views
			array if we don't already have it (maybe we processed
			that with the previous couple lines, needless to
			get it again if we already have it
		*/
		if (!isset($profileViewArray)) $profileViewArray = unpk(_fnc("user", $_GET["id"], "profile_views"));
			
		$i=0;
			
		/*
			If the profile views array is actually an array, 
			we will loop against it
		*/
		if (is_array($profileViewArray)) foreach (array_keys($profileViewArray) as $viewKey) {
				
			/*
				Let's make sure the view data array is an array.
				Technically that shouldn't be possible that it
				would be something else but ... well ... shit happens!
			*/
			if (is_array($profileViewArray[$viewKey])) {
				
				/*
					Generate the replacement array
				*/
				$profileViewsRender[$i] = array(
					"view.username" => $profileViewArray[$viewKey]["username"],
					"view.time" => date($CONF["LOCALE_HEADER_DATE_TIME"], $profileViewArray[$viewKey]["date"]),
					"view.id" => $profileViewArray[$viewKey]["id"],
					"view.mainpicture" => _fnc("user", $profileViewArray[$viewKey]["id"], "mainpicture"),
					"view.gender" => _fnc("user", $profileViewArray[$viewKey]["id"], "gender"),
					"view.age" => _fnc("user", $profileViewArray[$viewKey]["id"], "age"),
					"view.date" => date($CONF["LOCALE_HEADER_DATE_TIME"], $profileViewArray[$viewKey]["date"]),
				);

				$i++;
					
				/*
					We will set this key as the residual view
					key, the last set key will remain past the
					loop and we consider that value as the
					total views for this profile.
				*/
				$residualViewKey = $viewKey;
			}
		}
			
		/*
			If we got a profileviewsrender result array, we 
			pass it to the template engine looper
		*/
		if (isset($profileViewsRender)) {
			$tpl->Zone("profileViews", "enabled");
			$tpl->Loop("profileViewsList", $profileViewsRender);
			$tpl->AssignArray(array("views.total"=>$residualViewKey + 1));
		}
			
		/*
			The array does not exist, we will show the
			odd message that this user never got a view... :(
		*/
		else $tpl->Zone("profileViews", "noViews");
		
		// USER'S PICTURES STATISTICS ///////////////////////////////////////////////////////////////
		/*
			We will now computer the user's pictures array, 
			the first thing to do, of course, is to get
			the array open!
		*/
		$userPicturesArray = unpk(_fnc("user", $_GET["id"], "pictures"));
		
		$totalPrivatePictures=0;
		$totalPictures=0;
		
		/* 
				Lets's loop against the pictures array. We
				need to do that as we will build some statistics
				for those pictures.
		*/
		if (is_array($userPicturesArray)) foreach ($userPicturesArray as $pictureKey => $pictureArray) {
			
			/*
				Increment the private pictures count value
			*/
			if (isset($pictureArray["PRIVATE"]) && $pictureArray["PRIVATE"] == true) $totalPrivatePictures++;
			
			/*
				Increment the total pictures count value
			*/
			$totalPictures++;
		}
		
		/*
			Let's throw those stats to the template engine
			for replacement.
		*/
		$tpl->AssignArray(array(
			"pictures.count"=>$totalPictures,
			"pictures.privatecount"=>$totalPrivatePictures
		));
		
		// LATEST BLOG ARTICLE //////////////////////////////////////////////////////////////////////
		/* 
			Get latest blog entry for that user, let's start
			the receip with oignons and mySQL queries.
		*/
		$latestBlogArticle = myF(myQ("SELECT * FROM `[x]blogs` WHERE `user`='{$_GET["id"]}' ORDER BY `date` DESC LIMIT 1"));
		if (is_array($latestBlogArticle)) {
			
			/*
				The following will generate the replacement 
				array to be passed to the template engine.
			*/
			$blogArticleArray["blog.title"] = $latestBlogArticle["title"];
			$blogArticleArray["blog.body"] = _fnc("clearBodyCodes", _fnc("strtrim", $latestBlogArticle["body"], 500));
			$blogArticleArray["blog.views"] = $latestBlogArticle["views"];
			$blogArticleArray["blog.date"] = date($CONF["LOCALE_SHORT_DATE_TIME"], $latestBlogArticle["date"]);
			$blogArticleArray["blog.comments"] = $latestBlogArticle["comments"];
			$blogArticleArray["blog.id"] = $latestBlogArticle["id"];

			/*
				Enable that template zone and assign it the array
			*/
			$tpl -> Zone("latestBlogArticle", "enabled");
			$tpl -> AssignArray($blogArticleArray);
		}
		
		/* 
			That was not an array? So we have nothing to show, we
			will throw a nasty message
		*/
		else $tpl -> Zone("latestBlogArticle", "noArticle");
		
		// USER's PERSONAL HEADER & QUOTE ///////////////////////////////////////////////////////////
		/* 
			The following few lines will print the user's personal
			quote and header on the top of the template page
		*/
		if (_fnc("user", $_GET["id"], "quote") != "") $tpl->Zone("personalQuote", "printQuote");
		if (_fnc("user", $_GET["id"], "header") != "") $tpl->Zone("personalHeader", "printHeader");
		else $tpl ->Zone("personalHeader", "noHeader");
		
		// CONTACTS TAB HANDLING ////////////////////////////////////////////////////////////////////
		/*
			Get the user's contact array, show a tab and a list
			if contacts if possible
		*/
		$userContactsArray = unpk(_fnc("user", $_GET["id"], "contacts"));
		
		$i=0;
		
		/*
			We will only act if the usercontactsarray is ... an array!
			If it is, start looping!
		*/
		if (is_array($userContactsArray)) foreach($userContactsArray as $userContactGroup => $contactsUsersArray) {

			/*
				Loop in the users array if it is an	array
			*/
			if (is_array($contactsUsersArray)) foreach($contactsUsersArray as $contactsUserID) {
	
				/*
					Now things starts being tricky :p -- We will get the
					third party user contacts array and verity that this
					user is also in the other user's contacts ... If
					both are in a relationship, we will show that user
					on the profile page
				*/
				$thirdUserContactsArray = unpk(_fnc("user", $contactsUserID, "contacts"));
				
				/*
					if it's an array, and that the user is in...
				*/
				if (is_array($thirdUserContactsArray) && _fnc("in_multiarray", $thirdUserContactsArray, $_GET["id"])) {

					/*
						If "i" is zero, it means this is the first
						successful cycle, we will enable the contact
						tab in the template.
					*/
					if ($i==0) $tpl->Zone("contactsTab", "enabled");
							
					/*
						Generate this entity' entry in the contacts array.
					*/
					$contactEntityArray[$i]["contact.username"] = _fnc("user", $contactsUserID, "username");
					$contactEntityArray[$i]["contact.id"] = $contactsUserID;
					$contactEntityArray[$i]["contact.mainpicture"] = _fnc("user", $contactsUserID, "mainpicture");

					$i++;
				}
			}
		}
		
		/*
			If the contactsEntityArray is set, we got
			some contacts to show... Nice eh? Let's 
			pass that to the looping engine
		*/
		if (isset($contactEntityArray)) $tpl -> Loop("contactEntity", $contactEntityArray);

		// HANDLE COMMENT REMOVAL //////////////////////////////////////////////////////////////////
		if (isset($_GET["rmcomment"]) and is_mop()) {
			myQ("DELETE FROM `[x]comments` WHERE `id`='{$_GET["rmcomment"]}'");
		}

		// HANDLE POSTED COMMENT ///////////////////////////////////////////////////////////////////
		/* 
			A comment has been posted? Make sure that the title
			and the body are not empty - and that the user is not a guest
		*/
		if (isset($_POST["SubmitComment"]) && $_POST["title"] != "" && $_POST["body"] != "" && me("id") != "") {
			/*
				Everything is ok, we will add this post entry to
				the database.
			*/
			myQ("
				INSERT INTO `[x]comments` 
				(`user`,`date`,`relative`,`type`,`title`,`body`,`polarity`)
				VALUES (
					'".me('id')."',
					'".date("U")."',
					'{$_GET["id"]}',
					'user',
					'{$_POST["title"]}',
					'{$_POST["body"]}',
					'{$_POST["polarity"]}'
				)
			");
			
			/*
				Create a lane token
			*/
			_fnc("laneMakeToken", "profile_comment", $_GET["id"], array(
				"{user.username}" => me("username"), 
				"{me.id}" => $_GET["id"],
				"{comment.title}" => _fnc("strtrim", $_POST["title"], 10)
			));
			
			// SEND NOTIFICATION ///////////////////////////////////////////////////////////////////////
			if (is_file("theme/templates/GLOBALS/mails/notification_newcomment.tpl")) {
				$nBuf = file_get_contents("theme/templates/GLOBALS/mails/notification_newcomment.tpl");
							
				$mailContent =  explode("\n", strtr($nBuf, array(
					"{to.username}" => _fnc("user", $_GET["id"], "username"),
					"{site.name}" => $CONF["SITE_NAME"],
					"{from.username}" => me("username"),
					"{site.url}" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF'])
				)), 2);

				$userSettings = unpk(_fnc("user", $_GET["id"], "settings"));
				if (!is_array($userSettings)) $userSettings = array();

				if (ckbool($userSettings["MAIL"]["NOTIFICATION"]["PROFILECOMMENT"])) {
				
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
					ckbool($userSettings["MOBILE"]["SMS"]["NOTIFICATION"]["PROFILECOMMENT"])
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
			
			/*
				How about telling the user about it?
			*/
			$tpl->Zone("postComment", "success");
		}
		
		/*
			No comment has been posted. We will show the
			comment form box if the user is not a guest, 
			or we show a message to guests.
		*/
		elseif (me("id") != "") $tpl->Zone("postComment", "enabled");
		else $tpl->Zone("postComment", "guest");

		// USER COMMENTS LIST //////////////////////////////////////////////////////////////////////
		/*
			We will now create the user's comments list - First
			thing to do is to query the database!
		*/
		$userCommentsSelect = myQ("
			SELECT * FROM `[x]comments` 
			WHERE `relative`='{$_GET["id"]}' 
			AND `type`='user' 
			ORDER BY `date` DESC LIMIT 5"
		);

		/* Loop inside the query results */
		while ($userCommentsRow = myF($userCommentsSelect)) {
			
			/*
				Generate the comments replacement array to
				be passed to the template looping engine
			*/
			$commentsArray[] = array(
				"comment.id" => 			$userCommentsRow["id"],
				"comment.title" => 			_fnc("strtrim", strip_tags($userCommentsRow["title"]), 40),
				"comment.body" => 			_fnc("strtrim", $userCommentsRow["body"], 500),
				"comment.username" => 		_fnc("user", $userCommentsRow["user"], "username"),
				"comment.userid" => 		$userCommentsRow["user"],
				"comment.mainpicture" => 	_fnc("user", $userCommentsRow["user"], "mainpicture"),
				"comment.date" => 			date($CONF["LOCALE_SHORT_DATE_TIME"], $userCommentsRow["date"])
			);
			
		}
		
		/*
			If the comments replace array exists, we will
			forward it to the template looping engine
		*/
		if (isset($commentsArray)) {
			$tpl -> Zone("usersCommentsTab", "enabled");
			$tpl -> Loop("userComments", $commentsArray);
			
			/*
				If the previous array was set, we know that
				we got some comments for this profile. The follwoing
				query will generate some statistics on those.
			*/
			$receivedCommentsCount = myNum(myQ("SELECT `id` FROM `[x]comments` WHERE `relative`='{$_GET["id"]}' AND `type`='user'"));
			$postedCommentsCount = myNum(myQ("SELECT `id` FROM `[x]comments` WHERE `user`='{$_GET["id"]}' AND `type`='user'"));
			
			/*
				Assign the counters values for replacement
			*/
			$tpl->AssignArray(array(
				"comments.postCount" => $postedCommentsCount, 
				"comments.getCount" => $receivedCommentsCount
			));
		}
		
		// HANDLE POSTED VOTES /////////////////////////////////////////////////////////////////////
		/*
			Got a vote "GET"? Let's make sure this user
			didn't voted on this profile yet... We will save
			a bit on database accesses with this!
		*/
		if (isset($_GET["vote"]) && is_numeric($_GET["vote"]) && $_GET["vote"] <= 5 && $_GET["vote"] > 0) {
			
			if ((isset($_SESSION["LAST_PROFILE_VOTE"]) && $_SESSION["LAST_PROFILE_VOTE"] != $_GET["id"]) || (!isset($_SESSION["LAST_PROFILE_VOTE"]))) {
			
				/*
					Create the vote session info
				*/
				$_SESSION["LAST_PROFILE_VOTE"] = $_GET["id"];
							
			
				/*
					We will now handle posted vote. As usual... get the data pack
				*/
				$userVotesArray = unpk(_fnc("user", $_GET["id"], "profile_votes"));
				if (!is_array($userVotesArray)) $userVotesArray = array();
			
				/*
					We only want to allow one vote per user... let's 
					check if this one already voted!
				*/
				if (!isset($userVotesArray[me("id")])) {
					
					/* 
						Ok, you never voted! We'll create a new
						vote entry in the array.
					*/
					$userVotesArray[me("id")] = $_GET["vote"];
					
					/*
						... and save it to the database
					*/
					myQ("UPDATE `[x]users` SET `profile_votes`='".pk($userVotesArray)."' WHERE `id`='{$_GET["id"]}'");
					
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
		if (!isset($userVotesArray)) {
			$userVotesArray = unpk(_fnc("user", $_GET["id"], "profile_votes"));
			if (!is_array($userVotesArray)) $userVotesArray = array();
		}
			
		/*
			We only want to allow one vote per user... let's 
			check if this one already voted!
		*/
		if (!isset($userVotesArray[me("id")])) $tpl -> Zone("castVoteBlock", "enabled");	
		
		// COMPUTE VOTE DATA STATS ///////////////////////////////////////////////////////////////////
		/*
			This will compute all the votes for this user. Actually
			we MAY have this data pack as we may have computed it 
			with the previous few lines, let's see if we got it, or
			get it if needed
		*/
		if (!isset($userVotesArray)) $userVotesArray = unpk(_fnc("user", $_GET["id"], "profile_votes"));
		if (!is_array($userVotesArray)) $userVotesArray = array();
		
		/*
			Ininitalize some cyclic variables
		*/
		$i=0;
		$totalVotes=0;
		
		/*
			Loop inside the votes array, we will generate
			the total votes and the average...
		*/
		foreach($userVotesArray as $voteFromUser => $voteValue) {
			
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



		/* Get the nudges */
		$nArr = unpk(file_get_contents("system/cache/nudges.dat"));
		if (is_array($nArr)) {
		
			/* Handle sent nudges */
			if (isset($_GET["nudge"]) && is_array($nArr[$_GET["nudge"]])) {
				$actNudges = unpk(_fnc("user", $_GET["id"], "nudges"));
				if (!is_array($actNudges)) $actNudges = array(); 
				
				$lang = _fnc("user", $_GET["id"], "language");
				if ($lang == "") {
					$lang = $CONF["LOCALE_SITE_DEFAULT_LANGUAGE"];
				}
					
				$nudgeBody = str_replace("[f_name]", me('username'), str_replace("[t_name]", _fnc("user", $_GET["id"], "username"), $nArr[$_GET["nudge"]]["body"][$lang]));
				
				$actNudges[] = array(
					"user" => me('id'),
					"body" => $nudgeBody,
					"icon" => $nArr[$_GET["nudge"]]["icon"]
				);
				myQ("UPDATE `[x]users` SET `nudges`='".pk($actNudges)."' WHERE `id`='{$_GET["id"]}'");
				
				/*
					Create a lane token
				*/
				_fnc("laneMakeToken", "new_nudge", $_GET["id"], array(
					"{user.username}" => me("username"), 
					"{nudge.body}" => $nudgeBody,
					"{nudge.icon}" => $nArr[$_GET["nudge"]]["icon"]
				));
				
				// SEND NOTIFICATION ///////////////////////////////////////////////////////////////////////
				if (is_file("theme/templates/GLOBALS/mails/notification_newnudge.tpl")) {
					$nBuf = file_get_contents("theme/templates/GLOBALS/mails/notification_newnudge.tpl");
							
					$mailContent =  explode("\n", strtr($nBuf, array(
						"{to.username}" => _fnc("user", $_GET["id"], "username"),
						"{site.name}" => $CONF["SITE_NAME"],
						"{from.username}" => me("username"),
						"{site.url}" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF'])
					)), 2);

					$userSettings = unpk(_fnc("user", $_GET["id"], "settings"));
					if (!is_array($userSettings)) $userSettings = array();

					if (ckbool($userSettings["MAIL"]["NOTIFICATION"]["NUDGE"])) {
				
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
						ckbool($userSettings["MOBILE"]["SMS"]["NOTIFICATION"]["NUDGE"])
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
				
				$tpl -> Zone("nudges", "block");
				$tpl -> Zone("nudge", "sent");

			} else {
				
				if (me('id') != "") {
					$tpl -> Zone("nudges", "block");
					$tpl -> Zone("nudge", "nudges");
						
					$i=0;
					foreach ($nArr as $key => $array) {
						$nudges[$i]["nudge.title"] = $nArr[$key]["title"]["english"];
						$nudges[$i]["nudge.id"] = $key;
						$nudges[$i]["nudge.icon"] = $nArr[$key]["icon"];
						$i++;
					}
					$tpl -> Loop("nudge", $nudges);
				} else {
					$tpl->Zone("nudges", "guest");
				}
			}
		}
	
		/* Figure out if the user is online or not */
		if (_fnc("user", $_GET["id"], "last_load") > (date("U") - 180)) {
			$tpl -> Zone("onlinecheck", "online");
			$tpl -> AssignArray(array(
				"onlinesince" => date($CONF["LOCALE_SHORT_TIME"], _fnc("user", $_GET["id"], "last_login")),
				"online.object" => $GLOBALS["OBJ"]["online"]			
			));
			
		} elseif (_fnc("user", $_GET["id"], "last_login") != 0) {
			$tpl -> Zone("onlinecheck", "offline");
			$tpl -> AssignArray(array(
				"lastlogin" => date($CONF["LOCALE_SHORT_DATE_TIME"], _fnc("user", $_GET["id"], "last_login")),
				"online.object" => NULL
			));
			
		} else {
			$tpl -> Zone("onlinecheck", "nologin");
			$tpl -> AssignArray(array(
				"lastlogin" => NULL,
				"online.object" => NULL
			));
		}
		
		/* Compute the profile data */
		if ($CONF["DISPLAY_PROFILE_DATA:INLINE"]) $formType = $GLOBALS["OBJ"]["inlineQuestionAnswer"];
		else $formType = $GLOBALS["OBJ"]["wrappedQuestionAnswer"];
		
		$profileResult = NULL;
		$data = unpk(_fnc("user", $_GET["id"], "profile_data"));
		if (is_array($data)) {
			foreach ($data as $group => $arr) {
				$profileResult .= str_replace("{title}", $group, $GLOBALS["OBJ"]["questionaire"]);
				foreach ($arr as $question => $answer) {
					$t = new template;
					$t->LoadThis($formType);
					$t->AssignArray(array("question"=>stripslashes($question), "answer"=>_fnc("clearBodyCodes", stripslashes($answer))));
					$profileResult .= $t->Flush(1);
				}
			}
		}
		$tpl -> AssignArray(array("profiledata"=>$profileResult));
	
	
		/*
			Swap the km / miles labels
		*/
		$tpl -> Zone("distanceLabel", ($CONF["DISTANCE_VALUES_UNIT:MILES"]?"miles":"kilometers"));
	
	
		$tpl -> CleanZones();
		$tpl -> Flush();

	}

?>