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
	$tpl -> Load("edit");	
	
	/*
		Get the blog entry row
	*/
	$row = myF(myQ("SELECT * FROM `[x]blogs` WHERE `id`='{$_GET["id"]}'"));
	
	if ($row["user"] != me("id") && !me("is_administrator") && !me("is_superadministrator")) {
		
		$tpl -> Zone("blogEditBlock", "restricted");
		$tpl -> Zone("blogEditHeader", "edit");
		
		_fnc("reload", 5, "?L=blog.browse");
	}
	
	else {
	
		$tpl->Zone("blogEditBlock", "enabled");
	
		// HANDLE POST /////////////////////////////////////////////////////////////////
		if (isset($_POST["Submit"])) {
			if (isset($_POST["title"]) && $_POST["title"] != "" && isset($_POST["body"]) && $_POST["body"] != "") {
				
				myQ("
					UPDATE `[x]blogs`
					SET
					  `title`='{$_POST["title"]}',
					  `body`='{$_POST["body"]}'
					WHERE `id`='{$_GET["id"]}'
				");
				
				$row["title"] = $_POST["title"];
				$row["body"] = $_POST["body"];
				
				$tpl->Zone("blogEditHeader", "saved");
				
				_fnc("reload", 3, "?L=blogs.blog&article={$_GET["id"]}");

			} else $tpl->Zone("blogEditHeader", "error");
			
		} else $tpl->Zone("blogEditHeader", "edit");
		
		$tpl -> AssignArray(array(
			"article.title" => $row["title"],
			"article.body" => $row["body"]
		));
	}


	$tpl -> Flush();
	
?>