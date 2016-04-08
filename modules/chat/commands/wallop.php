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

	class t_command extends triton {
		function runCommand($param, $channel=NULL) {
			
			if (isset($param[1])) {
				
				if (isset($_SESSION["triton"]["ircop"])) {
				
					unset($param[0]);
					
					$this -> writeChannelStrings(
						"wallop", 
						$this -> nickname, 
						vsprintf($this -> getMsg('WALLOP'), array($this -> nickname, implode(" ", $param))),
						$this -> channel
					);
				}
				else $this -> localEcho('ERR_NOACCESS', array($param[0])); 			
			}
			else $this -> localEcho('ERR_PARAMCOUNT', array($param[0])); 
		}
	}

?>