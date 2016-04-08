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
	$tpl -> Load("intmail");
	

	// Handle submit order ///////////////////////////////////////////////////////////
	if (isset($_POST["Submit"])) {
		$saveList = array(
			"MAILS_INBOX_NAME",
			"MAILS_TRASHBOX_NAME",
			"MAILS_SENTBOX_NAME",
			"MAILS_AUTO_KEEP_SENT",
			"MAILS_SENT_SUBJECT_PREFIX",
			"MAILS_REPLY_SUBJECT_PREFIX",
			"MAILS_REPLY_QUOTE_SEPARATOR_PREFIX",
			"MAILS_REPLY_QUOTE_SEPARATOR_SUFFIX",
			"MAILS_FORWARD_SUBJECT_PREFIX",
			"MAILS_FORWARD_BODY_PREFIX",
			"MAILS_FORWARD_FROM_ORIGIN",
			"MAILS_FORWARD_BODY_SUFFIX",
			"MAILS_QUOTA_MAX_KILOBYTES",
			"MAILS_CUSTOM_MAILBOX_ALLOWED",
			"MAILS_CUSTOM_MAILBOX_NAME_MAX_LEN",
			"MAILS_CUSTOM_MAILBOX_MAX_BOXES",
			"MAILS_MAX_SUBJECT_LENGHT",
			"MAILS_MIN_REMAIL_DELAY"
		);
		
		foreach ($saveList as $saveEntry) {
			if (isset($_POST[$saveEntry])) _fnc("saveConfig", $saveEntry, $_POST[$saveEntry]);
			else _fnc("saveConfig", $saveEntry, 0);
		}
		$tpl -> Zone("save", "success");
	}
	
	// Replace tags for their actual values //////////////////////////////////////////
	$replaceTagsFor = array(
		"MAILS_INBOX_NAME",
		"MAILS_TRASHBOX_NAME",
		"MAILS_SENTBOX_NAME",
		"MAILS_SENT_SUBJECT_PREFIX",
		"MAILS_REPLY_SUBJECT_PREFIX",
		"MAILS_REPLY_QUOTE_SEPARATOR_PREFIX",
		"MAILS_REPLY_QUOTE_SEPARATOR_SUFFIX",
		"MAILS_FORWARD_SUBJECT_PREFIX",
		"MAILS_FORWARD_BODY_PREFIX",
		"MAILS_FORWARD_BODY_SUFFIX",
		"MAILS_QUOTA_MAX_KILOBYTES",
		"MAILS_CUSTOM_MAILBOX_NAME_MAX_LEN",
		"MAILS_CUSTOM_MAILBOX_MAX_BOXES",
		"MAILS_MAX_SUBJECT_LENGHT",
		"MAILS_MIN_REMAIL_DELAY"
	);
	
	foreach ($replaceTagsFor as $confTag) $replaceArray["CONF.{$confTag}"] = $CONF[$confTag];
	$tpl -> AssignArray($replaceArray);
	
	// Checkmark checkmarkable boxes /////////////////////////////////////////////////
	$checkMarkFor = array(
		"MAILS_AUTO_KEEP_SENT",
		"MAILS_FORWARD_FROM_ORIGIN",
		"MAILS_CUSTOM_MAILBOX_ALLOWED",
	);
	
	foreach ($checkMarkFor as $ckMarkEntity) {
		$ckMarkArray["ck.{$ckMarkEntity}"] = (ckBool($CONF[$ckMarkEntity]) ? "checked=\"checked\"" : NULL);
	}
	$tpl -> AssignArray($ckMarkArray);	

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