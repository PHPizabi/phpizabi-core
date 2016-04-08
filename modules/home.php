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

	$tpl = new template;
	$tpl -> Load("!theme/{$GLOBALS["THEME"]}/templates/home.tpl");
	$tpl -> GetObjects();


	if (isset($GLOBALS["LOGIN_FAIL_TYPE"])) {
		if ($GLOBALS["LOGIN_FAIL_TYPE"] == "e.password") $loginError = $GLOBALS["OBJ"]["loginError.password"];
		elseif ($GLOBALS["LOGIN_FAIL_TYPE"] == "e.user") $loginError = $GLOBALS["OBJ"]["loginError.username"];
		elseif ($GLOBALS["LOGIN_FAIL_TYPE"] == "e.bruteforce") $loginError = $GLOBALS["OBJ"]["loginError.bruteforce"];
		elseif ($GLOBALS["LOGIN_FAIL_TYPE"] == "e.active") $loginError = $GLOBALS["OBJ"]["loginError.active"];
	}
	
	$tpl -> AssignArray(array(
		"login.failMessage" => (isset($loginError)?$loginError:NULL)
	));
	
	$tpl -> Flush();

?>