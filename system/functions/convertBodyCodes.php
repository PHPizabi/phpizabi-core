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

	function convertBodyCodes($body) {
		
		/*
			The following is the replacement array, note
			that the spaces before and after HTML versions
			is used to prevent building up long strings that
			can't be cut by the chopper function bewlow as
			it was built not to cut in the middle of a string
			that stands inside a html tag - this prevents
			cutting a long link in two parts thus making it
			unusable
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
			'/\\b((https?|ftp):\/\/([-A-Z0-9.]+)(\/[-A-Z0-9+&@#\/%=~_|!:,.;]*)?(\\?[-A-Z0-9+&@#\/%=~_|!:,.;]*)?)/si',
			'/\\n/',
		);
		
		$BCRegExpArrayReplace = array(
			'!',
			'<span style="color: \\1">\\3</span> ',
			'<strong>\\1</strong> ',
			'<em>\\1</em> ',
			'<u>\\1</u> ',
			'<blockquote><p> \\1 </p></blockquote>',
			'<s>\\1</s> ',
			'<tt>\\1</tt> ',
			'<a href="\\1" target="_blank">\\3</a>',
			'<br /> ',
		);

		$body = preg_replace($BCRegExpArrayPattern, $BCRegExpArrayReplace, $body);

		foreach(explode(" ", strip_tags($body)) as $key => $line) {
			/*
				Break long strings into smaller chunks (prevents
				destroying the interface with a 500 characters
				long "word"
			*/
			if (strlen($line) > 50) $body = str_replace($line, wordwrap($line, 25, " ", 1), $body);
			
		}
		
		/* 
			Return the body to the caller
		*/
		return $body;
	}
	
?>