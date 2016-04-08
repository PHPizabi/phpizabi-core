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
	$tpl -> Load("edit");
	$tpl -> GetObjects();
	
	
	// GET USERS TYPES ///////////////////////////////////////////////////////////////
	$usersTypes = array("G" => "Guests", "U" => "Users");
	
	$heritage = unpk(file_get_contents($CONF["HERITAGE_INFOFILE"]));
	if (!is_array($heritage)) $heritage = array();

	foreach ($heritage as $heritageKey => $heritageArray) {
		$usersTypes[$heritageKey] = $heritageArray["NAME"];
	}
	
	/* Make sure the called ID exists in the types array */
	if (in_array($_GET["id"], array_keys($usersTypes))) {

		/*
			Load the access control array
		*/
		if (!is_array($accessControl = unpk(file_get_contents("system/cache/access.dat")))) $accessControl = array();
		
	
		// HANDLE THE REQUEST TO ADD A RULE ////////////////////////////////////////////
		if (isset($_POST["Submit"], $_POST["allow"], $_POST["page"], $_POST["bycount"])) {
			
			$accessControl[$_GET["id"]][$_POST["page"]] = array(
				"ALLOW" => ($_POST["allow"] == 1 ? true : false),
				"BYCOUNT" => ($_POST["bycount"] == 0 || !is_numeric($_POST["bycount"]) ? 0 : $_POST["bycount"])
			);
		
			/*
				Save it!
			*/
			if ($handle = fopen("system/cache/access.dat", "w")) {
				fwrite($handle, pk($accessControl));
				fclose($handle);
				$tpl -> Zone("updateSuccess", "enabled");
			}
		}
		
		
		// HANDLE THE MULTIREQUEST //////////////////////////////////////////////////////
		if (isset($_POST["Act"], $_POST["action"]) && $_POST["action"] != "") {
			
			switch ($_POST["action"]) {
				
				case("allow"):
					foreach($_POST["ck"] as $ckPage) $accessControl[$_GET["id"]][$ckPage]["ALLOW"] = true;
				break;
				
				case("deny"):
					foreach($_POST["ck"] as $ckPage) $accessControl[$_GET["id"]][$ckPage]["ALLOW"] = false;
				break;
				
				case("unlimited"):
					foreach($_POST["ck"] as $ckPage) $accessControl[$_GET["id"]][$ckPage]["BYCOUNT"] = 0;
				break;
				
				case("delete"):
					foreach($_POST["ck"] as $ckPage) unset($accessControl[$_GET["id"]][$ckPage]);
				break;
				
			}

			/*
				Save it!
			*/
			if ($handle = fopen("system/cache/access.dat", "w")) {
				fwrite($handle, pk($accessControl));
				fclose($handle);
				$tpl -> Zone("updateSuccess", "enabled");
			}
		}
		
		// HANDLE THE DELETE REQUEST ////////////////////////////////////////////////////
		if (isset($_GET["rm"]) && isset($accessControl[$_GET["id"]][$_GET["rm"]])) {
			
			unset($accessControl[$_GET["id"]][$_GET["rm"]]);
			/*
				Save it!
			*/
			if ($handle = fopen("system/cache/access.dat", "w")) {
				fwrite($handle, pk($accessControl));
				fclose($handle);
				$tpl -> Zone("updateSuccess", "enabled");
			}
		}
			
	
		$tpl -> AssignArray(array(
			"type.id" => $_GET["id"],
			"type.name" => $usersTypes[$_GET["id"]]
		));
		

		// BUILD THE ACCESS CONTROL RULES REPLACEMENT ARRAY //////////////////////////
		$controlledPages = array();
		
		if (isset($accessControl[$_GET["id"]])) foreach ($accessControl[$_GET["id"]] as $controlPage => $controlArray) {
			$controlReplacementArray[] = array(
				"rule.page" => $controlPage,
				"rule.allow" => ($controlArray["ALLOW"] ? 1 : 0),
				"rule.deny" => ($controlArray["ALLOW"] ? 0 : 1),
				"rule.bycount" => ($controlArray["ALLOW"]?($controlArray["BYCOUNT"] == 0 ? $GLOBALS["OBJ"]["unlimited"] : $controlArray["BYCOUNT"]):NULL),
			);
			
			/* 
				Keep track of pages that are bound to a rule
				so we don't display them again in the "add a rule"
				pages list
			*/
			$controlledPages[] = $controlPage;
		}
		
		if (isset($controlReplacementArray)) {
			$tpl -> Loop("rulesList", $controlReplacementArray);
		}

		// BUILD THE PAGES DROPDOWN CONTENT //////////////////////////////////////////
		$trimPageNames = array(
			"modules/" => NULL,
			"/" => ".",
			".php" => NULL
		);

		foreach ($pagesList = readTree("modules") as $page) {
			
			$page = strtr($page, $trimPageNames);
			
			if (!in_array($page, $controlledPages)) {
				$pagesDropDownReplaceArray[] = array(
					"page.name" => $page
				);
			}
		}
		if (isset($pagesDropDownReplaceArray)) $tpl -> Loop("pagesDropDown", $pagesDropDownReplaceArray);

	}	

	// The readtree function ////////////////////////////////////////////////
	function readTree($dir) {
		if (is_dir($dir) && $handle  = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					if (is_dir($dir."/".$file)) {
						$tree = array_merge((isset($tree)?$tree:array()), readTree($dir."/".$file));
					}
					else $tree[] =  $dir."/".$file;
				}
			}
			return $tree;
		}
	}
	
	
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