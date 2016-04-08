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

	function user($id, $data) {
		
		/*
			Sometimes the script will blindly query on the ID field
			while it has the answer in the request itself. We don't
			need to query on that, let's return the $id value.
		*/
		if ($data == 'id') return $id;
		
		/*
			This is the user query method, some pages will return data
			on selfuser using the user function, but the me function
			is smarter in that case. Let's pass selfuserdata requests
			to the right function
		*/
		if ($id == me('id')) return me($data);
		

		/*
			If we got the requested data in memory, we will send it 
			to the caller without querying ...
		*/
		if (isset($GLOBALS["DATA_BY_USER"][$id][$data])) return $GLOBALS["DATA_BY_USER"][$id][$data];

		/*
			If we're still alive past that point, it means that
			we don't have anything to pass to the caller, let's
			query the database and find some results
		*/
		$GLOBALS["DATA_BY_USER"][$id] = myF(myQ("SELECT `{$data}` FROM `[x]users` WHERE `id`='{$id}'"));
		if (isset($GLOBALS["DATA_BY_USER"][$id][$data])) return $GLOBALS["DATA_BY_USER"][$id][$data];

		/*
			Ahem ... well something went wrong! Send ... nothing!
		*/
		return '';
	}
	
?>