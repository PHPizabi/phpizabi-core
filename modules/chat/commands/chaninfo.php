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
				
				$channel = strtolower($param[1]);
				
				if (is_file("cache/c_".strtolower($channel).".txt")) {
					
					$channelModes = 
						($this -> getChannelData($channel, "mode_a") ? "a" : '')
						.($this -> getChannelData($channel, "mode_A") ? "A" : '')
						.($this -> getChannelData($channel, "mode_c") ? "c" : '')
						.($this -> getChannelData($channel, "mode_G") ? "G" : '')
						.($this -> getChannelData($channel, "mode_i") ? "i" : '')
						.($this -> getChannelData($channel, "mode_k") != '' ? "k" : '')
						.($this -> getChannelData($channel, "mode_l") != '' ? "l" : '')
						.($this -> getChannelData($channel, "mode_m") ? "m" : '')
						.($this -> getChannelData($channel, "mode_n") ? "n" : '')
						.($this -> getChannelData($channel, "mode_N") ? "N" : '')
						.($this -> getChannelData($channel, "mode_O") ? "O" : '')
						.($this -> getChannelData($channel, "mode_P") ? "P" : '')
						.($this -> getChannelData($channel, "mode_q") ? "q" : '')
						.($this -> getChannelData($channel, "mode_Q") ? "Q" : '')
						.($this -> getChannelData($channel, "mode_r") ? "r" : '')
						.($this -> getChannelData($channel, "mode_s") ? "s" : '')
						.($this -> getChannelData($channel, "mode_t") ? "t" : '')
						.($this -> getChannelData($channel, "mode_T") ? "T" : '');
					
					$this -> localEcho('ECHO_CHANINFO', array($channel, $channelModes));
				}
				else $this -> localEcho('ERR_NOSUCHCHAN', array($param[1])); 
			}
			else $this -> localEcho('ERR_PARAMCOUNT', array($param[0])); 
		}
	}
?>