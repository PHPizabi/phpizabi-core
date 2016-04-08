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
			
			/* Parameter set? */
			if (isset($param[1])) {
			
				/* Remove the pound character if any */
				if (substr($param[1], 0, 1) == "#") $newChannel = strtolower(substr($param[1], 1));
				else $newChannel = strtolower($param[1]);
				$oldChannel = $this -> channel;
				
				/* legal channel name? */
				if (!preg_match('/[^A-Z0-9_\\-]/i', $newChannel)) {
				
					/* Broadcast the leave message and remove the old entry from the channel list */
					$this -> sysMsg("SYS_PART", array($this -> nickname, $oldChannel, $newChannel));
	
					$usersList = $this -> getChannelData($this -> channel, "users");
					$nickPosition = strpos($usersList, ":".$this -> nickname.",");
					$usersList = substr_replace($usersList, '', $nickPosition - 1, strlen($this -> nickname) + 3);
					$this -> setChannelData($oldChannel, "users", $usersList);
					
					/* We don't want to see the part message. Let's reset the token */
					$_SESSION["triton"]["stamp"] = $this -> userStamp = $this -> token();
					
					usleep(1000);
					
					/* Broadcast the join message and add the user to the nicklist */
					$this -> sysMsg("SYS_JOIN", array($this -> nickname, $newChannel), $this -> nickname, $newChannel);
					$usersList = $this -> getChannelData($newChannel, "users");
					$this -> setChannelData($newChannel, "users", $usersList."U:".$this -> nickname.",");
				
					/* Refresh the session information for the user's channel */
					$_SESSION["triton"]["channel"] = $this -> channel = $newChannel;
	
				}
			}
		}
	}
	
?>