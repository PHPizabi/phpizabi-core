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

			/* Unset the user's entry from the channel nicknames list */
			$usersList = $this -> getChannelData($this -> channel, "users");
			$nickPosition = strpos($usersList, ":".$this -> nickname.",");
			$usersList = substr_replace($usersList, '', $nickPosition - 1, strlen($this -> nickname) + 3);
			$this -> setChannelData($this -> channel, "users", $usersList);
			
			/* Broadcast the message */
			$this -> sysMsg('SYS_QUIT', array($this -> nickname));
			
			/* Set a quit timer */
			$_SESSION["triton"]["quit"] = time();
			$_SESSION["triton"]["stamp"] = 0;
			session_write_close();
			
			die();
		}
	}
	
?>