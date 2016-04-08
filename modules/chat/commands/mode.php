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
	
				$usersList = $this -> getChannelData($this -> channel, "users");
	
				/* Me is operator? */
				if (strstr($usersList, "O:".$this -> nickname.",") or isset($_SESSION["triton"]["ircop"])) {
				
					unset($param[0]);
					
					$channelModes = array("a","A","c","G","i","k","l","m","n","N","O","P","q","Q","r","s","t","T");
					
					$positive = true;
					$setModes = NULL;
	
					for ($i=0; $i < strlen($param[1]); $i++) {
						
						$key = substr($param[1], $i, 1);
						
						if ($key == "+") $positive = true;
						elseif ($key == "-") $positive = false;
						else {
							if (in_array($key, $channelModes)) {
								
								if ($positive) {
									if ($key == "k" or $key == "l" and isset($param[$i+2])) {
										$this -> setChannelData($channel, "mode_{$key}", $param[$i+2]);
									}
									else  {
										$this -> setChannelData($channel, "mode_{$key}", 1);
									}
									$setModes .= "+{$key} ";
								}
								else {
									$this -> setChannelData($channel, "mode_{$key}", 0);
									$setModes .= "-{$key} ";
								}
							}
						}
					}
					if (!is_null($setModes)) {
						$this -> sysMsg('SYS_MODE', array($this -> nickname, $setModes, $channel));
					}
				}
				else $this -> localEcho('ERR_NOACCESS', array());
			}
			else $this -> localEcho('ERR_PARAMCOUNT', array($param[0]));
		}
	}
	
?>