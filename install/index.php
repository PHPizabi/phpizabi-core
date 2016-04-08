<?php 

session_start();

include(isset($_GET["step"])?"steps/{$_GET["step"]}.php":"steps/1.php");

if (isset($GLOBALS["processors"])) foreach ($GLOBALS["processors"] as $proc) {
		include("includes/{$proc}");
}