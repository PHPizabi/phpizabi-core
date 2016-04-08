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
	/* Administrative restriction */
	(!me('is_administrator')&&!me('is_superadministrator')?die("Access restricted"):NULL);

	
	

	$fArr = unpk(file_get_contents("system/cache/forums.dat"));
	
	if (is_array($fArr)) {		
		/* Sort the groups into an array */
		$i=0;
		foreach($fArr as $key => $arr) {
			$group[$fArr[$key]["GROUPSORTORDER"]] = $fArr[$key]["GROUP"];
			$forum[$fArr[$key]["GROUPSORTORDER"]][$i] = $fArr[$key]["FORUM"];
		}
		print_r($group);
		print_r($forum);
	}


	
/*
	$forum[0]["ID"] = uniqid;
	$forum[0]["GROUP"] = forumgroup;
	$forum[0]["GROUPSORTORDER"] = int;
	$forum[0]["FORUM"] = "xxxx...";
	$forum[0]["DESCRIPTION"]  = "xxx....";
	$forum[0]["LOCKED"] = true/false;
	$forum[0]["TOPICS"] = array of topics!
	$forum[0]["SORTORDER"] = int;
	$forum[0]["PRIVATEREAD"] = false;
	$forum[0]["PRIVATEPOST"] = false;
	$forum[0]["READALLOW"] = 1,2,3,4
	$forum[0]["POSTALLOW"] = 1,2,3,4
		
	
	topics:
	
	$forum[0]["TOPICS"] = array ::::
		
		[0]["ID"] = (forumID+).uniqid;
		[0]["ANNOUNCEMENT"] = true/false;
		[0]["STICKY"] = true/false;
		[0]["LOCKED"] = true/false;

	;;;;

	GROUPS > FORUMS > THREADS > POSTS
	
*/
?>