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
	
	// TEMPLATE HANDLING //////////////////////////////////////////////////////////////
	/*
		Initialize the template engine & load the
		template file into the buffer
	*/
	$tpl = new template;
	$tpl -> Load("blog");
	$tpl -> GetObjects();

	// LOAD UP THE BLOG DATA ROW //////////////////////////////////////////////////////
	/* 
		This switch swaps from a provided user ID 
		to a provided blog article ID, it will load
		the latest blog article data for this user or
		for the given blog article ID.
	*/
	if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
		/*
			We got a user ID, this will load the
			latest blog entry for the given user
		*/
		$row = myF(myQ("SELECT * FROM `[x]blogs` WHERE `user`='{$_GET["id"]}' ORDER BY DATE DESC LIMIT 1"));

		/*
			Lets tell the template to use the
			"latest blog article" string.
		*/
		$tpl -> Zone("blogGetMethod", "latestArticle");
		$tpl -> Zone("blogArticleBlock", "enabled");
	
		/*
			We somehow have to compute the latest blog
			article date, since we're loading it now, 
			let's set that variable
		*/
		$lastBlogArticleDate = $row["date"];
	
		/*
			Keep a record of the article and user ID entry as well 
			as the total comments on this article for future 
			reference later in the code
		*/
		$thisArticleID = $row["id"];
		$thisUserID = $row["user"];
		$thisTotalComments = $row["comments"];
		
		/*
			No article to show
		*/
		if (!$row["id"]) {
			$tpl -> LoadThis($GLOBALS["OBJ"]["blogEmpty"]);
			_fnc("reload", 5, "?L=users.desktop");
		}
		
		
	} elseif (isset($_GET["article"]) && is_numeric($_GET["article"])) {
		/*
			We got an article ID, this loads it
		*/
		$row = myF(myQ("SELECT * FROM `[x]blogs` WHERE `id`='{$_GET["article"]}' LIMIT 1"));

		/*
			Lets tell the template to use the
			"blog article by ..." string.
		*/
		$tpl -> Zone("blogGetMethod", "givenArticle");
		
		/*
			Keep a record of the article and user ID entry as well 
			as the total comments on this article for future 
			reference later in the code
		*/
		$thisArticleID = $row["id"];
		$thisUserID = $row["user"];
		$thisTotalComments = $row["comments"];
		
		/*
			Since we only have an article ID, we will
			also have to load the last article date
			as it is required in the template
		*/
		$lastArticle = myF(myQ("SELECT `date` FROM `[x]blogs` WHERE `user`='{$row["user"]}' ORDER BY DATE DESC LIMIT 1"));
		$lastBlogArticleDate = $lastArticle["date"];
		unset($lastArticle);
		
	} else {
		/* 
			Nothing to load ... throw an error :( 
		*/
		die("No USER / ARTICLE id provided. Unable to act");
		_fnc("reload", 3, "?L=users.deskop");
	}
	
	// INCREMENT VIEWS COUNTER ////////////////////////////////////////////////////////
	/* 
		No! Reloading the same page over and over won't
		force the views counter to increment ;) - We will
		set a temporary value for this user and check if
		we will increment the counter or not.
	*/
	if (!isset($_SESSION["LAST_BLOG_ARTICLE_ID"]) || $_SESSION["LAST_BLOG_ARTICLE_ID"] != $thisArticleID) {
		/*
			Create the blog article view pointer so
			we don't increment if the user reload the page
		*/
		$_SESSION["LAST_BLOG_ARTICLE_ID"] = $thisArticleID;
		/*
			Update the database views count entry
		*/
		if ($row["id"]) myQ("UPDATE `[x]blogs` SET `views`='".++$row["views"]."' WHERE `id`='{$thisArticleID}'");
	}
	
	// SET COUNTERS VALUES ////////////////////////////////////////////////////////////
	/*
		The page template offer some basic "count" data
		for the given user. We already saved the last post
		date earlier, we also will get total articles.
		The first thing to do is to check if the date is 
		valid so we don't print something like "last article
		wrote in 1969" ;) This will also tell us if we will
		continue processing as if the last post date is
		zero, it also means the user never posted an 
		article so all the other counter values are zeros.
	*/
	if ($lastBlogArticleDate > 0) {
		$lastBlogArticleDateRender = date($CONF["LOCALE_SHORT_DATE"], $lastBlogArticleDate);
		
		/* 
			Get the total number of articles the user 
			wrote and the total comments he/she got for
			all the articles together.
		*/
		$counters = myF(myQ("
			SELECT 
				SUM(`comments`) as `totalComments`, 
				COUNT(`id`) as `totalCount` 
			FROM `[x]blogs` 
			WHERE `user`='{$row["user"]}'"
		));
		
		/*
			Assign the values to the template engine
		*/
		$tpl->AssignArray(
			array(
				"count.articles"=>$counters["totalCount"],
				"count.comments"=>$counters["totalComments"],
				"count.lastarticle"=>$lastBlogArticleDateRender
			)
		);
	}

	/*
		The last posted article date was zero so all the 
		counters are supposed to be zero (the user never
		wrote an article) - Let's pass zeros to the 
		template engine
	*/		
	else $tpl->AssignArray(array("count.articles"=>0,"count.comments"=>0,"count.lastarticle"=>0));

	// TEMPLATE - BLOG DATA ROW CONVERSION ////////////////////////////////////////////
	/*
		We will convert some variable data before we
		pass the row to the template engine so the
		output data is formatted correctly.
	*/
	$row["date"] = date($CONF["LOCALE_LONG_DATE_TIME"], $row["date"]);
	if (isset($row["body"])) $row["body"] = _fnc("convertBodyCodes", $row["body"]);

	/* 
		Assign the blog database entry row for replacement 
	*/
	$tpl->AssignRow("blog", $row);
	
	// TEMPLATE - USER DATA ROW CONVERSION ////////////////////////////////////////////
	/*
		Assign the user for replacement (as this is
		a switching system between two tables, we
		will use the blog' user entry as it is
		safer.
	*/
	if (isset($row["user"])) $tpl->AssignUser($row["user"]);
	
	// ADD TO FAVORITES //////////////////////////////////////////////////////////////
	/* 
		Load the visitor's blog favorites data. We
		will only allow the "add to favorite" link
		to work if the user's ID is not the same
		as the blog's author ID.
	*/
	if ($thisUserID != me("id") && me("id") != "") {
		
		$myFav = unpk(me("favorites"));
		if ((is_array($myFav["BLOGS"]) && !in_array($thisUserID, $myFav["BLOGS"])) || (!is_array($myFav["BLOGS"]))) {
			
			/* 
				We got a request to add this blog to
				the favorites list. Actually a favorite
				blog entry is the author's user ID.
			*/
			if (isset($_GET["fav"])) {
				$myFav["BLOGS"][] = $thisUserID;
				myQ("UPDATE `[x]users` SET `favorites`='".pk($myFav)."' WHERE `id`='".me('id')."'");
			} 
			
			/*
				We didnt got a request, but we know
				that his user is not the author, and
				that this blog entry is NOT in the
				selfuser's favorites array. We will
				tell the template engine to show the
				"add to favotires" link.
			*/			
			else $tpl->Zone("addToFavorites", "enabled");
		}
	}
	
	// BLOG CONTROL LINKS ////////////////////////////////////////////////////////////
	/*
		We will show blog control links (edit and delete) to
		the article author and to the administrator(s). 
	*/
	if ($thisUserID == me("id") || me("is_administrator") || me("is_superadministrator")) {
		$tpl -> Zone("blogControlLinks", "enabled");
	}

	// LAST 10 BLOGS ARTICLES ////////////////////////////////////////////////////////
	/* 
		Get latest 10 blog articles from the same author. We 
		will order this by date, limit the query to 10 items, and
		exclude the article we're currently reading!
		
	*/
	$select = myQ("SELECT * FROM `[x]blogs` WHERE `user`='{$thisUserID}' AND `id`!='{$thisArticleID}' ORDER BY `date` DESC LIMIT 10");
	
	/*
		If there was a result for this query,
		we will pass this new row to the template
		engine for replacement.
	*/
	if (myNum($select) > 0) {

		/*
			Let's first activate the latest articles
			zone in the template
		*/
		$tpl -> Zone("latestBlogArticles","enabled");
		
		/*
			Loop inside the results, pass the data to 
			the looping engine
		*/
		$i=0;
		while ($blogRow = myF($select)) {

			$latestBlogArticleArray[$i]["latest.title"] = _fnc("strtrim", $blogRow["title"], 20);
			$latestBlogArticleArray[$i]["latest.id"] = $blogRow["id"];
			$latestBlogArticleArray[$i]["latest.date"] = date($CONF["LOCALE_SHORT_DATE"], $blogRow["date"]);
			$latestBlogArticleArray[$i]["latest.views"] = $blogRow["views"];
			$latestBlogArticleArray[$i]["latest.comments"] = $blogRow["comments"];
							
			$i++;
		}
		
		/* 
			Assign the latest blog articles array to the
			looping zone in the template engine
		*/		
		$tpl -> Loop("latestBlogArticlesLoop", $latestBlogArticleArray);
	} 
	
	/*
		There was no more "latest blog articles" found
		in the database. We will set the template zone
		accordinately
	*/
	else $tpl -> Zone("latestBlogArticles","disabled");
	
	// BLOGS ARTICLES CALENDAR //////////////////////////////////////////////////////
	if (!function_exists("calendar")) include_once("system/functions/classes/calendar.class.php");
	
	/*
		Generate the two main "archived articles" calendar
		grids and inject past posts into those.
	*/
	$thisMonthCalendar = new calendar();
	$lastMonthCalendar = new calendar(date("m")-1);
	
	/*
		We will query for all the articles wrote by this 
		author in the last 2 months.
	*/
	$twoMonthsBehind = date("U", mktime(0,0,0,date("m")-1,1,date("Y")));
	if (isset($row["user"])) {
		$archivesSelect = myQ("
			SELECT `date`,`id` 
			FROM `[x]blogs` 
			WHERE `user`='{$row["user"]}' 
			AND `date` >= '{$twoMonthsBehind}'
		");
	}

	/*
		The oneMonthBehind variable is the "U" date of the
		first day of this month. We will process this here 
		so we don't call the "date" function each time the
		loop cycles.
	*/
	$oneMonthBehind = date("U", mktime(0,0,0,date("m"),1,date("Y")));
	/*
		Loop inside results and attribute the articles to
		their respective calendar.
	*/
	if (isset($archiveRow)) while ($archiveRow = myF($archivesSelect)) {
		
		/*
			The article date belongs to this actual
			month, we will attribute it to the first
			calendar
		*/
		if ($archiveRow["date"] >= $oneMonthBehind) {
			$thisMonthCalendar->injectDate(date("j", $archiveRow["date"]), "?L=blogs.blog&article={$archiveRow["id"]}");
		} else {
			/*
				The article belogngs to the previous month
			*/
			$lastMonthCalendar->injectDate(date("j", $archiveRow["date"]), "?L=blogs.blog&article={$archiveRow["id"]}");
		}
	}
	
	/*
		Flush the calendar results into the
		template system so they're printed
	*/
	$tpl->AssignArray(
		array(
			"thisMonthCalendar" => $thisMonthCalendar->makeAndFlush(),
			"lastMonthCalendar" => $lastMonthCalendar->makeAndFlush()
		)
	);
	
	/*
		We will give the calendars a month name
		label. This is done through template objects.
	*/
	$tpl->AssignArray(
		array(
			"thisMonthLabel" => $GLOBALS["OBJ"]["month_".date("n")],
			"lastMonthLabel" => $GLOBALS["OBJ"]["month_".date("n", mktime(0,0,0,date("m")-1,1,date("Y")))]
		)
	);
	
	// HANDLE COMMENT REMOVAL ///////////////////////////////////////////////////////
	if (isset($_GET["rmcomment"]) and is_mop()) {
		myQ("DELETE FROM `[x]comments` WHERE `id`='{$_GET["rmcomment"]}'");
	}

	// HANDLE POSTED COMMENTS ///////////////////////////////////////////////////////
	/* 
		Only let logged-in non-blocked users
		write comments on blogs.
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
						'{$thisArticleID}',
						'blog',
						'{$_POST["title"]}',
						'{$_POST["body"]}',
						'{$_POST["polarity"]}'
					)
				");
				/*
					update the blog article data row to reflect the 
					new comments count
				*/
				myQ("UPDATE `[x]blogs` SET `comments`='".++$thisTotalComments."' WHERE `id`='{$thisArticleID}'");
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

	// SHOW COMMENTS ///////////////////////////////////////////////////////////////
	/*
		We will get all the comments left for this
		blog article. Note that this occurs AFTER
		any comment got posted so we're sure we are
		getting the updated and accurate data from
		the database.
	*/
	$select = myQ("
		SELECT * 
		FROM `[x]comments` 
		WHERE `relative`='{$thisArticleID}' 
		AND `type`='blog'
		ORDER BY `date` DESC
	");
	
	/*
		If there was more than zero comments found
		for this article, we will show those on the
		blogs page.
	*/
	if (myNum($select) > 0) {
		
		/*
			Enabled the article comments block in the
			template
		*/
		$tpl -> Zone("blogArticleCommentsBlock", "enabled");
	
		/*
			Loop inside the results and generate the
			comments row array to be passed to the looping
			engine
		*/
		while ($commentRow = myF($select)) {
			$commentRowArray[] = array(
				"comment.id" => $commentRow["id"],
				"comment.username" => _fnc("user", $commentRow["user"], "username"),
				"comment.userid" => $commentRow["user"],
				"comment.usermainpicture" => _fnc("user", $commentRow["user"], "mainpicture"),
				"comment.date" => date($CONF["LOCALE_LONG_DATE_TIME"], $commentRow["date"]),
				"comment.title" => _fnc("strtrim", $commentRow["title"], 40),
				"comment.body" => _fnc("clearBodyCodes", $commentRow["body"]),
				"comment.polarity" => $commentRow["polarity"]
			);
		}

		/* 
			If the array exists, we will pass its
			content to the looping engine for replacement.
		*/		
		if (isset($commentRowArray)) $tpl -> Loop("blogArticleComments", $commentRowArray);
	} 

	/*
		There was no comment for this blog article.
		We will disable the comments block in the
		template
	*/
	else $tpl -> Zone("blogArticleCommentsBlock", "disabled");
	
	// HANDLE BLOG ARTICLE DELETION /////////////////////////////////////////////////
	/*
		We will handle blog deletion if requested - this can
		only be triggered by the blog owner, or by an administrator.
	*/
	if (isset($_GET["rm"])) {
		if ($thisUserID == me("id") || me("is_administrator") || me("is_superadministrator")) {
		
			/*
				We will throw the blog article and all the related blog comments
			*/
			myQ("DELETE FROM `[x]blogs` WHERE `id`='{$thisArticleID}' LIMIT 1");
			myQ("DELETE FROM `[x]comments` WHERE `relative`='{$thisArticleID}' AND `type`='blog'");
			
			_fnc("reload", 0, "?L=blogs.browse");

		}
	}
	
	// FEOF FLUSH ///////////////////////////////////////////////////////////////////
	/*
		Clear the remaining zones in the theme. 
		This should theorically not be necessary
		but as the error is a human thing... lets
		just don't push our luck! ;)
	*/
	$tpl -> CleanZones();
	
	/*
		We're done processing that page. Let's flush
		the template buffer and let the rest of the 
		structure finish processing.
	*/
	$tpl -> Flush();
	
?>