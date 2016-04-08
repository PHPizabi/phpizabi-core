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
	$tpl -> Load("pictures");
	$tpl -> GetObjects();

	if (me('id')) {	
		
		// LOAD UP THE PICTURES ARRAY //////////////////////////////////////////////////////
		$myPictures = unpk(me("pictures"));
		if (!is_array($myPictures)) $myPictures = array();
		

		// HANDLE THE "MAKE MAIN" ORDER ////////////////////////////////////////////////////
		if (isset($_GET["main"])) {
		
			foreach($myPictures as $pictureKey => $pictureArray) {
				
				if ($pictureArray["MAIN"] && $pictureArray["ID"] != $_GET["main"]) $myPictures[$pictureKey]["MAIN"] = false;
				elseif ($pictureArray["ID"] == $_GET["main"]) {
					$myPictures[$pictureKey]["MAIN"] = true;
					$mainPictureFile = ($pictureArray["FILE"]!=""?$pictureArray["FILE"]:NULL);
				}
			
			}
			
			myQ("
				UPDATE `[x]users` 
				SET `pictures`='".pk($myPictures)."',
				`mainpicture`='{$mainPictureFile}' 
				WHERE `id`='".me("id")."'
			");
		}
		
		
		// HANDLE THE RM ORDER ////////////////////////////////////////////////////////////////
		if (isset($_GET["rm"])) {
			
			foreach($myPictures as $pictureKey => $pictureArray) {

				if ($pictureArray["ID"] == $_GET["rm"] && !$pictureArray["MAIN"]) {
					
					if (is_file("system/cache/pictures/{$pictureArray["FILE"]}")) {
						unlink("system/cache/pictures/{$pictureArray["FILE"]}");
					}
					
					unset($myPictures[$pictureKey]);
					
					myQ("
						UPDATE `[x]users` 
						SET `pictures`='".pk($myPictures)."'
						WHERE `id`='".me("id")."'
					");
					
					break;
				}
			}
		}
		
		
		/* Compute the user's pictures */
		$i=0;
		foreach ($myPictures as $pic) {
				
			$idRepArray = array("{picture.id}" => $pic["ID"]);
					
			$repPic[$i]["picture.file"] = $pic["FILE"];
			$repPic[$i]["picture.title"] = $pic["NAME"];
			$repPic[$i]["picture.description"] = $pic["DESCRIPTION"];
			$repPic[$i]["picture.library"] = $pic["LIBRARY"];
			$repPic[$i]["picture.id"] = $pic["ID"];
				
			$repPic[$i]["picture.mainPicture"] = ($pic["MAIN"]?strtr($GLOBALS["OBJ"]["mainPicture"], $idRepArray):NULL);
			$repPic[$i]["picture.privatePicture"] = ($pic["PRIVATE"]?strtr($GLOBALS["OBJ"]["privatePicture"], $idRepArray):NULL);
			$repPic[$i]["picture.removePicture"] = (!$pic["MAIN"]?strtr($GLOBALS["OBJ"]["removePicture"], $idRepArray):NULL);
				
			$i++;
	
		}
		
		if (isset($repPic)) {
			$tpl -> Zone("pictures", "enabled");
			$tpl -> Loop("piclist", $repPic);
			
		} 
		
		else $tpl -> Zone("pictures", "empty");
			

	}

	$tpl -> CleanZones();
	$tpl -> Flush();
	
	
?>