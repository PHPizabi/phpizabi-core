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
		Initialize the template engine and load the
		template file
	*/
	$tpl = new template;
	$tpl -> Load("browse");
	$tpl -> ConvertSelf();
	
	/*
		Let's get the last 50 blogs and show them
	*/
	$select = myQ("SELECT * FROM `[x]blogs` ORDER BY `date` DESC LIMIT 20");
	
	/*
		... and loop inside those results, creating
		the replacement array
	*/
	$i=0;
	while ($row = myF($select)) {

		$blogArticle[$i]["blog.title"] = $row["title"];
		$blogArticle[$i]["blog.body"] = _fnc("strtrim", _fnc("clearBodyCodes", $row["body"]), 100);
		$blogArticle[$i]["blog.id"] = $row["id"];
		$blogArticle[$i]["blog.userid"] = $row["user"];
		$blogArticle[$i]["blog.date"] = date($CONF["LOCALE_SHORT_DATE_TIME"], $row["date"]);
		$blogArticle[$i]["blog.views"] = $row["views"];
		$blogArticle[$i]["blog.comments"] = $row["comments"];
		$blogArticle[$i]["blog.mainpicture"] = _fnc("user", $row["user"], "mainpicture");
		$blogArticle[$i]["blog.username"] = _fnc("user", $row["user"], "username");
	
		$i++;
	}
	
	/*
		Pass the replacement array to the template 
		engine
	*/
	if (isset($blogArticle)) $tpl->Loop("blogArticles", $blogArticle);


	/*
		Let's load the last 100 titles and IDs for
		the longer list. We will pick our first result
		at position 20 (since we already shown the
		20 first ones)
	*/
	$listSelect = myQ("SELECT `id`,`title` FROM `[x]blogs` ORDER BY `date` DESC LIMIT 100");
	
	/*
		And loop this
	*/
	$i=0;
	while ($listRow = myF($listSelect)) {
		
		$blogList[$i]["articlesList.id"] = $listRow["id"];
		$blogList[$i]["articlesList.title"] = _fnc("strtrim", $listRow["title"], 40);
		
		$i++;
	}
	
	/*
		if the array exist, we send its content
		to the loop engine
	*/
	if (isset($blogList)) $tpl->Loop("blogArticlesList", $blogList);
	
	/* 
		Show the write options if we're logged in
	*/
	if (me("id")) $tpl -> Zone("writeOptions", "enabled");
	
	$tpl -> CleanZones();
	$tpl -> Flush();
?>
	
		