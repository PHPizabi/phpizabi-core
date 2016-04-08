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
	$tpl -> Load("molo");
	$tpl -> GetObjects();

	/*
		Browse the directory structure, find all the molo.txt files
	*/
	function readTree($dir) {
		if (is_dir($dir) && $handle  = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					if (is_dir($dir."/".$file)) {
						$tree = array_merge((isset($tree)?$tree:array()), readTree($dir."/".$file));
					}
					else if ($file == "molo.txt") $tree[] =  $dir."/".$file;
				}
			}
			return (isset($tree)?$tree:array());
		}
	}
	
	$moloList = array_merge(
		(is_array($arModules = readTree("modules")) ? $arModules : array()), 
		(is_array($arThemes = readTree("themes")) ? $arThemes : array())
	);

	/*
		Load the installed packages array
	*/
	if (!is_array($iMoLoArray = unpk(file_get_contents("system/cache/molo.dat")))) $iMoLoArray = array();

	/*
		Now that we got a MoLoList (!), we will parse all the MoLoData and display information.
	*/
	$i=0;
	
	if (count($moloList > 0)) foreach ($moloList as $moloFile) {
		
		/*
			Get the MoLo object <info ...> data
		*/
		if (preg_match('/<info ([A-Z0-9+&@#\/%=~_|!:,.;\/ "]*)>/si',  file_get_contents($moloFile), $moloMatch)) {
			
			/*
				The molo "info" is now stored in $mooloMatch[1]... we will now get 
				each individual element of it and split that into another array
			*/
			preg_match_all('/([A-Z0-9]*) ?= ?"(.*?)"/si', $moloMatch[1], $moloInfo, PREG_SET_ORDER);
			
			foreach ($moloInfo as $key => $moloArray) {

				switch($moloInfo[$key][1]) {
					case("name"):		$molo[$i]["molo.name"] =		$moloInfo[$key][2]; break;
					case("version"):	$molo[$i]["molo.version"] =		$moloInfo[$key][2]; break;
					case("author"):		$molo[$i]["molo.author"] =		$moloInfo[$key][2]; break;
					case("support"):	$molo[$i]["molo.support"] =		$moloInfo[$key][2]; break;
					case("url"):		$molo[$i]["molo.url"] = 		$moloInfo[$key][2]; break;
					case("body"):		$molo[$i]["molo.body"] =		$moloInfo[$key][2]; break;
				}
			}
			$molo[$i]["molo.id"] = md5($molo[$i]["molo.name"].$molo[$i]["molo.version"]);
			$molo[$i]["molo.file"] = $moloFile;
			
			/*
				Is this module installed?
			*/
			if (_fnc("in_multiarray", $iMoLoArray, md5($molo[$i]["molo.name"].$molo[$i]["molo.version"]))) {
				$molo[$i]["molo.status"] = $GLOBALS["OBJ"]["installed"];
			} else $molo[$i]["molo.status"] = $GLOBALS["OBJ"]["not_installed"];
			
		}
		$i ++;
		$totalModules = $i;
	}

	$tpl -> Loop("moloList", (isset($molo) ? $molo : array()));
	$tpl -> AssignArray(array("moloCount.total" => $totalModules));

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