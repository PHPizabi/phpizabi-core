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
	$tpl -> Load("myself");
	$tpl -> GetObjects();
	
	
	if (me("id")) {
		
		$tpl -> Zone("main", "enabled");
		
		/* Load the questionaires list */
		$uDat = unpk(me("profile_data"));
		if ($handle = opendir("system/cache/questionnaires")) {
			$i=0;
			while (($file = readdir($handle)) !== false) {
				if ($file != "." && $file != "..") {
					$qName = base64_decode(str_replace(".dat", "", $file));
					$questionaires[$i]["questionaire"] = $qName;
					$questionaires[$i]["id"] = str_replace(".dat", "", $file);
					$questionaires[$i]["filled"] = (isset($uDat[$qName])?$GLOBALS["OBJ"]["filled"]:$GLOBALS["OBJ"]["unfilled"]);
					$i++;
				}
			}
			closedir($handle);
			$tpl -> Loop("questionaires", $questionaires);
	   }
	   
	   
		/* 
			Handle the submitted user data
		*/
		if (isset($_POST["submitUserData"])) {
			
			$previousZipcode = me("zipcode");
			
			myQ("
				UPDATE `[x]users` SET
					`quote`='{$_POST["quote"]}',
					`header`='".strip_tags($_POST["header"])."',
					`city`='{$_POST["city"]}',
					`state`='{$_POST["state"]}',
					`country`='{$_POST["country"]}',
					`zipcode`='{$_POST["zipcode"]}'
				WHERE `id`='".me("id")."'
			");
			
			me("flush");
			
			if ($previousZipcode != $_POST["zipcode"] && $CONF["GEOLOC_STRAPON_ZIPCHANGE"]) _fnc("geoLocalize", me("id"));
		}
		
		
		/*
			Handle a password change post.
		*/
		if (isset($_POST["changePassword"])) {
			
			/*
				Does the ACTUAL password matches the password
				we have in the database? (We want to prevent 
				"floating" (open sessions) users to change the
				password of another user with that function.
			*/
			if (md5($_POST["actualPassword"]) == me("password")) {
	
				/*
					Is the password len longer than the minimum
					allowed len?
				*/		
				if (strlen($_POST["newPassword"]) > $CONF["USERS_PASSWORD_MIN_LEN"]) {
					
					/*
						Is there any SPACE characters in the password?
					*/			
					if (!strpos($_POST["newPassword"], " ")) {
					
						/*
							Do both the password and password verification
							fields value the same?
						*/
						if ($_POST["newPassword"] == $_POST["confirmPassword"]) {
							
							/*
								Everything is confirmed. Let's update the password
								entry for that user
							*/
							myQ("UPDATE `[x]users` SET `password`='".md5($_POST["newPassword"])."' WHERE `id`='".me("id")."'");
	
							$tpl->Zone("passChangeMessage", "success");
	
						} else $tpl->Zone("passChangeMessage", "noMatch");
	
					} else $tpl->Zone("passChangeMessage", "badFormat");
	
				} else $tpl->Zone("passChangeMessage", "tooShort");
	
			} else $tpl->Zone("passChangeMessage", "wrongPass");
		}
		
		$tpl -> AssignArray(array(
			"me.quote" => me("quote"), 
			"me.header" => me("header")
		));
		
		$tpl -> ConvertSelf();
	
	}
	
	else {
		$tpl -> Zone("main", "guest");
		_fnc("reload", 3, "?L");
	}
		
	$tpl-> CleanZones();
	$tpl -> Flush();
	
?>