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
	$tpl -> Load("confirm");

	if (isset($_GET["id"], $_GET["code"]) && $_GET["id"] != "" && $_GET["code"] != "") {
		
		/* Got a code and an id. Let's see if the code match. */
		$u = myF(myQ("SELECT `id`,`username`,`password`,`email` FROM `[x]users` WHERE `id`='{$_GET["id"]}'"));
		if (is_array($u)) {
			
			/* Got a user -- Lets match the code */
			if (md5($u["email"].$u["username"].$u["password"]) == $_GET["code"]) {
				
				myQ("
					UPDATE `[x]users` 
					SET 
						`email_verified`='1', 
						`last_login`='".date("U")."',
						`active`='".($CONF["REGISTRATION_AUTO_APPROVE"] && $CONF["REGISTRATION_APPROVE_UPON_EMAIL_CHECK"]?"1":"0")."'						
					WHERE `id`='{$_GET["id"]}'"
				);
				
				$_SESSION["id"] = $u["id"];
				$tpl -> Zone("verify", "success");
				_fnc("reload", 3, $CONF["LOGIN_FIRST_ROUTE_TO"]);
				
			} else {
				$tpl -> Zone("verify", "failure");
			}
		} else {
			$tpl -> Zone("verify", "failure");
		}
	} else { 
		$tpl -> Zone("verify", "failure");
	}


	$tpl -> Flush();