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
	
			die();
			
			$reservedNickNames = array('system', 'x', 'root', 'admin', 'administrator', 'channel');
			
			/* Parameter set? */
			if (isset($param[1])) {
				/* Legal nickname? */
				if (preg_match('/\\b[A-Z0-9_\\-]{0,9}\\b/i', $param[1])) {
					/* Not reserved? */
					if (!in_array(strtolower($param[1]), $reservedNickNames)) {
						/* Not the actual nickname? */
						if ($param[1] != $this -> nickname) {
	
							/* Do it! */
							$_SESSION["triton"]["nickname"] = $param[1];
							$this -> sysMsg('SYS_NICK', array($this -> nickname, $param[1]));
							
						}
					} else $this -> localEcho('ERR_RESERVEDNICK', array($param[1]));
				}
				else $this -> localEcho('ERR_NICKFORMAT', array($param[1]));
			}
			else $this -> localEcho('ERR_PARAMCOUNT', array($param[0]));
		}
	}

?>