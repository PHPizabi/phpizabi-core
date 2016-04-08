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
	$tpl -> Load("remove");
	$tpl -> AssignUser($_GET["id"]);
	
	
	if (isset($_GET["id"])) {
		
		if (!isset($_POST["remove"]) and !isset($_POST["noremove"])) {
			$tpl -> Zone("remove", "question");
		}
		
		/*
			The user answered the question!
		*/
		elseif (isset($_POST["remove"])) {
			
			/*
				Load the contacts array
			*/
			if (!is_array($myContacts = unpk(me("contacts")))) $myContacts = array();
			
			foreach ($myContacts as $groupName => $groupArray) {
				if (is_array($groupArray)) foreach($groupArray as $userEntryKey => $userId) {
					if ($userId == $_GET["id"]) unset($myContacts[$groupName][$userEntryKey]);
				}
			}
			myQ("UPDATE `[x]users` SET `contacts`='".pk($myContacts)."' WHERE `id`='".me('id')."'");
			
			_fnc("reload", 3, "?L=contacts.contacts");
			$tpl -> Zone("remove", "removed");
		}
		
		else _fnc("reload", 0, "?L=contacts.contacts");
		
	} 
	
	/*
		No user ID specified
	*/
	else $tpl -> Zone("remove", "nouser");
	
	$tpl -> CleanZones();
	$tpl -> Flush();
	
?>