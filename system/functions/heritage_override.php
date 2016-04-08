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
	
	function heritage_override($userID) {
		global $CONF;

		$heritage = unpk(file_get_contents($CONF["HERITAGE_INFOFILE"]));
		
		/*
			Save on DB access, if "$userID" is "me", we will use the ME function
			instead, or get the user heritage ID ...
		*/
		if (is_numeric($userID) and $userID != me("id")) $heritageID = _fnc("user", $userID, "account_type");
		elseif ($userID == me("id") or $userID == "me") $heritageID = me("account_type");

		if (isset($heritageID) && is_numeric($heritageID) && $heritageID != 0 && is_array($heritage) && isset($heritage[$heritageID])) {
			if (is_array($heritage[$heritageID]["CONF"])) foreach($heritage[$heritageID]["CONF"] as $key => $val) $CONF[$key] = $val;
		}
		unset($heritage);
	}

?>