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
	$tpl -> Load("ban");
	$tpl -> GetObjects();
	
	// LOAD THE BAN ARRAY //////////////////////////////////////////////
	$banArray = unpk(file_get_contents($CONF["BAN_INFOFILE"]));
	if (!is_array($banArray)) $banArray = array();
	
	// HANDLE POSTED BAN ///////////////////////////////////////////////
	if (isset($_POST["Submit"])) {
		
		if (($timestamp = strtotime($_POST["expire"])) === -1) {
			$tpl -> Zone("createBan", "errorTimeStamp");
		} 
		
		else {
			
			$banArray[] = array(
				"EXPIRE" => date("U", $timestamp),
				"BY" => me("username"),
				"FROM" => ip2long($_POST["ipstart"]),
				"TO" => ip2long((isset($_POST["ipend"])&&$_POST["ipend"]!=""?$_POST["ipend"]:$_POST["ipstart"])),
				"USERNAME" => NULL,
				"BODY" => $_POST["note"]
			);
			
			/* Save the ban array */
			if ($handle = fopen($CONF["BAN_INFOFILE"], "w")) {
				fwrite($handle, pk($banArray));
				fclose($handle);
				
				$tpl -> Zone("createBan", "success");
			}
		}
	}
				
	
	// HANDLE MULTI ////////////////////////////////////////////////////
	if (isset($_GET["action"], $_GET["ck"]) && $_GET["action"] != "" && is_array($_GET["ck"])) {
		
		switch($_GET["action"]) {
			
			case("delete"):
				foreach($_GET["ck"] as $removeKey) unset($banArray[$removeKey]);
			break;
			
			case("extend_1h"):
				foreach($_GET["ck"] as $extendKey) $banArray[$extendKey]["EXPIRE"] += 3600;
			break;
			
			case("extend_1d"):
				foreach($_GET["ck"] as $extendKey) $banArray[$extendKey]["EXPIRE"] += 86400;
			break;
			
			case("extend_1w"):
				foreach($_GET["ck"] as $extendKey) $banArray[$extendKey]["EXPIRE"] += 604800;
			break;
			
			case("extend_1m"):
				foreach($_GET["ck"] as $extendKey) $banArray[$extendKey]["EXPIRE"] += 2592000;
			break;
		}

		/* Save the ban array */
		if ($handle = fopen($CONF["BAN_INFOFILE"], "w")) {
			fwrite($handle, pk($banArray));
			fclose($handle);
		}
	}	
			
	
	$banCount = 0;
	$activeCount = 0;
	// ASSIGN THE ARRAY ////////////////////////////////////////////////
	foreach($banArray as $entityKey => $banEntity) {
		
		$banReplaceArray[] = array(
			"ban.startip" => long2ip($banEntity["FROM"]),
			"ban.endip" => long2ip($banEntity["TO"]),
			"ban.username" => $banEntity["USERNAME"],
			"ban.from" => $banEntity["BY"],
			"ban.body" => strip_tags($banEntity["BODY"]),
			"ban.expire" => date($CONF["LOCALE_HEADER_DATE_TIME"], $banEntity["EXPIRE"]),
			"ban.active" => ($banEntity["EXPIRE"] > date("U")?1:0),
			"ban.id" => $entityKey
		);
		
		$banCount ++;
		if ($banEntity["EXPIRE"] > date("U")) $activeCount ++;
		
	}
	
	if (isset($banReplaceArray)) {
		$tpl -> Loop("banList", $banReplaceArray);
	}
	
	$tpl -> AssignArray(array(
		"banCount.total" => $banCount,
		"banCount.active" => $activeCount
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