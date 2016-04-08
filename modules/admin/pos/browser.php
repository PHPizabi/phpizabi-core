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
	$tpl -> Load("browser");
	
	// PHPIZABI ONLINE SERVICES BROWSER GET METHOD ////////////////////////////////////
	if (isset($_GET["mode"])) {
		
		$query = "version=".$GLOBALS["SYSTEM_VERSION"];
		foreach (
			array_merge(
				(isset($_GET)?$_GET:array()),
				(isset($_POST)?$_POST:array()),
				array(
					"CLIENT_URL" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF'])
				)
			) as $var => $val
		) {
			$query .= "&{$var}={$val}";
		}
		
		ignore_user_abort(1);
		if ($handle = @fsockopen("enhance.phpizabi.org", "80", $errno, $errstr, 15)) {
			fwrite($handle,
				"POST / HTTP/1.0\r\n"
				."Host: enhance.phpizabi.org\r\n"
				."Content-type: application/x-www-form-urlencoded\r\n"
				."Content-length: ".strlen($query)."\r\n"
				."Connection: close\r\n\r\n"
				.$query
			);
			
			$posBuffer = NULL;
			while (!feof($handle)) {
				$posBuffer .= fgets($handle, 1024);
			}
			fclose($handle);
			ignore_user_abort(0);
			
			if (preg_match('%<POS START>(.*)</POS>%si', $posBuffer, $posBufferMatches, PREG_OFFSET_CAPTURE)) {
			

				if (isset($posBufferMatches[1][0])) {
			
					$tpl -> Zone("posreturn", "enabled");
					$tpl -> AssignArray(array("posReturn" => $posBufferMatches[1][0]));
				}
				else $tpl -> Zone("posreturn", "unexpectedContent");
			}
			else $tpl -> Zone("posreturn", "unexpectedContent");
		}
		else $tpl -> Zone("posreturn", "connectionError");
	}
	else $tpl -> Zone("posreturn" ,"noModeKey");
	
	// TEMPLATE REPROCESS & FLUSH ////////////////////////////////////////////////////
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