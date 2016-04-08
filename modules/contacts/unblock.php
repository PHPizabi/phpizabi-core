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
	$tpl -> Load("unblock");
	$tpl -> AssignUser($_GET["id"]);

	if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
		$tpl -> Zone("unblock", "nouser");
		_fnc("reload", "3", "?L=users.desktop");
	} 
	
	elseif ($_GET["id"] == me('id')) {
		$tpl -> Zone("unblock", "self");
		_fnc("reload", "3", "?L=users.desktop");
	} else {
		
		/* Get and prepare the block array */
		$array = me('block');
		if (!is_null($array) && $array != "") {
			$array = unpk($array);
		} else {
			$array = array();
		}
		
		/* User was not blocked */
		if (!in_array($_GET["id"], $array)) {
			$tpl -> Zone("unblock", "noblock");
			_fnc("reload", "3", "?L=users.desktop");
		} else {
		
		
			/* Handle the unblock request */
			if (isset($_POST["unblock"])) {				
				
				foreach($array as $key => $value) {
					if ($value == $_GET["id"]) {
						unset($array[$key]);
					}
				}
								
				myQ("UPDATE `[x]users` SET `block`='".pk($array)."' WHERE `id`='".me('id')."'");
	
				$tpl -> Zone("unblock", "unblocked");
				_fnc("reload", "3", "?L=users.desktop");
				
			} 
			
			elseif (isset($_POST["cancel"])) {
				$tpl -> CleanZones();
				_fnc("reload", "0","?L=users.desktop");
			} 
			
			else {
				$tpl -> Zone("unblock", "question");
			}
		}
	}

	$tpl -> Flush();
?>