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
				
				if (is_file("../../system/cache/chat/u_".$param[1].".txt")) {
				
					if (isset($param[2])) 
						$channel = $param[2];
			
					$usernfo = file_get_contents("../../system/cache/chat/u_".$param[1].".txt");
					list($u_ip, $u_age, $u_gender, $u_picture, $u_logintime, $u_id) = explode("|", $usernfo);

					@touch("../../system/cache/chat/k_".ip2long($u_ip)."_".$channel.".txt");
					
					sleep(1);

					/* Unset the user's entry from the channel nicknames list */
					$usersList = $this -> getChannelData($channel, "users");
					$nickPosition = strpos($usersList, ":".$param[1].",");
					$usersList = substr_replace($usersList, '', $nickPosition - 1, strlen($param[1]) + 3);
					$this -> setChannelData($channel, "users", $usersList);

					$this -> sysMsg('SYS_KICK', array($param[1], $channel, $this->nickname));

				}
				else $this -> localEcho('ERR_NOSUCHNICK', array($param[1]));
			}
			else $this -> localEcho('ERR_NOACCESS', array());
		}
	}

?>