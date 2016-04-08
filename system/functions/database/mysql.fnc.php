<?php
///////////////////////////////////////////////////////////////////////////////////////
// PHPizabi 2.01 Alpha [Madison]                             http://www.phpizabi.org //
///////////////////////////////////////////////////////////////////////////////////////
//                                                                                   //
// Please read the LICENSE.md & README.md file before using/modifying this software  //
//                                                                                   //
// Developing Author:       Andy James, AndyWTBlueHair - andy@andy.blue              //
// Last modification date:  April 7th, 2016                                          //
// Version:                 PHPizabi 2.01 Alpha                                      //
//                                                                                   //
// (C) 2005, 2006 Real!ty Medias                                                     //
// (C) 2007-2016 Andy.Blue                                                           //
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

	$GLOBALS["MYSQL_CONNECTION"] = new PDO("mysql:host={$CONF["MYSQL_DATABASE_HOSTNAME"]};dbname={$CONF["MYSQL_DATABASE_DATABASENAME"]}",
	$CONF["MYSQL_DATABASE_USERNAME"],
	$CONF["MYSQL_DATABASE_PASSWORD"]);

}

# This function needs the fetch removed from it
function myQ($content) {
	global $CONF;

	if (!isset($GLOBALS["MYSQL_CONNECTION"]) or !$GLOBALS["MYSQL_CONNECTION"]) myConnect();
	$GLOBALS["MYSQL_CONNECTION"]->query(str_replace("[x]", $CONF["MYSQL_DATABASE_TABLES_PREFIX"], $content));
}

function myF($content) {
	global $CONF;

	if (!isset($GLOBALS["MYSQL_CONNECTION"]) or !$GLOBALS["MYSQL_CONNECTION"]) myConnect();
	return $GLOBALS["MYSQL_CONNECTION"]->query(str_replace("[x]", $CONF["MYSQL_DATABASE_TABLES_PREFIX"], $content))->fetch(PDO::FETCH_BOTH);
}

# This function needs re-written to provide the proper output
function myNum($content) {
	if (!isset($GLOBALS["MYSQL_CONNECTION"]) or !$GLOBALS["MYSQL_CONNECTION"]) myConnect();
	return mysql_num_rows($content);
}

function myClose() {
$GLOBALS["MYSQL_CONNECTION"] = null;
}
?>
