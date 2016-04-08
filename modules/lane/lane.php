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

	/* Check Structure Availability */
	if (!defined("CORE_STRAP")) die("Out of structure call");
	

	// STAND UP FOR THE LANE! //
	// LIVE ACTIVITY NOTIFICATION ENGINE 0.100 //
	// 
	// THIS IS THE NOTIFICATION PART //
	
	// PREVENT USERS FROM ACCESSING THE LANE PAGE //////////////////////////////////////
	if (!isset($_GET["chromeless"])) die("You can't access the L.A.N.E. through a web browser.");
	
	// LANE CLEANUP ////////////////////////////////////////////////////////////////////
	/*
		If no lane token exist or that the lane
		token is older than 5 minutes ago, we will
		clear all the lane token for this user
	*/
	if (!isset($_SESSION["LANE_USTAMP"]) || $_SESSION["LANE_USTAMP"] < (date("U") - 300)) {

		if ($directoryHandle = opendir("system/cache/lane/")) {
			while (($file = readdir($directoryHandle)) !== false) {
				if (strpos($file, ".tk")) {
					
					/*
						Explode the token name at ".", we will get 3
						values, 0: User ID, 1: Token timestamp, 2: file extention
					*/
					$token = explode(".", $file);
					if ($token[0] == me("id")) unlink("system/cache/lane/{$file}");
				}
			}
			closedir($directoryHandle);
		}
		$_SESSION["LANE_USTAMP"] = date("U");
	} 
	
	else {
		
		if (!isset($_GET["pause"])) {
			
			if ($directoryHandle = opendir("system/cache/lane/")) {
				while (($file = readdir($directoryHandle)) !== false) {
					if (strpos($file, ".tk")) {
						
						/*
							Explode the token name at ".", we will get 3
							values, 0: User ID, 1: Token timestamp, 2: file extention
						*/
						$token = explode(".", $file);
						if ($token[0] == me("id")) {
							echo file_get_contents("system/cache/lane/{$file}");
							unlink("system/cache/lane/{$file}");
							break;
						}
					}
				}
				closedir($directoryHandle);
			}
			
		}

		$_SESSION["LANE_USTAMP"] = date("U");
	}


	
	
	// LOAD LANE TOKENS ////////////////////////////////////////////////////////////////
	
	
?>