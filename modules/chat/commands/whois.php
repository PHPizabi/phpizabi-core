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
		
			if (is_file("../../system/cache/chat/u_".$param[1].".txt")) {
			
				$whois = file_get_contents("../../system/cache/chat/u_".$param[1].".txt");
				list($u_ip, $u_age, $u_gender, $u_picture, $u_logintime, $u_id) = explode("|", $whois);
				
				if (isset($_SESSION["triton"]["ircop"])) {
					
					if (preg_match('/\\b(?:[0-9]{1,3}\\.){3}[0-9]{1,3}\\b/', $u_ip)) {
						if ($result = gethostbyaddr($u_ip))
							$u_host = $result;
						else $u_host = $u_ip;
					}
					
					else {
						$u_host = $u_ip;
						if ($result = gethostbyname($u_host))
							$u_ip = $result;
					}
				}
				
				else {
					$u_ip = "N/A";
					$u_host = "N/A";
				}
				
				$this -> localEcho('ECHO_WHOIS', array(
					$param[1], 
					$u_ip,
					$u_host,
					$u_age,
					$u_gender,
					$u_id,
					date("r", $u_logintime)
				));

			}
			else $this -> localEcho('ERR_NOSUCHNICK', array($param[1]));
		}
	}

?>