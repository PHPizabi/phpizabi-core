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
	$tpl -> Load("upload");
	
	if (me("id") != "") {
		
		$tpl -> Zone("uploadPicture", "enabled");

		// HANDLE UPLOAD & SUBMIT /////////////////////////////////////////////////////
		/*
			Submit occured? Let's handle that!
		*/
		if (isset($_POST["Submit"])) {
			
			/* 
				We will check if we got a picture, attribute it a name, and
				save it to the temporary directory.
			*/
			if (
				is_uploaded_file($_FILES["file"]["tmp_name"])
				and preg_match('/\\.jpg$|\\.jpeg$|\\.gif$|\\.png$/i', basename($_FILES["file"]["name"]))
			) {
				
				if (strstr(basename($_FILES["file"]["name"]), ".")) {
					$fileChunks = explode(".", basename($_FILES["file"]["name"]));
					$fileExtention = strtolower($fileChunks[count($fileChunks)-1]);
				
					if (in_array($fileExtention, explode(",", $CONF["PICTURES_ALLOWED_EXTENTIONS"]))) {
				
						$filename = md5(uniqid(time(), 1)) . "." . $fileExtention;
						move_uploaded_file($_FILES["file"]["tmp_name"], "system/cache/temp/{$filename}");
				
						/*
							Generate the picture data array, this is
							the picture information data pack - it is 
							generated here as we may need it later ...
						*/
						$pictureDataArray = array(
							"NAME" => $_POST["title"],
							"DESCRIPTION" => $_POST["description"],
							"FILE" => $filename,
							"LIBRARY" => 
								(me("mainpicture")==""?NULL:
									(isset($_POST["grouptext"])&&$_POST["grouptext"]!=""?$_POST["grouptext"]:$_POST["grouplist"])
								),
							"PRIVATE" => (isset($_POST["private"])?true:false),
							"MAIN" => (me("mainpicture")==""?true:false),
							"DATE" => date("U"),
							"APPROVED" => $CONF["PICTURES_AUTO_APPROVE"],
							"ID" => str_replace(" ", "", uniqid(0))
						);
					
						rename("system/cache/temp/{$filename}", "system/cache/pictures/{$filename}");
						
						/* 
							Load the actual user's pictures array, and append the
							new picture data to it.						
						*/
						$myPictures = unpk(me("pictures"));
						if (!is_array($myPictures)) $myPictures = array();
						$myPictures[] = $pictureDataArray;
						
						/*
							Save that to the database
						*/					
						myQ("UPDATE `[x]users` SET `pictures`='".pk($myPictures)."' WHERE `id`='".me('id')."'");
						
						/* 
							Update the main picture entry if needed 
						*/
						if (me("mainpicture") == "") myQ("
							UPDATE `[x]users` 
							SET `mainpicture`='{$filename}' 
							WHERE `id`='".me('id')."'"
						);
						
						$tpl->Zone("uploadHeader", "success");
					} 
					
					/*
						File extension is not contained in allowed list
					*/
					else $tpl->Zone("uploadHeader", "unallowedExtension");
				
				}	

				
				/*
					File extension is not contained in allowed list
				*/
				else $tpl->Zone("uploadHeader", "unallowedExtension");
			}
			
			/*
				Form was submitted with no file?! Nice idea for 
				an upload page... Show error
			*/
			else $tpl->Zone("uploadHeader", "noFile");
			
		}
		
		/*
			Form was not submitted
		*/
		else $tpl->Zone("uploadHeader", "enabled");

		// LOAD GROUPS ////////////////////////////////////////////////////////////////
		/*
			We check if we already loaded the pictures array (this
			is possible as the post method may have loaded it earlier.
			If it is already there, we won't act. If it's not, we will
			load it
		*/
		if (!isset($myPictures)) $myPictures = unpk(me("pictures"));
		
		$picturesGroups = array();		
		
		/*
			If the pictures array is .. an array (!), we will loop
			against it to form a grouped "library groups" list. Doing
			so that way prevents ending up with cloned groups
		*/
		if (is_array($myPictures)) foreach($myPictures as $pictureArray) {
			
			/*
				If the library group is not empty and its not in 
				the groups array yet, add it!
			*/
			if ($pictureArray["LIBRARY"] != "" && !in_array($pictureArray["LIBRARY"], $picturesGroups)) {
				$picturesGroups[] = $pictureArray["LIBRARY"];
			}
		}
		
		/*
			If the library groups exists, we will loop in it
			and create the final replacement array
		*/
		$i=0;
		if (isset($picturesGroups)) foreach ($picturesGroups as $groupName) {
			$groupsReplacementArray[$i]["group.name"] = $groupName;
			$i++;
		}
		
		/*
			... and finally, if the replacement array
			exists, we assign it to the template
		*/
		if (isset($groupsReplacementArray)) {
			$tpl->Zone("groupsDropdownField", "enabled");
			$tpl->Loop("groupsDropdownOptions", $groupsReplacementArray);
		}
		
		// END //
	
	}
	
	else $tpl -> Zone("uploadPicture", "guest");
	
	$tpl -> CleanZones();
	$tpl -> Flush();

?>