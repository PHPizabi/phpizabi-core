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
	function bufferProcParse($buffer) {
		global $CONF;
		
		$tpl = new template;
		$tpl -> LoadThis($buffer);
		
		// HANDLE POSTED NOTEPAD DATA ///////////////////////////////////////////////////////
		if (isset($_GET["notepad_body"])) {
			myQ("UPDATE `[x]users` SET `notepad_body` = '".urldecode($_GET["notepad_body"])."' WHERE `id`='".me("id")."'");
			me("flush");
		}

		// FOOTER ACTIONS (Notepad / Random users) //////////////////////////////////////////
		/*
			The template (the default one at least) has a block on
			the footer that shows some members. This query is set
			in the configuration file, we will query the database
			and get those members.
		*/
		if (!is_array($mySettings = unpk(me("settings")))) $mySettings = array();
		if (isset($mySettings["RANDOM_DISPLAY"]["GENDER"]) and $mySettings["RANDOM_DISPLAY"]["GENDER"] != "") {
			$genderQ = "AND `gender`='{$mySettings["RANDOM_DISPLAY"]["GENDER"]}' ";
		} else $genderQ = NULL;
		
		$footerSelect = myQ("
			SELECT `id`,`mainpicture`,`username` 
			FROM `[x]users` 
			WHERE `mainpicture` != ''
			AND `active` = '1'
			{$genderQ}
			ORDER BY RAND() 
			LIMIT 4
		");
		
		$i=0;
		while ($footerRow = myF($footerSelect)) {
			$footerRandomUsers[$i]["user.username"] = $footerRow["username"];
			$footerRandomUsers[$i]["user.id"] = $footerRow["id"];
			$footerRandomUsers[$i]["user.mainpicture"] = $footerRow["mainpicture"];
			$i++;
		}

		if (!isset($_GET["proc_footer_element"])) {
			if (isset($footerRandomUsers)) {
				$tpl->Zone("footer_element", "random_users");
				$tpl->Loop("footerQuery", $footerRandomUsers);
			}
			else $tpl -> Zone("footer_element", "empty");
		}
		
		elseif ($_GET["proc_footer_element"] == "random") {
			if (isset($footerRandomUsers)) {
				$tpl -> LoadThis($tpl -> Zone("footer_element", "random_users", true));
				$tpl->Loop("footerQuery", $footerRandomUsers);
			}
			else $tpl -> LoadThis($tpl -> Zone("footer_element", "empty", true));
		}
		
		elseif ($_GET["proc_footer_element"] == "notepad") {
			$tpl -> LoadThis($tpl -> Zone("footer_element", "notepad", true));
			if (me("id")) {
				$tpl -> Zone("notepad", "enabled");
				$tpl -> AssignArray(array("notepad_content" => me("notepad_body").$saved));
			}
			else $tpl -> Zone("notepad", "guest");
		}

		// LOGGED IN / GUESTS ZONES SWAPPING ////////////////////////////////////////////////
		/*
			There are some options we only want to show to the users,
			some others for the guests. The "login/logout" swap
			into the theme is one of those! This will convert the
			zoning.
		*/			
		if (isset($_SESSION["id"])) $tpl->Zone("userStatus", "user");
		else $tpl->Zone("userStatus", "guest");
					
		/*
			... and a swapping admin link!
		*/
		if (me("is_administrator") || me("is_superadministrator")) $tpl->Zone("adminLink", "enabled");
		else $tpl->Zone("adminLink", "disabled");

		// SYSTEM ORIGINS ///////////////////////////////////////////////////////////////////
		/*
			Set the system origin value and attribute it to the template
		*/
		$GLOBALS["SYSTEM_ORIGIN"] = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$tpl -> AssignArray(array("system.origin" => $GLOBALS["SYSTEM_ORIGIN"]));
		
		/*
			Set the "L" call path replacement
		*/
		$tpl -> AssignArray(array("system.l" => $GLOBALS["THIS_PATH"]));

		// CONVERT SELF-USER DATA ///////////////////////////////////////////////////////////
		$tpl->ConvertSelf();

		// HTTPS ROLLBACK ///////////////////////////////////////////////////////////////////
		/*
			Converts HTTPS links back to HTTP when using the HTTPS protocol
		*/
		if ($CONF["HTTPS_ROLLBACK"] && isset($_SERVER['HTTPS']) && !is_null($_SERVER['HTTPS'])) {
			$tpl -> LoadThis(str_replace("https://", "http://", $tpl -> Flush(1)));
		}

		// FLUSH & EOF //////////////////////////////////////////////////////////////////////
		return $tpl -> Flush(1);

	}
	
?>