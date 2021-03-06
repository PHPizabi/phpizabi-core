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
	
	function laneMakeToken($type, $dst_user, $array = array()) {

		if (is_file("theme/{$GLOBALS["THEME"]}/templates/GLOBALS/lane/{$type}.tpl")) {
			
			$tpl = new template;
			$tpl -> LoadThis(file_get_contents("theme/{$GLOBALS["THEME"]}/templates/GLOBALS/lane/{$type}.tpl"));
			$laneOptoBuffer = strtr($tpl->Flush(1), $array);
			
			if ($handle = fopen("system/cache/lane/{$dst_user}.".date("U").".tk", "w")) {
				fwrite($handle, $laneOptoBuffer);
				fclose($handle);
			}
		}
	}
	
?>