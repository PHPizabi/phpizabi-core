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
	
	function str_spot($string, $words, $len) {
		
		$words = preg_replace('/[^0-9A-Za-z ]?/', '', $words);
		$words = strtr($words, array(" " => "|", "it" => "", "the" => ""));

		if (preg_match('/(.{0,'.($len/2).'})('.$words.')(.{0,'.($len/2).'})/i', $string, $matches, PREG_OFFSET_CAPTURE, 1)) {
			return preg_replace('/('.$words.')/i', '<span class="hilight">\\1</span>', $matches[0][0]);
		}
		else return substr($string, 0, $len);
	}
	
?>