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
				
				if (!strstr($this -> getChannelData($this -> channel, "users"), "M:".$this -> nickname.",")) {
			
					if (!$this -> getChannelData($this -> channel, "mode_m")) {

						$user = $param[1];
					
						unset($param[0], $param[1]);
						if (isset($param[2])) $object = implode(" ", $param);
						else $object = "box of tampons";
				
						$this -> actionMsg('ACTION_SLAP', array($this -> nickname, $user, $object));
					
					}
					else $this -> localEcho('ERR_MODERATED', array($this -> channel));
				
				}
				else $this -> localEcho('ERR_MUTED', array($this -> channel));

			}
			else $this -> localEcho('ERR_PARAMCOUNT', array($param[0]));
		}
	}
	
?>