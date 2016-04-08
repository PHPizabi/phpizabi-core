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
	
	function clearBodyCodes($body) {

		/*
			The following is the replacement array. All the body
			codes are converted into a single space (except the
			\n character which is still converted into a BR)
		*/
		$BCRegExpArrayPattern = array(
			'/(&#33;|!){10,}/',
			'%\\[color (([a-zA-Z0-9#]*))\\]([^\\[]*)\\[/color\\]%',
			'%\\[b\\]([^\\[]*)\\[/b\\]%',
			'%\\[i\\]([^\\[]*)\\[/i\\]%',
			'%\\[u\\]([^\\[]*)\\[/u\\]%',
			'%\\[quote\\]([^\\[]*)\\[/quote\\]%',
			'%\\[s\\]([^\\[]*)\\[/s\\]%',
			'%\\[tt\\]([^\\[]*)\\[/tt\\]%',
			'/\\n/',
		);
		
		$BCRegExpArrayReplace = array(
			'!',
			'\\3 ',
			'\\1 ',
			'\\1 ',
			'\\1 ',
			'\\1 ',
			'\\1 ',
			'\\1 ',
			'<br /> ',
		);
		 
		$body = preg_replace($BCRegExpArrayPattern, $BCRegExpArrayReplace, $body);

		/*
			Break long strings into smaller chunks (prevents
			destroying the interface with a 500 characters
			long "word"
		*/
		foreach(explode(" ", strip_tags($body)) as $key => $line) {
			if (strlen($line) > 50) $body = str_replace($line, wordwrap($line, 25, " ", 1), $body);
		}
		
		/* 
			Return the body to the caller
		*/
		return $body;
	}

?>