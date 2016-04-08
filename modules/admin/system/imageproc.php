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
	$tpl -> Load("imageproc");
	

	// Handle submit order ///////////////////////////////////////////////////////////
	if (isset($_POST["Submit"])) {
		$saveList = array(
			"IMAGE_ENABLE_PROCESSOR:GD",
			"IMAGE_PROCESSOR:GD2",
			"IMAGE_DEFAULT_DIRECTORY",
			"IMAGE_PROCESSOR_DEBUG_MODE",
			"IMAGE_FORCE_CONSTRAIN_PROPORTIONS",
			"IMAGE_PROCESS_MODE",
			"IMAGE_CONSTRAIN_PROPORTIONS_ASPECT_RATIO",
			"IMAGE_MAX_FILE_SIZE",
			"IMAGE_HEADER_STRING",
			"IMAGE_NOFILE_DEFAULT_FILE",
			"IMAGE_CACHE_PROCESSED",
			"IMAGE_CACHE_DISPLAY:USE_FORWARD",
			"IMAGE_USE_STAMP_TEXT",
			"IMAGE_STAMP_TEXT",
			"IMAGE_STAMP_TEXT_COLOR",
			"IMAGE_STAMP_TEXT_SIZE",
			"IMAGE_STAMP_TEXT_LOCATION_Y",
			"IMAGE_STAMP_TEXT_LOCATION_X",
			"IMAGE_STAMP_TEXT_PADDING_Y",
			"IMAGE_STAMP_TEXT_PADDING_X",
			"IMAGE_STAMP_TEXT_DROPHILIGHT",
			"IMAGE_STAMP_TEXT_DROPHILIGHT_DEPHASE",
			"IMAGE_STAMP_TEXT_DROPHILIGHT_COLOR",
			"IMAGE_QUALITY",
			"IMAGE_MAX_WIDTH",
			"IMAGE_THUMBNAILS_SIZE",
			"IMAGE_STAMP_MINWIDTH",
			"IMAGE_USE_WATERMARK",
			"IMAGE_WATERMARK_FILE",			
			"IMAGE_WATERMARK_PADDING",
			"IMAGE_WATERMARK_RESIZE_FACTOR",
			"IMAGE_WATERMARK_MINWIDTH",
			"IMAGE_WATERMARK_BLEND_VISIBILITY"
		);
		
		foreach ($saveList as $saveEntry) {
			if (isset($_POST[$saveEntry])) _fnc("saveConfig", $saveEntry, $_POST[$saveEntry]);
			else _fnc("saveConfig", $saveEntry, 0);
		}
		$tpl -> Zone("save", "success");
	}
	
	// Replace tags for their actual values //////////////////////////////////////////
	$replaceTagsFor = array(
		"IMAGE_DEFAULT_DIRECTORY",
		"IMAGE_CONSTRAIN_PROPORTIONS_ASPECT_RATIO",
		"IMAGE_MAX_FILE_SIZE",
		"IMAGE_HEADER_STRING",
		"IMAGE_NOFILE_DEFAULT_FILE",
		"IMAGE_STAMP_TEXT",
		"IMAGE_STAMP_TEXT_COLOR",
		"IMAGE_STAMP_TEXT_SIZE",
		"IMAGE_STAMP_TEXT_LOCATION_Y",
		"IMAGE_STAMP_TEXT_LOCATION_X",
		"IMAGE_STAMP_TEXT_PADDING_Y",
		"IMAGE_STAMP_TEXT_PADDING_X",
		"IMAGE_STAMP_TEXT_DROPHILIGHT_DEPHASE",
		"IMAGE_STAMP_TEXT_DROPHILIGHT_COLOR",
		"IMAGE_QUALITY",
		"IMAGE_MAX_WIDTH",
		"IMAGE_THUMBNAILS_SIZE",
		"IMAGE_STAMP_MINWIDTH",
		"IMAGE_WATERMARK_FILE",			
		"IMAGE_WATERMARK_PADDING",
		"IMAGE_WATERMARK_RESIZE_FACTOR",
		"IMAGE_WATERMARK_MINWIDTH",
		"IMAGE_WATERMARK_BLEND_VISIBILITY"
	);
	
	foreach ($replaceTagsFor as $confTag) $replaceArray["CONF.{$confTag}"] = $CONF[$confTag];
	$tpl -> AssignArray($replaceArray);
	
	// Checkmark checkmarkable boxes /////////////////////////////////////////////////
	$checkMarkFor = array(
		"IMAGE_ENABLE_PROCESSOR:GD",
		"IMAGE_PROCESSOR:GD2",
		"IMAGE_PROCESSOR_DEBUG_MODE",
		"IMAGE_FORCE_CONSTRAIN_PROPORTIONS",
		"IMAGE_USE_WATERMARK",
		"IMAGE_CACHE_PROCESSED",
		"IMAGE_CACHE_DISPLAY:USE_FORWARD",
		"IMAGE_USE_STAMP_TEXT",
		"IMAGE_STAMP_TEXT_DROPHILIGHT"
	);
	
	foreach ($checkMarkFor as $ckMarkEntity) {
		$ckMarkArray["ck.{$ckMarkEntity}"] = (ckBool($CONF[$ckMarkEntity]) ? "checked=\"checked\"" : NULL);
	}
	$tpl -> AssignArray($ckMarkArray);	
	
	// Select dropdown items /////////////////////////////////////////////////////////
	$tpl -> FieldSelect("IMAGE_PROCESS_MODE", $CONF["IMAGE_PROCESS_MODE"]);

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