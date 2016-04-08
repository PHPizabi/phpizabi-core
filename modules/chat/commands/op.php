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
	
			/* Username set? */
			if (isset($param[1])) {
				
				$usersList = $this -> getChannelData($this -> channel, "users");
	
				/* Me is operator? */
				if (strstr($usersList, "O:".$this -> nickname.",") or isset($_SESSION["triton"]["ircop"])) {
				
					/* User is in channel? */
					if (preg_match('/[A-Z]:'.preg_quote($param[1]).',/i', $usersList)) {
		
						/* User is not already operator? */
						if (!preg_match('/O:'.preg_quote($param[1]).',/i', $usersList)) {
						
							/* M'kay! Let's do it */
							$usersList = preg_replace('/[A-Z]:('.preg_quote($param[1]).'),/i', 'O:\\1,', $usersList);
							$this -> setChannelData($channel, "users", $usersList);
							
							$this -> sysMsg('SYS_OP', array($param[1], $this -> nickname));
						}
					}
					else $this -> localEcho('ERR_NOSUCHNICK', array($param[1]));
				}
				else $this -> localEcho('ERR_NOACCESS', array());
			}
			else $this -> localEcho('ERR_PARAMCOUNT', array($param[0]));
		}
	}
	
?>