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

	function myConnect() { // MYSQL Database connection //
		global $CONF;

		$GLOBALS["MYSQL_CONNECTION"] = @mysql_connect(
			$CONF["MYSQL_DATABASE_HOSTNAME"], 
			$CONF["MYSQL_DATABASE_USERNAME"], 
			$CONF["MYSQL_DATABASE_PASSWORD"]
		);
		
		if (!@mysql_select_db($CONF["MYSQL_DATABASE_DATABASENAME"])) die(mysql_error());
	}
	
	function myQ($content) {
		global $CONF;
		
		if (!isset($GLOBALS["MYSQL_CONNECTION"]) or !$GLOBALS["MYSQL_CONNECTION"]) myConnect();
		return mysql_query(str_replace("[x]", $CONF["MYSQL_DATABASE_TABLES_PREFIX"], $content)); 
	}
	
	function myF($content) {
		if (!isset($GLOBALS["MYSQL_CONNECTION"]) or !$GLOBALS["MYSQL_CONNECTION"]) myConnect();
		return mysql_fetch_array($content);
	}
	
	function myNum($content) {
		if (!isset($GLOBALS["MYSQL_CONNECTION"]) or !$GLOBALS["MYSQL_CONNECTION"]) myConnect();
		return mysql_num_rows($content);
	}
	
	function myClose() {
		return @mysql_close();
	}
?>