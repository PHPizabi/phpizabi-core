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
	
		function sendmail($to, $subject, $body) {
		global $CONF;
		
		/* Convert CR to BR if required */
		if ($CONF["SYSMAIL_CONVERT_CR_TO_BR"]) $body = nl2br($body);
		
		/* Convert \r\n to \n if required */
		if ($CONF["SYSMAIL_CONVERT_NR_TO_N"]) $body = str_replace("\r\n", "\n", $body);
		
		/* Strip the tab character if needed */
		if ($CONF["SYSMAIL_STRIP_TAB"]) $body = str_replace("\t", "", $body);
		
		
		/* Set the boundary and linefeed variables */
		$boundary = md5(uniqid(1));
		$lf = "\n";
		
		/* Prepare the header */
		$headers  = "From: {$CONF["SITE_NAME"]} <{$CONF["SITE_SYSTEM_EMAIL"]}>" .$lf;
		$headers .= "To: <{$to}>" .$lf;
		$headers .= "Return-Path: {$CONF["SITE_NAME"]} <{$CONF["SITE_SYSTEM_EMAIL"]}>" .$lf;
		$headers .= "Message-id: <".uniqid(0,0)."@{$_SERVER['HTTP_HOST']}>" .$lf;
		$headers .= "User-Agent: ".$GLOBALS["SYSTEM_VERSION"] .$lf;
		$headers .= "MIME-Version: 1.0" .$lf;
		$headers .= "Content-Type: multipart/alternative; boundary=\"{$boundary}\"" .$lf.$lf;
		$headers .= strip_tags($body) .$lf;
		$headers .= "--{$boundary}" .$lf;
		$headers .= "Content-Type: text/plain; charset=ISO-8859-1" .$lf;
		$headers .= "Content-Transfer-Encoding: 8bit" .$lf.$lf;
		$headers .= strip_tags($body) .$lf;
		$headers .= "--{$boundary}" .$lf;
		$headers .= "Content-Type: text/HTML; charset=ISO-8859-1" .$lf;
		$headers .= "Content-Transfer-Encoding: 8bit" .$lf.$lf;
		$headers .= nl2br($body) .$lf;
		$headers .= "--{$boundary}--" .$lf;

		// IMAP MAIL METHOD //////////////////////////////////////////////////////////////
		if ($CONF["SYSMAIL_USE_IMAP_GATE"] && function_exists('imap_mail')) {
			if (!imap_mail("<".$to.">", $subject, $body, "From: {$CONF["SITE_NAME"]}") and $CONF["SYSMAIL_ROLLBACK_ON_ERROR"]) {
				return mail(NULL, $subject, NULL, $headers);
			} else return true;
		}
		else return mail(NULL, $subject, NULL, $headers);
	}
	
?>