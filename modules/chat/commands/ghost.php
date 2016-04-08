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

			if (isset($_SESSION["triton"]["ircop"])) {
			
				$usersList = $this -> getChannelData($this -> channel, "users");
		
				/* User is not ghost? */
				if (!preg_match('/[G]:'.preg_quote($this -> nickname).',/i', $usersList)) {
					
					/* Mark as ghost */
					$usersList = preg_replace('/[A-Z]:('.preg_quote($this -> nickname).'),/i', 'G:\\1,', $usersList);
	
					$this -> writeChannelStrings(
						"wallop", 
						$this -> nickname, 
						vsprintf($this -> getMsg('WALLOP_GHOST'), array($this -> nickname, $this -> channel)),
						$this -> channel
					);
	
				}
				
				/* Set as respawn */
				else {
					
					/* Mark as ghost */
					$usersList = preg_replace('/[A-Z]:('.preg_quote($this -> nickname).'),/i', 'U:\\1,', $usersList);
	
					$this -> writeChannelStrings(
						"wallop", 
						$this -> nickname, 
						vsprintf($this -> getMsg('WALLOP_RESPAWN'), array($this -> nickname, $this -> channel)),
						$this -> channel
					);
				}
				
				/* Write the channel list */
				$this -> setChannelData($channel, "users", $usersList);
			}
			
			else $this -> localEcho('ERR_NOACCESS', array());
		}
	}

?>