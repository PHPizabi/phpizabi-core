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
	$tpl -> Load("templates");
	
	// Override the system globale if required //
	if (!isset($_GET["theme"])) {
		$_GET["theme"] = $GLOBALS["THEME"];
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
	
	// GET A LIST OF ALL THE TEMPLATES FILES ////////////////////////////////////
	$totalTemplates = 0;
	
	if (is_array($templatesTree = readTree("theme/{$_GET["theme"]}/templates"))) {
		foreach ($templatesTree as $treeNode) {
	
			$templateReplacementArray[] = array(
				"template.file" => $treeNode,
				"template.size" => round(filesize("{$treeNode}") / 1024, 2)
			);
			$totalTemplates ++;
		}

		$tpl -> Loop("templateList", $templateReplacementArray);
	}
	$tpl -> AssignArray(array(
		"templatesCount.total" => $totalTemplates,
		"themeName" => $_GET["theme"]
	));
	
	// GET A LIST OF ALL THE THEMES PACKAGES ////////////////////////////////////
	if ($handle  = opendir("theme/")) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && !is_dir($file) && $file != "templates") {
				$themeList[] = array("theme.name" => $file);
			}
		}
	}
	$tpl -> Loop("themeList", $themeList);

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