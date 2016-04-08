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

		
			// Z = Op Away
			// Y = Voice Away
			// X = Mute Away
			// W = User Away
			
			$usersList = $this -> getChannelData($this -> channel, "users");
	
			/* User is not away? */
			if (!preg_match('/[W-Z]:'.preg_quote($this -> nickname).',/i', $usersList)) {
				
				/* Get the actual user's status */
				preg_match('/([A-V]):'.preg_quote($this -> nickname).',/i', $usersList, $status);
				
				switch($status[1]) {
					case('U'): default: $awayMode = 'W'; break;
					case('M'): $awayMode = 'X'; break;
					case('V'): $awayMode = 'Y'; break;
					case('O'): $awayMode = 'Z'; break;
				}
				
				/* Mark as away! */
				$usersList = preg_replace('/[A-V]:('.preg_quote($this -> nickname).'),/i', $awayMode.':\\1,', $usersList);
				$this -> localEcho('ECHO_SET_AWAY', array());
			}
			
			/* Set as back */
			else {
				
				/* Get the actual user's status */
				preg_match('/([W-Z]):'.preg_quote($this -> nickname).',/i', $usersList, $status);
				
				switch($status[1]) {
					case('W'): default: $awayMode = 'U'; break;
					case('X'): $awayMode = 'M'; break;
					case('Y'): $awayMode = 'V'; break;
					case('Z'): $awayMode = 'O'; break;
				}
				$usersList = preg_replace('/[W-Z]:('.preg_quote($this -> nickname).'),/i', $awayMode.':\\1,', $usersList);
				$this -> localEcho('ECHO_UNSET_AWAY', array());
			}
			
			$this -> setChannelData($channel, "users", $usersList);
	
		}
	}
?>