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

	// TEMPLATE HANDLING //////////////////////////////////////////////////////
	/*
		Create a new instance of the template class, load
		the template file and get the objects
	*/
	$tpl = new template;
	$tpl -> Load("contacts");
	$tpl -> GetObjects();

	if (isset($_SESSION["id"]) && !$GLOBALS["CHROMELESS_MODE"]) {
		$tpl->Zone("contactsPage", "enabled");
		
		/* 
			We will load the user's contacts array and
			unpack it.
		*/
		if (isset($_SESSION["id"])) $myContacts = unpk(me("contacts"));
		if (!isset($myContacts) || !is_array($myContacts)) $myContacts = array();
		
		// ADD A GROUP ////////////////////////////////////////////////////////////
		/*
			Handle a posted group if its set
		*/
		if (isset($_POST["addGroup"]) && isset($_POST["groupName"]) && $_POST["groupName"] != "")  {
	
			/*
				Now make sure this group doesn't already exist
			*/
			if (!isset($contacts[$_POST["groupName"]])) {
	
				/*
					Create an empty array for this group
				*/
				$myContacts[$_POST["groupName"]] = array();
				
				/*
					And save the results to the DB
				*/
				myQ("UPDATE `[x]users` SET `contacts`='".pk($myContacts)."' WHERE `id`='".me("id")."'");
			}
		}
		
		// GROUP REMOVAL ///////////////////////////////////////////////////////////////////
		/*
			Handle group removal
		*/
		if (isset($_GET["rmgroup"]) && in_array(base64_decode($_GET["rmgroup"]), array_keys($myContacts))) {
			
			/* 
				Remove that group (unset its value(s))
			*/
			unset($myContacts[base64_decode($_GET["rmgroup"])]);
			
			/*
				Save the contacts array
			*/
			myQ("UPDATE `[x]users` SET `contacts`='".pk($myContacts)."' WHERE `id`='".me("id")."'");
		}

		// LIST CONTACTS ////////////////////////////////////////////////////////////////////
		/*
			List Contacts and groups - First let's create some
			zero values for the cyclic counters
		*/
		$i=0;
		$n=0;
		$groupsCount = 0;
		$contactsCount = 0;
	
		/*
			... and loop inside the results
		*/
		foreach($myContacts as $groupName => $usersArray) {
			
			$groupsCount++;
			$contactsCount += count($usersArray);
			
			/*
				Create the groups control replacement
				array
			*/
			$groupsControlArray[] = array(
				"groupControl.groupName" => $groupName,
				"groupControl.groupNameEncode" => base64_encode($groupName)
			);
			
			/*
				Loop inside the users aray for each group
			*/
			if (is_array($usersArray)) foreach ($usersArray as $userArrayKey => $userEntity) {
				
				$contactsListReplacementArray[] = array(
					"list.id" => $userEntity,
					"list.username" => _fnc("user", $userEntity, "username"),
					"list.mainpicture" => _fnc("user", $userEntity, "mainpicture"),
					"list.gender" => _fnc("user", $userEntity, "gender"),
					"list.age" => _fnc("user", $userEntity, "age"),
					"list.group" => $groupName,
					"list.online" => (_fnc("user", $userEntity, "last_load")>date("U")-300?$GLOBALS["OBJ"]["online"]:$GLOBALS["OBJ"]["offline"]),
				);
			}
		}
		
		if (isset($contactsListReplacementArray)) {
			$tpl -> Zone("contactsListBlock", "enabled");
			$tpl -> Loop("contactsList", $contactsListReplacementArray);
		}
		
		$tpl -> AssignArray(array(
			"g.contacts" => $contactsCount,
			"g.groups" => $groupsCount
		));
		
		if (isset($groupsControlArray)) {
			$tpl -> Zone("groupsControl", "enabled");
			$tpl -> Loop("groupsControlList", $groupsControlArray);
		}

		// DISMISS RELATIONSHIP REQUEST ///////////////////////////////////////////////////
		if (isset($_GET["dismiss"]) && is_numeric($_GET["dismiss"])) {
			
			/*
				Get the contacts notification array
			*/
			$relationshipArray = unpk(me("relationship_requests"));
			
			if (is_array($relationshipArray) && in_array($_GET["dismiss"], $relationshipArray)) {
				/*
					Pop the element off the array
				*/
				$relationshipArray = _fnc("array_remove", $_GET["dismiss"], $relationshipArray);
				myQ("
					UPDATE `[x]users` 
					SET `relationship_requests` = '".pk($relationshipArray)."' 
					WHERE `id`='".me("id")."'
				");
			}
		}
		
		// RELATIONSHIP REQUESTS //////////////////////////////////////////////////////////
		/*
			Get the contacts notification array if
			we don't already have it (yep, the previous
			function's output may be used :)
		*/
		if (!isset($relationshipArray)) $relationshipArray = unpk(me("relationship_requests"));
		
		if (is_array($relationshipArray)) {
			
			$i=0;
			foreach ($relationshipArray as $requestEntity) {
				$contactsRequestReplacementArray[$i]["notification.mainpicture"] = _fnc("user", $requestEntity, "mainpicture");
				$contactsRequestReplacementArray[$i]["notification.username"] = _fnc("user", $requestEntity, "username");
				$contactsRequestReplacementArray[$i]["notification.id"] = $requestEntity;
				$contactsRequestReplacementArray[$i]["notification.age"] = _fnc("user", $requestEntity, "age");
				$contactsRequestReplacementArray[$i]["notification.header"] = _fnc("strtrim", _fnc("user", $requestEntity, "header"), 50);
				$contactsRequestReplacementArray[$i]["notification.gender"] = _fnc("user", $requestEntity, "gender");
				$i++;
			}
		}
		
		if (isset($contactsRequestReplacementArray)) {
			$tpl -> Loop("contactRequests", $contactsRequestReplacementArray);
			$tpl -> Zone("contactRequestsBlock", "enabled");
		}
		
	} // FI Guest OR chromeless //
	
	// CHROMELESS ENTITY RETURN ///////////////////////////////////////////////////////////
	elseif (isset($_SESSION["id"]) && $GLOBALS["CHROMELESS_MODE"]) {
		/*
			This is the chromeless mode, we only want to get one user data
			and return that part as the whole page. First, get the contacts
			array and make sure the user ID is in it (hack prevention)
		*/
		$myContacts = unpk(me("contacts"));
		if (!is_array($myContacts)) $myContacts = array();
		
		// HANDLE MOVE REQUEST ///////////////////////////////////////////////////////////
		if (isset($_GET["move"])) {
		
			foreach($myContacts as $groupName => $groupArray) {
				foreach($groupArray as $userKey => $userID) {
					if ($userID == $_GET["id"]) {
						unset($myContacts[$groupName][$userKey]);
					}
				}
			}
			$myContacts[$_GET["move"]][] = $_GET["id"];
			myQ("UPDATE `[x]users` SET `contacts`='".pk($myContacts)."' WHERE `id`='".me("id")."'");
			
			$tpl -> AssignArray(array("group.swapMessage" => $GLOBALS["OBJ"]["groupSwapMessageSaved"]));
		}
		
		else $tpl -> AssignArray(array("group.swapMessage" => NULL));
		
		

		foreach($myContacts as $groupName => $groupArray) {
			if (in_array($_GET["id"], $groupArray)) {
				$userGroupName = $groupName;
			}
			$groupsCollection[]["group.name"] = $groupName;
		}
		
		if (isset($userGroupName)) {
			
			/*
				FlushLoad the zone into the template buffer overriding
				the whole buffer
			*/			
			$tpl -> LoadThis($tpl -> Zone("contactEntityBlock", "enabled", true));
			
			/*
				Contact is in array, we will get the user's info
			*/
			$replaceArray = array(
				"user.username" => _fnc("user", $_GET["id"], "username"),
				"user.id" => $_GET["id"],
				"user.mainpicture" => _fnc("user", $_GET["id"], "mainpicture"),
				"user.gender" => _fnc("user", $_GET["id"], "gender"),
				"user.age" => _fnc("user", $_GET["id"], "age"),
				"user.location" => _fnc("user", $_GET["id"], "city")." "._fnc("user", $_GET["id"], "state")." "._fnc("user", $_GET["id"], "country"),
				"user.header" => _fnc("user", $_GET["id"], "header"),
				"user.quote" => _fnc("user", $_GET["id"], "quote"),
				"user.group" => $userGroupName
			);

			/*
				Assign the replacement array
			*/
			if (isset($replaceArray)) $tpl -> AssignArray($replaceArray);
			
			/*
				Assign the groups collection looping array
			*/
			$tpl -> Loop("moveToList", $groupsCollection);
		}
	}
	
	// GUESTS /////////////////////////////////////////////////////////////////////////
	else {
		$tpl->Zone("contactsPage", "guest");
		_fnc("reload", 5, "?L");
	}

	// FLUSH THE TEMPLATE /////////////////////////////////////////////////////////////
	$tpl -> CleanZones();
	$tpl -> Flush();

?>