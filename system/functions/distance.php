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
	
	function distance ($user1, $user2) {
		global $CONF;
		
		/*
			Find out the distance in miles
		*/
		$distanceValue = rad2deg(acos(sin(deg2rad(_fnc("user", $user1,"latitude")))*sin(deg2rad(_fnc("user", $user2, "latitude")))+cos(deg2rad(_fnc("user", $user1,"latitude")))*cos(deg2rad(_fnc("user", $user2,"latitude")))*cos(deg2rad(_fnc("user", $user1,"longitude")-_fnc("user", $user2,"longitude")))))*69.09;		
		/*
			Distance value evaluated in miles
		*/
		if ($CONF["DISTANCE_VALUES_UNIT:MILES"]) $distanceRenderValue = $distanceValue;
		
		/*
			Distance value evaluated in kilometers
		*/
		else $distanceRenderValue = $distanceValue * 1.609344;

		/*
			Return data
		*/
		if ($distanceRenderValue >= 6319) return false;
		else return number_format($distanceRenderValue, 2, ".", ",");
    }

?>