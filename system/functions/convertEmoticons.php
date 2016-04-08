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
	
	function convertEmoticons($body) {
		
		$emoticons = array(
			"O:)" 	=> "angel",
			"O:-)" 	=> "angel",
			":@" 	=> "angry",
			":S"	=> "confused",
			":-S"	=> "confused",
			"o.O"	=> "confused",
			"8-]"	=> "cool",
			":&#039;(" 	=> "crying",
			":$" 	=> "embarrassed",
			"8-|" 	=> "glasses",
			"8-)" 	=> "glasses",
			":-]" 	=> "grin",
			":*"	=> "kiss",
			":-*" 	=> "kiss",
			":|" 	=> "plain",
			"8)" 	=> "rolling",
			"8-)" 	=> "rolling",
			":("	=> "sad",
			":-(" 	=> "sad",
			":#"	=> "sealed",
			":-#" 	=> "sealed",
			"+-(" 	=> "sick",
			":)" 	=> "smile",
			":DD" 	=> "smile-big2",
			":D" 	=> "smile-big",
			":-O" 	=> "surprise",
			":P"	=> "tongue",
			":-P" 	=> "tongue",
			":?" 	=> "uh",
			":-?"	=> "uh",
			":w" 	=> "vampire",
			"(V)"	=> "vampire",
			"&#059;)"	=> "wink",
			"&#059;-)" 	=> "wink"
		);
			
		$emoticonReplaceCount = 0;
			
		foreach ($emoticons as $asciiCode => $imageName) {
			while (strstr($body, $asciiCode) and $emoticonReplaceCount < 20) {
				$body = substr_replace(
					$body, 
					'<img 
						src="theme/default/images/icons/emoticons/'.$imageName.'.png" 
						align="absbottom" 
						width="16" 
						height="16"
						alt="'.$imageName.'"
						title="'.$imageName.'"
					>',
					strpos($body, $asciiCode, 0),
					strlen($asciiCode)
				);

				$emoticonReplaceCount ++;
			}
		}

		return $body;
	}
	
?>