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
	$tpl -> Load("languages");
	
	$sysLanguages = explode(",", $CONF["LOCALE_SITE_LANGUAGES"]);
	
	// HANDLE THE UNLINK REQUEST //////////////////////////////////////////
	if (isset($_GET["unlink"]) && in_array(strtolower($_GET["unlink"]), $sysLanguages)) {
		foreach ($sysLanguages as $key => $lang) {
			if ($lang == strtolower($_GET["unlink"])) {
				unset($sysLanguages[$key]);
				_fnc("saveConfig", "LOCALE_SITE_LANGUAGES", implode(",", $sysLanguages));
				break;
			}
		}
	}
	
	// HANDLE ACTIVATE ///////////////////////////////////////////////////
	if (isset($_GET["activate"]) && !in_array(strtolower($_GET["activate"]), $sysLanguages)) {
		$sysLanguages[] = strtolower($_GET["activate"]);
		_fnc("saveConfig", "LOCALE_SITE_LANGUAGES", implode(",", $sysLanguages));
	}
	
	// HANDLE SET DEFAULT ////////////////////////////////////////////////
	if (isset($_GET["default"]) && in_array(strtolower($_GET["default"]), $sysLanguages)) {
		$CONF["LOCALE_SITE_DEFAULT_LANGUAGE"] = strtolower($_GET["default"]);
		_fnc("saveConfig", "LOCALE_SITE_DEFAULT_LANGUAGE", strtolower($_GET["default"]));
	}
	
	// HANDLE POSTED LANGUAGE ////////////////////////////////////////////
	if (isset($_POST["Submit"], $_POST["name"])) {
	
		$_POST["name"] = strtolower($_POST["name"]);
		$_POST["clone"] = strtolower($_POST["clone"]);
	
		/* 
			Make sure a language by the same name does NOT
			already exist
		*/
		if (!is_file($CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/{$_POST["name"]}.php")) {
			
			/*
				Let's find out if we got a file
			*/
			if (is_uploaded_file($_FILES["file"]["tmp_name"]) && strstr(strtolower(basename($_FILES["file"]["name"])), ".php")) {
				move_uploaded_file($_FILES["file"]["tmp_name"], $CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/{$_POST["name"]}.php");
			}
			
			/*
				A clone?
			*/
			elseif (
				isset($_POST["clone"]) && 
				$_POST["clone"] != "" && 
				is_file("{$CONF["LOCALE_LANGUAGEPACK_LOCATION"]}/{$_POST["clone"]}.php")
			) {
				copy($CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/{$_POST["clone"]}.php", $CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/{$_POST["name"]}.php");
			}
			
			/*
				No file, no clone ... How bad. Let's create a blank
				file
			*/
			else touch($CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/{$_POST["name"]}.php");
		}
	}


	$totalLanguages = 0;
	$totalSupported = 0;

	if ($handle = opendir($CONF["LOCALE_LANGUAGEPACK_LOCATION"])) {
		while (false !== ($fileName = readdir($handle))) {

			$file = explode(".", $fileName, 2);
			if ($file[1] == "php") {
			
				$totalLanguages ++;
				if (in_array(strtolower($file[0]), $sysLanguages)) $totalSupported ++;
			
				$languages[] = array(
					"language.id" => ucfirst($file[0]),
					"language.supported" => (in_array(strtolower($file[0]), $sysLanguages) ? 1 : 0),
					"language.size" => round(filesize($CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/{$fileName}")/1024, 2),
					"language.default" => ($CONF["LOCALE_SITE_DEFAULT_LANGUAGE"] == $file[0] ? 1 : 0),
				);
				
				$langDropDown[] = array(
					"language.id" => ucfirst($file[0])
				);
			}
		}
	}
	
	if (isset($languages)) {
		
		$tpl -> Loop("languages", $languages);
		$tpl -> Loop("langDropDown", $langDropDown);
	}
	
	$tpl -> AssignArray(array(
		"langCount.total" => $totalLanguages,
		"langCount.active" => $totalSupported
	));
	
	// TEMPLATE REPROCESS & FLUSH ////////////////////////////////////////////////////
	$tpl -> CleanZones();

	/* Get the frame templates, flush the TPL result into it */
	$frame = new template;
	$frame -> Load("!theme/{$GLOBALS["THEME"]}/templates/admin/frame.tpl");
	$frame -> AssignArray(array(
		"jump" => $tpl->Flush(1)
	));
	
	/* Assign Location Value */
	$locationArray = explode(".", $_GET["L"]);
	for ($i=0; $i<count($locationArray); $i++) {
		$locationAppendResult[] = $locationArray[$i];
		if ($i > 0) $location[] = "<a href=\"?L=".implode(".", $locationAppendResult)."\">{$locationArray[$i]}</a>";
	}
	$frame -> AssignArray(array("location" => implode(" &raquo; ", $location)));
	
	/* Set the forced chromeless mode, flush the template */
	$GLOBALS["CHROMELESS_MODE"] = 1;
	$frame -> Flush();
	
?>