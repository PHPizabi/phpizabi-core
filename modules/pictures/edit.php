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
	$tpl -> GetObjects();
	
	
	/* 
		Load the user's pictures array
	*/
	$myPictures = unpk(me("pictures"));
	if (!is_array($myPictures)) $myPictures = array();
	
	/*
		Prepare some cyclic variables
	*/
	$i=0;
	$librariesLoopArray = array();
	
	/*
		Loop in the pictures array
	*/
	foreach ($myPictures as $pictureKey => $pictureArray) {
		
		/*
			Generate an array of all the libraries the
			user has... We will use that to populate the "move to"
			drop down field
		*/	
		if ($pictureArray["LIBRARY"] != "" && !_fnc("in_multiarray", $librariesLoopArray, $pictureArray["LIBRARY"])) {
			$librariesLoopArray[$i]["library.item"] = $pictureArray["LIBRARY"];
		}
		
		/*
			Now we want to find and load the picture we
			need to edit, this will compare IDs and set
			an array that is the actual picture array
			content.
		*/
		if ($pictureArray["ID"] == $_GET["id"]) $editKey = $pictureKey;

		$i++;
	}

	/*
		Assign the dropdown menu its library items
		array ...
	*/
	if (isset($librariesLoopArray)) $tpl -> Loop("libraryItems", $librariesLoopArray);
	
	// HANDLE POST ////////////////////////////////////////////////////////////////////////////////
	if (isset($_POST["Submit"])) {
		
		$myPictures[$editKey]["NAME"] = $_POST["title"];
		$myPictures[$editKey]["DESCRIPTION"] = $_POST["description"];
		$myPictures[$editKey]["PRIVATE"] = (isset($_POST["private"])?true:false);
		
		if (isset($_POST["newLibrary"]) && $_POST["newLibrary"] != "") {
			$myPictures[$editKey]["LIBRARY"] = $_POST["newLibrary"];
		} 
		
		elseif (isset($_POST["move"]) && $_POST["move"] != "") {
			$myPictures[$editKey]["LIBRARY"] = ($_POST["move"]!="SYSTEM_ROOT"?$_POST["move"]:NULL);
		}
		
		myQ("UPDATE `[x]users` SET `pictures`='".pk($myPictures)."' WHERE `id`='".me("id")."'");
		_fnc("reload", 0, "?L=pictures.pictures");
	}
	
	/*
		Build the picture edition fields replacement
		array
	*/
	if (isset($editKey)) {
		
		$pictureReplacementArray["picture.file"] = $myPictures[$editKey]["FILE"];
		$pictureReplacementArray["picture.title"] = $myPictures[$editKey]["NAME"];
		$pictureReplacementArray["picture.description"] = $myPictures[$editKey]["DESCRIPTION"];
		$pictureReplacementArray["picture.library"] = ($myPictures[$editKey]["LIBRARY"]!=""?$myPictures[$editKey]["LIBRARY"]:$GLOBALS["OBJ"]["mainLibrary"]);
		$pictureReplacementArray["picture.private"] = ($myPictures[$editKey]["PRIVATE"]?"checked":NULL);
		
		if (!$myPictures[$editKey]["MAIN"]) $tpl -> Zone("makePrivate", "enabled");
		
		$tpl -> AssignArray($pictureReplacementArray);

	}	

	/*
		Flush the template
	*/
	$tpl -> CleanZones();
	$tpl -> Flush();
	
?>