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
	
	
	
	/* Initialize template engine */
	$tpl = new template;
	$tpl -> Load("add");
	
	/* Get the languages array */
	$i=0;
	foreach(explode(",", $CONF["LOCALE_SITE_LANGUAGES"]) as $lang) {
		$langLoop[$i]["language"] = $lang;
		$i++;
	}
	$tpl -> Loop("language", $langLoop);
	

	/* Handle posted horoscope data */
	if (isset($_POST["Submit"])) {

		/* Load title and body for all the languages */
		foreach ($_POST as $var => $val) {
			if (strstr($var, "_")) {
				$var = explode("_", $var);
				if ($var[0] == "body") $body[$var[1]] = $val;
			}
		}
	
		$hArr = unpk(file_get_contents("system/cache/horoscopes.dat"));
		if (!is_array($hArr)) $hArr = array();
		
		end($hArr);
		$key = key($hArr)+1;
		
		$hArr[$key]["body"] = $body;
		
		if ($handle = fopen("system/cache/horoscopes.dat", "w")) {
			fwrite($handle, pk($hArr));
			fclose($handle);
		}
	}
	
	
	
	$tpl -> Flush();