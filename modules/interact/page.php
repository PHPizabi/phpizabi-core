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
	$tpl -> Load("page");
	
	if (isset($_GET["id"]) && is_numeric($_GET["id"])) $tpl -> AssignUser($_GET["id"]);
	else die("No user ID provided, unable to act");
	
	
	if (isset($_POST["Submit"])) {
	
		/*
			Paging flood protection
		*/
		if (isset($_SESSION["LAST_PAGE_UDATE"]) && $_SESSION["LAST_PAGE_UDATE"] > date("U")-130) $tpl->Zone("page", "floodControl");
				
		else {
			
			$_SESSION["LAST_PAGE_UDATE"] = date("U");
		
			/*
				If the user is online, we will send the page
				to the lane system
			*/
			if (_fnc("user", $_GET["id"], "last_load") > date("U")-300) {

				_fnc("laneMakeToken", "page", $_GET["id"], array(
					"{user.username}" => me("username"),
					"{body}" => _fnc("strtrim", $_POST["body"], 30)
				));
			}
			
			/*
				Show the success message
			*/
			$tpl->Zone("page", "success");
		}
	}
	
	
	else $tpl->Zone("page", "enabled");

	
	$tpl -> Flush();
	
?>