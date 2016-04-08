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
	
	

	$tpl = new template;
	$tpl -> Load("add");
	
	/* Handle post */
	if (isset($_POST["Submit"])) {
		
		/* Handle the uploaded file if there was any */
		if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
			$filename = basename($_FILES["file"]["name"]);
			move_uploaded_file($_FILES["file"]["tmp_name"], "system/cache/images/nudges/{$filename}");
		}
		
		/* Load title and body for all the languages */
		foreach ($_POST as $var => $val) {
			if (strstr($var, "_")) {
				$var = explode("_", $var);
				if ($var[0] == "title") $title[$var[1]] = $val;
				if ($var[0] == "body") $body[$var[1]] = $val;
			}
		}
		
		/* Load the actual nudges database */
		$nArr = unpk(file_get_contents("system/cache/nudges.dat"));
		if (!is_array($nArr)) $nArr = array();
		
		end($nArr);
		$key = key($nArr)+1;
		
		$nArr[$key]["title"] = $title;
		$nArr[$key]["body"] = $body;
		$nArr[$key]["icon"] = (isset($filename)?$filename:NULL);
		
		$handle = fopen("system/cache/nudges.dat", "w");
		fwrite($handle, pk($nArr));
		fclose($handle);
		
	}
	
	
	$i=0;
	foreach(explode(",", $CONF["LOCALE_SITE_LANGUAGES"]) as $lang) {
		$langLoop[$i]["lang"] = $lang;
		$i++;
	}
	$tpl -> Loop("title", $langLoop);
	$tpl -> Loop("body", $langLoop);


	$tpl -> Flush();
	
?>