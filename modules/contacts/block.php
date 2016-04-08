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
	$tpl -> Load("block");
	$tpl -> AssignUser($_GET["id"]);

	if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
		$tpl -> Zone("block", "nouser");
		_fnc("reload", "3", "?L=users.desktop");
	} 
	
	elseif ($_GET["id"] == me('id')) {
		$tpl -> Zone("block", "self");
		_fnc("reload", "3", "?L=users.desktop");
	} else {
		
		/* Get and prepare the block array */
		$array = me('block');
		if (!is_null($array) && $array != "") {
			$array = unpk($array);
		} else {
			$array = array();
		}
		
		/* Prevent duplicated blocks */
		if (in_array($_GET["id"], $array)) {
			$tpl -> Zone("block", "duplicate");
			_fnc("reload", "3", "?L=users.desktop");
		} else {
		
		
			/* Handle the block request */
			if (isset($_POST["block"])) {				
				$array[] = $_GET["id"];
				myQ("UPDATE `[x]users` SET `block`='".pk($array)."' WHERE `id`='".me('id')."'");
	
				/* Load user contacts */			
				$contacts = unpk(me('contacts'));

				/* Find if this user is in the contacts list, remove it if it is */
				$dbsave = false;
				if (is_array($contacts)) {
					foreach($contacts as $groupname => $grouparray) {
						if (is_array($grouparray)) {
							foreach ($grouparray as $key => $val) {
								if ($val == $_GET["id"]) {
									unset ($contacts[$groupname][$key]);
									$dbsave = true;
								}
							}
						}
					}
				}
				if ($dbsave) myQ("UPDATE `[x]users` SET `contacts`='".pk($contacts)."' WHERE `id`='".me('id')."'");
				
				$tpl -> Zone("block", "blocked");
				_fnc("reload", "3", "?L=users.desktop");
				
			} 
			
			elseif (isset($_POST["noblock"])) {
				_fnc("reload", "0","?L=users.desktop");
			} 
			
			else {
				$tpl -> Zone("block", "question");
			}
		}
	}

	$tpl -> Flush();
?>