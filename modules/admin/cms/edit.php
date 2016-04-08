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
	
	$_GET["id"] = preg_replace('/[^0-9A-Za-z\\-\\_]/', '_', $_GET["id"]);
	@touch("modules/cms/{$_GET["id"]}.php");
	
	
	if (isset($_POST["Submit"])) {
		if ($handle = fopen("modules/cms/{$_GET["id"]}.php", "w")) {
			
			$body = 
				"<?php if (!defined(\"CORE_STRAP\")) die(); ?>\n"
				.preg_replace('#(<\\?.*\\?>)|(<%.*%>)|<\\?php|<\\?|\\?>|<%|%>#si', NULL, stripslashes($_POST["body"][0]))
				."\n<!-- Edited by ".me("username")." on ".date($CONF["LOCALE_HEADER_DATE_TIME"])." -->";
			;
			
			fwrite($handle, $body);
			fclose($handle);
			_fnc("reload", 0, "?L=admin.cms.cms");
		}
	}

	$tpl -> AssignArray(array(
		"cms.pageContent" => str_replace(
			"<?php if (!defined(\"CORE_STRAP\")) die(); ?>\n", 
			NULL, 
			@file_get_contents("modules/cms/{$_GET["id"]}.php")
		),
		"cms.pageName" => $_GET["id"],
		"cms.url" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF'])."?L=cms.{$_GET["id"]}"
	));
	
	if (!is_writable("modules/cms/{$_GET["id"]}.php")) {
		$tpl -> Zone("error", "writeLock");
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