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
		load the template file. Get objects,
		convert self user.
	*/
	$tpl = new template;
	$tpl -> Load("desktop");
	$tpl -> GetObjects();
	$tpl -> ConvertSelf();

	$tpl -> AssignArray(array("today.date" => date($CONF["LOCALE_LONG_DATE"])));

	/*
		We will only let logged in users access this page. It is
		quite obvious that a guest can't have a desktop - isnt it?
	*/
	if (me('id')) {

		/*
			We've confirmed this user is logged in, we will
			show the desktop
		*/
		$tpl -> Zone("main", "desktop");

		// MAILS ////////////////////////////////////////////////////////////////////////// FINAL //
		/*
			Query the database and get all the new mails
			the user received that are NOT marked as read
		*/
		$mailsSelect = "
			SELECT `id`
			FROM `[x]messages`
			WHERE `to`='".me('id')."'
			AND `sent_copy`!='1'
			AND `read`='0'
			ORDER BY `date` DESC
		";

		if ($mailsCounter = myNum($mailsSelect) > 0) {
			$headerNotification = "mails";
			$tpl -> AssignArray(array("mails.counter" => $mailsCounter));
		}

		// GROUPS AND CONTACTS //////////////////////////////////////////////////////////// FINAL //
		/*
			We load up the contacts pkd
			array and hold it in a variable
		*/
		$contactsArray = unpk(me("contacts"));

		/*
			Let's initialize some cyclic variables. Those are
			used as counters.
		*/
		$i=0;
		$totalContacts=0;
		$totalGroups=0;
		$totalOnline=0;

		/*
			We will only act if the contacts array is
			actually... an array!
		*/
		if (is_array($contactsArray)) {

			/*
				Loop inside the groups array
			*/
			foreach($contactsArray as $group => $usersArray) {

				/*
					Increments the groups counter
				*/
				$totalGroups++;

				/*
					Generate the contact groups array, this will
					be used to create the contacts groups tabs later.
				*/
				$contactsReplacementArray[$i]["tabName"] = $group;
				$contactsReplacementArray[$i]["userCount"] = (is_array($usersArray)?count($usersArray):0);

				/*
					Initialize / clear the contacts render variable for
					this group
				*/
				$contactsGroupRender = NULL;

				/*
					Loop inside the users array ... if it is an array!
				*/
				if (is_array($usersArray)) foreach ($usersArray as $userID) {

					if (_fnc("user", $userID, "id")) {

						/*
							Increments the users counter
						*/
						$totalContacts++;

						/*
							Get the user row
						*/
						$contactUserRow = myF("
							SELECT `id`,`username`,`mainpicture`,`last_load`
							FROM `[x]users`
							WHERE `id`='{$userID}'
						");

						/*
							Create an instance of a new template engine
							class call. We will use it to inject and parse
							the "user block" result.
						*/
						$contactBlockTemplate = new template;
						if ($contactUserRow["last_load"] > date("U")-180) {
							$contactBlockTemplate->LoadThis($GLOBALS["OBJ"]["onlineUserBlock"]);
							$totalOnline++;
						}

						else $contactBlockTemplate->LoadThis($GLOBALS["OBJ"]["userBlock"]);

						/*
							Assign the user array to the template replacement
							method ... the lazy way!
						*/
						$contactBlockTemplate->AssignArray($contactUserRow);


						/*
							Flush the result into a variable which
							will grow as we cycle through users
						*/
						$contactsGroupRender .= $contactBlockTemplate->Flush(1);
					}
				}

				/*
					$userArray was not an array, that must mean
					there was no user in this contact group, we
					will use the "no contact in this group" object
					instead.
				*/
				else $contactsGroupRender = $GLOBALS["OBJ"]["noContact"];

				/*
					Save the render into the contactsReplacementArray
					which will hold the tabs, the users count and the
					users list render.
				*/
				$contactsReplacementArray[$i]["tabContent"] = $contactsGroupRender;

				unset($contactsGroupRender);

				$i++;
			}

			/*
				Lets enable that zone and send the array to the looping engine.
			*/
			if (isset($contactsReplacementArray)) {
				$tpl->Zone("contactsTabsZone", "contactsTabEnabled");
				$tpl->Loop("contactsTabs", $contactsReplacementArray);
			}

			else $tpl->Zone("contactsTabsZone", "contactsTabNoGroup");

		}

		/*
			We never entered the loop, there is no
			group or no contacts to show. Let's use
			the disabled zone
		*/
		else $tpl->Zone("contactsTabsZone", "contactsTabNoGroup");

		/*
			We will pass the counters variables to the template.
			Regardless they where incremented or not, this can't
			produce any error as we started those with a zero value.
		*/
		$tpl->AssignArray(array(
			"contacts.onlineCount"=>$totalOnline,
			"contacts.userCount"=>$totalContacts,
			"contacts.groupCount"=>$totalGroups
		));

		// CONTACTS NOTIFICATIONS ///////////////////////////////////////////////////////// FINAL //
		/*
			Get the contact notification relationship request array
		*/
		$myNotifications = unpk(me("relationship_requests"));
		if (!is_array($myNotifications)) $myNotifications = array();

		/*
			If there is more than 0 notifications (at least one!), show
			the notifications message.
		*/
		if (count($myNotifications) > 0) {
			$tpl -> Zone("contactsNotification", "enabled");
			$headerNotification = "contacts";
			$tpl -> AssignArray(array("notification.count" => count($myNotifications)));
		}

		// LAST PROFILE VIEWS ///////////////////////////////////////////////////////////// FINAL //
		/*
			Load the last profile views array, confirm its
			an array...
		*/
		$lastProfileViewsArray = unpk(me('profile_views'));
		if (is_array($lastProfileViewsArray)) {

			/*
				Loop in the last profile views array
			*/
			$i=0;
			foreach (array_keys($lastProfileViewsArray) as $viewKey) {

				if ($lastProfileViewsArray[$viewKey]["username"]) {

					_fnc("prepare_user", $lastProfileViewsArray[$viewKey]["id"], "mainpicture,gender,age,username");
					/*
						Generate the profiles views replacement array
					*/
					$profileViewsReplacementArray[$i] = array(
						"view.username" => $lastProfileViewsArray[$viewKey]["username"],
						"view.time" => date($CONF["LOCALE_HEADER_DATE_TIME"], $lastProfileViewsArray[$viewKey]["date"]),
						"view.id" => $lastProfileViewsArray[$viewKey]["id"],
						"view.mainpicture" => _fnc("user", $lastProfileViewsArray[$viewKey]["id"], "mainpicture"),
						"view.gender" => _fnc("user", $lastProfileViewsArray[$viewKey]["id"], "gender"),
						"view.age" => _fnc("user", $lastProfileViewsArray[$viewKey]["id"], "age"),
						"view.date" => date($CONF["LOCALE_HEADER_DATE_TIME"], $lastProfileViewsArray[$viewKey]["date"]),
					);

					$i++;

					/*
						Keep a fingerprint of this last loop viewkey, this
						will be our total profile views counter.
					*/
					$residualTotalProfileViews = $viewKey;
				}
			}

			/*
				Let's confirm we have an array, and send it
				to the template engine for replacement.
			*/
			if (isset($profileViewsReplacementArray)) {
				$tpl -> Zone("profileViews", "enabled");
				$tpl -> Loop("profileViewsList", $profileViewsReplacementArray);
				$tpl -> AssignArray(array("views.total" => $residualTotalProfileViews + 1));
			}

			/*
				No array? Nobody saw that profile! Show
				the "noViews" message
			*/
			else $tpl->Zone("profileViews", "noViews");

		}

		else $tpl->Zone("profileViews", "noViews");

		// FAVORITE BLOGS ARTICLES //////////////////////////////////////////////////////// FINAL //
		/*
			Load favorite blogs users array
		*/
		$myFavorites = unpk(me('favorites'));
		if (isset($myFavorites["BLOGS"]) && is_array($myFavorites["BLOGS"])) {

			/*
				Loop in  the results
			*/
			$i=0;
			foreach ($myFavorites["BLOGS"] as $favoriteBlogUserID) {

				/*
					Get the database row for the last blog article
					wrote by that user
				*/
				$blogRow = myF("SELECT * FROM `[x]blogs` WHERE `user`='{$favoriteBlogUserID}' ORDER BY `date` DESC LIMIT 1");

				/*
					We will only proceed to the replacement array generation
					if the row exists... Actually this should be impossible
					that it doesn't but who knows...
				*/
				if (is_numeric($blogRow["id"])) {

					$blogReplacementArray[$i] = array(
						"blog.title" => $blogRow["title"],
						"blog.body" => _fnc("strtrim", _fnc("clearBodyCodes", $blogRow["body"]), 200),
						"blog.views" => $blogRow["views"],
						"blog.date" => date($CONF["LOCALE_SHORT_DATE_TIME"], $blogRow["date"]),
						"blog.user" => _fnc("user", $blogRow["user"], "username"),
						"blog.id" => $blogRow["id"],
						"blog.userid" => $blogRow["user"],
						"blog.mainpicture" => _fnc("user", $blogRow["user"], "mainpicture"),
						"blog.comments" => $blogRow["comments"]
					);

					$i++;
				}
			}

			/*
				If the replacement array exists, we will show that
				zone and give the results array to the template engine
			*/
			if (isset($blogReplacementArray)) {
				$tpl -> Zone("favoriteBlogs", "enabled");
				$tpl -> Loop("favoriteBlogsList", $blogReplacementArray);
			}
		}

		/*
			OoPs! Not an array? Ok well we got nothing
			to show, lets put the "no favs" message instead
		*/
		else $tpl->Zone("favoriteBlogs", "noFavorite");

		// DISPLAY SAVED SEARCHES ///////////////////////////////////////////////////
		if (!isset($myFavorites)) $myFavorites = unpk(me("favorites"));
		if (isset($myFavorites["SEARCHES"]) && is_array($myFavorites["SEARCHES"])) {

			$i=0;
			foreach($myFavorites["SEARCHES"] as $key => $favoriteSearchItem) {

				$favoriteSearchesReplacementArray[$i] = array(
					"search.name" => $favoriteSearchItem["NAME"],
					"search.get" => $favoriteSearchItem["GET"],
				);

				$i ++;
			}
		}

		if (isset($favoriteSearchesReplacementArray)) {
			$tpl -> Zone("savedSearchesBlock", "enabled");
			$tpl -> Loop("favoriteSearches", $favoriteSearchesReplacementArray);
		}

		// EVENTS CALENDAR //////////////////////////////////////////////////////////////// ##### //
		/*
			Print the calendar month name
		*/
		$tpl->AssignArray(array(
			"calendar.month"=>$GLOBALS["OBJ"]["month_".date("n")]
		));

		/*
			Let's create a new instance of a calendar
		*/
		if (!function_exists("calendar")) include_once("system/functions/classes/calendar.class.php");
		$cal = new calendar();

		/*
			Select all the events for the actual month
		*/

		$eventSelect = "
			SELECT `id`,`date`
			FROM `[x]events`
			WHERE `date` > '".date("U", mktime(0, 0, 0, date("m"), 1, date("Y")))."'
			AND `date` < '".date("U", mktime(0, 0, -1, date("m")+1, 0, date("Y")))."'
			AND (
				(`display`='private' AND `user`='".me("id")."')
				OR
				(`display`='shared' AND (`user`='myFriendID' OR `user`='myFriendID2'))
				OR
				(`display`='public')
				OR
				(`display`='system')
			)
			ORDER BY `date` DESC
			LIMIT 100
		";

		/*
			Loop in the results, inject values into the calendar object
		*/
		while ($eventRow = myF($eventSelect)) {
			$cal->injectDate(date("j", $eventRow["date"]), "?L=events.daily&ut={$eventRow["date"]}");
		}

		/*
			flush the calendar result into the assignarray
			method for the template engine.
		*/
		$tpl->AssignArray(array("calendar" => $cal->makeAndFlush()));

		// NEXT X EVENTS //////////////////////////////////////////////////////////////////
		/*
			Select the next 5 events
		*/
		$nextEventsSelect = "
			SELECT `id`,`date`,`title`
			FROM `[x]events`
			WHERE (
				(`display`='private' AND `user`='".me("id")."')
				OR
				(`display`='shared' AND (`user`='myFriendID' OR `user`='myFriendID2'))
				OR
				(`display`='public')
				OR
				(`display`='system')
			)
			AND `date` > '".date("U")."'
			ORDER BY `date` ASC
			LIMIT 5
		";

		/*
			Loop in the results, create the looping array
		*/
		$i=0;
		while ($nextEventRow = myF($nextEventsSelect)) {
			$nextEventsReplacementArray[$i]["event.title"] = _fnc("strtrim", $nextEventRow["title"], 30);
			$nextEventsReplacementArray[$i]["event.date"] = date($CONF["LOCALE_SHORT_DATE"], $nextEventRow["date"]);
			$nextEventsReplacementArray[$i]["event.id"] = $nextEventRow["id"];

			$i++;
		}

		/*
			Assign the array to the loop engine
		*/
		if (isset($nextEventsReplacementArray)) $tpl->Loop("nextEvents", $nextEventsReplacementArray);

		// SITE NEWS ////////////////////////////////////////////////////////////////////// FINAL //
		/*
			Load the site news array
		*/
		if (filesize("system/cache/news.dat") > 0) {
			$newsArticlesArray = array_reverse(unpk(file_get_contents("system/cache/news.dat")));

			/*
	 			Loop inside the news array values
			*/
			if (is_array($newsArticlesArray)) foreach ($newsArticlesArray as $articleKey => $articleArray) {

				/*
					We will check if selfuser is allowed
					to view this article... If so, we generate
					a replacement array
				*/
				if (
					(!isset($_SESSION["id"]) && in_array("g", $articleArray["access"]))
					||
					(isset($_SESSION["id"]) && in_array("u", $articleArray["access"]))
					||
					(in_array(me("account_type"), $articleArray["access"]))
				) {

					/*
						Generate the replacement array
					*/
					$newsArticleReplacementArray[] = array(
						"news.title" => $articleArray["title"],
						"news.body" => _fnc("convertBodyCodes", $articleArray["body"]),
						"news.date" => date($CONF["LOCALE_HEADER_DATE"], $articleArray["date"])
					);
				}
			}
		}
		/*
			.. and attribute it to the replacement
			method - if it exists!
		*/
		if (isset($newsArticleReplacementArray)) {
			$tpl -> Zone("siteNews", "enabled");
			$tpl -> Loop("siteNewsLoop", $newsArticleReplacementArray);
		}

		/*
			Or throw a nonews message :(
		*/
		else $tpl -> Zone("siteNews", "noNewsArticle");

		// PICTURES COUNTER ///////////////////////////////////////////////////////////////
		$myPictures = unpk(me("pictures"));
		if (!is_array($myPictures)) $myPictures = array();

		$totalPicturesCount = 0;
		$totalPrivatePicturesCount = 0;

		foreach($myPictures as $pictureArray) {
			$totalPicturesCount++;
			if ($pictureArray["PRIVATE"]) $totalPrivatePicturesCount++;
		}
		$tpl -> AssignArray(array(
			"pictures.total" => $totalPicturesCount,
			"pictures.private" => $totalPrivatePicturesCount
		));

		if ($totalPicturesCount == 0 && !isset($headerNotification)) $headerNotification = "picture";

		/* Load nudges array */
		$nudges = unpk(me("nudges"));

		/* Handle nudges clear order */
		if (isset($_GET["clearnudges"])) {
			myQ("UPDATE `[x]users` SET `nudges`='' WHERE `id`='".me('id')."'");
			$nudges = NULL;
		}

		/* Load received nudges */
		if (is_array($nudges)) {

			$tpl -> Zone("nudges", "block");

			$i=0;
			foreach ($nudges as $nArr) {
				$nudRep[$i]["nudge.user"] = $nArr["user"];
				$nudRep[$i]["nudge.body"] = $nArr["body"];
				$nudRep[$i]["nudge.icon"] = $nArr["icon"];
				$i++;
			}
			$tpl -> Loop("nudge", $nudRep);
		}

		/* Load horoscope data */
		$attrib = unpk(file_get_contents("system/cache/horoscope_attrib.dat"));
		$hArr = unpk(file_get_contents("system/cache/horoscopes.dat"));

		$sign = me('astrologic_sign');
		if ($sign == "") {
			$bDate = explode("/", me('birthdate'));

			/* find out the user's astrologic sign */
			switch ($bDate[0]) {
				case(1):
					$sign = ($bDate[1] < 19?"capricorn":"aquarius");
				break;
				case(2):
					$sign = ($bDate[1] < 19?"aquarius":"pisces");
				break;
				case(3):
					$sign = ($bDate[1] < 20?"pisces":"aries");
				break;
				case(4):
					$sign = ($bDate[1] < 20?"aires":"taurus");
				break;
				case(5):
					$sign = ($bDate[1] < 21?"taurus":"gemini");
				break;
				case(6):
					$sign = ($bDate[1] < 22?"gemini":"cancer");
				break;
				case(7):
					$sign = ($bDate[1] < 23?"cancer":"leo");
				break;
				case(8):
					$sign = ($bDate[1] < 23?"leo":"virgo");
				break;
				case(9):
					$sign = ($bDate[1] < 23?"virgo":"libra");
				break;
				case(10):
					$sign = ($bDate[1] < 24?"libra":"scorpio");
				break;
				case(11):
					$sign = ($bDate[1] < 22?"scorpio":"sagittarius");
				break;
				case(12):
					$sign = ($bDate[1] < 22?"sagittarius":"capricorn");
				break;
			}

			myQ("UPDATE `[x]users` SET `astrologic_sign`='{$sign}' WHERE `id`='".me('id')."'");
		}

		if (!isset($attrib[$sign]["date"]) || $attrib[$sign]["date"] != date("U", mktime(0,0,0,date("m"),date("d"),date("Y")))) {
			/* was not attributed today, lets randomize and attribute another horoscope */
			$attrib[$sign]["date"] = date("U", mktime(0,0,0,date("m"),date("d"),date("Y")));
			$attrib[$sign]["id"] = rand(0,count($hArr));

			/* Save the new array */
			if ($handle = fopen("system/cache/horoscope_attrib.dat", "w")) {
				fwrite($handle, pk($attrib));
				fclose($handle);
			}
		}

		if (isset($hArr[$attrib[$sign]["id"]]["body"]["english"])) {
			$tpl -> AssignArray(array(
				"today.horoscope" => stripslashes($hArr[$attrib[$sign]["id"]]["body"]["english"]),
			));
		}

		// BLOGS TODAY //////////////////////////////////////////////////////////////////// FINAL //
		/*
			Get all the blog articles for today
		*/
		$blogsTodaySelect = "
			SELECT *
			FROM `[x]blogs`
			WHERE `date` > '".(date("U")-(60*60*24))."'
			ORDER BY `date` DESC
			LIMIT 10
		";

		if (myNum($blogsTodaySelect) > 0) {
			while ($blogsTodayRow = myF($blogsTodaySelect)) {

				$blogsTodayReplacementArray[$i] = array(
					"blog.title" => _fnc("strtrim", $blogsTodayRow["title"], 50),
					"blog.mainpicture" => _fnc("user", $blogsTodayRow["user"], "mainpicture"),
					"blog.id" => $blogsTodayRow["id"],
					"blog.userid" => $blogsTodayRow["user"],
					"blog.username" => _fnc("user", $blogsTodayRow["user"], "username"),
					"blog.time" => date($CONF["LOCALE_SHORT_TIME"], $blogsTodayRow["date"]),
					"blog.words" => substr_count($blogsTodayRow["body"], " ")
				);

				$i ++;
			}

			$tpl -> Zone("blogsToday", "enabled");
			$tpl -> Loop("blogsTodayLoop", $blogsTodayReplacementArray);
		}

		// COMMENTS TODAY //////////////////////////////////////////////////////////////////// FINAL //
		/*
			Get all the blog articles for today
		*/
		$commentsTodaySelect = "
			SELECT *
			FROM `[x]comments`
			WHERE `date` > '".(date("U")-(60*60*24))."'
			AND (`relative` = '".me("id")."' AND `type` = 'user')
			ORDER BY `date` DESC
			LIMIT 10
		";

		if (myNum($commentsTodaySelect) > 0) {
			while ($commentsTodayRow = myF($commentsTodaySelect)) {

				_fnc("prepare_user", $commentsTodayRow["user"], "mainpicture,username");

				$commentsTodayReplacementArray[$i] = array(
					"comment.body" => _fnc("strtrim", $commentsTodayRow["body"], 300),
					"comment.mainpicture" => _fnc("user", $commentsTodayRow["user"], "mainpicture"),
					"comment.userid" => $commentsTodayRow["user"],
					"comment.username" => _fnc("user", $commentsTodayRow["user"], "username"),
					"comment.time" => date($CONF["LOCALE_SHORT_TIME"], $commentsTodayRow["date"]),
				);

				$i ++;
			}

			$tpl -> Zone("commentsToday", "enabled");
			$tpl -> Loop("commentsTodayLoop", $commentsTodayReplacementArray);
		}

		// VOTES COMPUTING //////////////////////////////////////////////////////////////// FINAL //
		/*
			Get the votes array, make sure its an array
			or make it an array
		*/
		$votesArray = unpk(me("profile_votes"));
		if (!is_array($votesArray)) $votesArray = array();

		/*
			Create some cyclic variables
		*/
		$i = 0;
		$totalVotesPoints = 0;

		/*
			Loop in votes array
		*/
		foreach($votesArray as $userID => $thisVoteValue) {
			$totalVotesPoints = $totalVotesPoints + $thisVoteValue;

			$i++;

			/*
				Keep a residual fingerprint of the last $i
				value. This is used as a "total votes" counter.
			*/
			$residualVotesCounter = $i;
		}

		/*
			Assing the results for replacement
		*/
		$tpl -> AssignArray(array(
			"votes.average" => ($i>0?round($totalVotesPoints/$i):0),
			"votes.total" => (isset($residualVotesCounter)?$residualVotesCounter:0)
		));

		// HEADER NOTIFICATION SWITCHING ////////////////////////////////////////////////// FINAL //
		if (isset($headerNotification)) switch ($headerNotification) {

			case("contacts"):
				$tpl -> Zone("notifications", "newContact");
			break;

			case("mails"):
				$tpl -> Zone("notifications", "newMail");
			break;

			case("picture"):
				$tpl -> Zone("notifications", "noPicture");
			break;

			default:
				$tpl -> Zone("notifications", "default");
			break;
		}

		else $tpl -> Zone("notifications", "default");

		//


	/*
		Oh - Not logged in?
	*/
	} else {
		$tpl -> Zone("main", "nouser");
		_fnc("reload", "3", "?L=");
	}

	// FLUSH TEMPLATE ///////////////////////////////////////////////////////////////////// FINAL //
	$tpl -> CleanZones();
	$tpl -> Flush();

?>
