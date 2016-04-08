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

	$cubArr = array("{" => "&#123;", "}" => "&#125;");
	
	if (isset($_POST["Submit"])) {
	
		$body = "<?php\n\$GLOBALS[\"dictionary\"] = array(\n";
		foreach ($_POST["string"] as $var => $val) {
			$body .= chr(9)."{$var} => \"".stripslashes(strtr($val, array_flip($cubArr)))."\",\n";
		}
		$body .= ");\n?>";
		
		if ($handle = fopen($CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/".strtolower($_GET["id"]).".php", "w")) {
			fwrite($handle, $body);
			fclose($handle);
		}
	}
	//
	
	
	$map = explode("\n", file_get_contents($CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/map.txt"));
	$langContent = file_get_contents($CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/".strtolower($_GET["id"]).".php");
	
	foreach($map as $mapEntity) {
		
		if ($mapEntity != "" && substr_count($mapEntity, ":") >= 2) {
		
			list($id, $at, $string) = explode(":", $mapEntity, 3);
			
			preg_match('/'.$id.' ?=> ?"(.*)"/i', $langContent, $value);
			
			$mapReplace[] = array(
				"string.id" => $id,
				"string.location" => $at,
				"string.newlang" => $_GET["id"],
				"string.mapBody" => strtr($string, $cubArr),
				"string.langBody" => (isset($value[1])?strtr($value[1], $cubArr):NULL)
			);
		}
	}
	
	$tpl -> Loop("langEdit", $mapReplace);
	$tpl -> AssignArray(array("language" => $_GET["id"]));
	
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