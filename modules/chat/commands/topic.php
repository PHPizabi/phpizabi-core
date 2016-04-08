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

			$usersList = $this -> getChannelData($this -> channel, "users");
						
			/* Are we allowed ? */
			if (
				!$this -> getChannelData($channel, "mode_t") or
				($this -> getChannelData($channel, "mode_t") and strstr($usersList, "O:".$this -> nickname.","))
			) {
				
				unset($param[0]);
				
				$newTopic = implode(" ", $param);
				$this -> setChannelData($channel, "topic", substr($newTopic, 0, 255));
				$this -> sysMsg('SYS_TOPIC', array($this -> nickname, $newTopic));
			}
			
			else $this -> localEcho('ERR_NOACCESS', array());
		}
	}

?>