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
	$tpl -> Load("crop");

	/*
		Make sure we got a file name passed in the URL, make sure
		the file exists ...
	*/
	if (isset($_GET["f"]) && is_file("system/cache/temp/{$_GET["f"]}")) {
		
		// PREPROCESS RESIZE ///////////////////////////////////////////////////////////
		list($imageWidth, $imageHeight, $imageType, $imageAttributes) = getimagesize("system/cache/temp/{$_GET["f"]}");
		/*
			make sure the picture is not too big for the interface
		*/
		if ($imageWidth > 400 || $imageHeight > 400) {

			switch($imageType) {
				case(2):
				$handle = imagecreatefromjpeg("system/cache/temp/{$_GET["f"]}");	
				break;
		
				case(1):
					$handle = imagecreatefromgif("system/cache/temp/{$_GET["f"]}");
				break;
		
				case(3):
					$handle = imagecreatefrompng("system/cache/temp/{$_GET["f"]}");
				break;
			}

			/*
				Image is too big ... resize it
			*/
			$sizeRatio = $imageWidth / $imageHeight;
			if ($sizeRatio > 1) {
				$processWidth = 400;
				$processHeight = 400 / $sizeRatio;
			} else {
				$processHeight = 400;
				$processWidth = 400 * $sizeRatio;
			}

			/*
				Create a new handler by the size of the new thumbnail
				image we want to create
			*/
			if ($CONF["IMAGE_PROCESSOR:GD2"]) $thumb = imagecreatetruecolor($processWidth, $processHeight);
			else $thumb = imagecreate($processWidth, $processHeight);

			/*
				... and dump the resized handle into
				the new handler.
			*/
			imagecopyresampled($thumb, $handle, 0, 0, 0, 0, $processWidth, $processHeight, $imageWidth, $imageHeight);
			
			imagejpeg($thumb, "system/cache/temp/{$_GET["f"]}", 100);

		}
	}
	
	// REPROCESS POST HANDLE ///////////////////////////////////////////////////////
	if (
		isset($_POST["Submit"]) && 
		isset($_POST["width"]) && 
		$_POST["width"] > 0 && 
		isset($_POST["height"]) && 
		$_POST["height"] > 0
	) {

		/*
			Make sure we're not fooled... proportions are still ok?
		*/
		if (round($_POST["height"] / 0.75) == $_POST["width"]) {
	
			/*
				Get the picture size, create a handle to play with the image
			*/
			list($imageWidth, $imageHeight, $imageType, $imageAttributes) = getimagesize("system/cache/temp/{$_GET["f"]}");
	
			switch($imageType) {
				case(2):
				$handle = imagecreatefromjpeg("system/cache/temp/{$_GET["f"]}");	
				break;
		
				case(1):
					$handle = imagecreatefromgif("system/cache/temp/{$_GET["f"]}");
				break;
		
				case(3):
					$handle = imagecreatefrompng("system/cache/temp/{$_GET["f"]}");
				break;
			}
	
			/*
				Create a new image handler
			*/
			if ($CONF["IMAGE_PROCESSOR:GD2"]) $thumb = imagecreatetruecolor($_POST["width"], $_POST["height"]);
			else $thumb = imagecreate($_POST["width"], $_POST["height"]);
			
			imagecopyresampled(
				$thumb, 
				$handle, 
				0, 
				0, 
				$_POST["x"], 
				$_POST["y"], 
				$_POST["width"], 
				$_POST["height"], 
				$_POST["width"], 
				$_POST["height"]
			);
			
			imagejpeg($thumb, "system/cache/pictures/{$_GET["f"]}.jpg", 100);
			
			/* Add to and save the array */
			$picArr = unpk(me("pictures"));
			if (!is_array($picArr)) $picArr = array();
			
			$pictureData = unpk($_SESSION["PICTURE_UPLOAD_DATA"]);
			$pictureData["FILE"] = $_GET["f"].".jpg";
			
			$picArr[] = $pictureData;
			
			myQ("UPDATE `[x]users` SET `pictures`='".pk($picArr)."' WHERE `id`='".me('id')."'");
				
			/* Update the main picture entry if needed */
			if (me("mainpicture") == "") {
				myQ("UPDATE `[x]users` SET `mainpicture`='{$_GET["f"]}.jpg' WHERE `id`='".me('id')."'");
			}
			
			_fnc("reload", 3, "?L=pictures.upload");
			$tpl -> Zone("cropBlock", "success");
		}
	}
	
	else $tpl -> Zone("cropBlock", "enabled");
	

	$tpl -> AssignArray(array("image.fileName" => $_GET["f"]));
	
	$tpl -> Flush();
	
?>