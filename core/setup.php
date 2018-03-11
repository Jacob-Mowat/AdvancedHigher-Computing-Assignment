<?php

if(!isset($_SESSION)) 
{
	session_start();
	$_SESSION["login_verified"] = false;
}

include_once "config.php";

defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", $config["paths"]["library"]);

defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", $config["paths"]["templates"]);

// 	Enable all error reporting since 

switch ($config["debug_mode"]) {
	case true:
		ini_set("error_reporting", "true");
		error_reporting(E_ALL|E_STRCT);
		break;
	case false:
		ini_set("error_reporting", "false");
		// error_rporting(E_|E_STRCT);
		break;
	default:
		break;
}

require_once LIBRARY_PATH . "UserDefined.php";

foreach ($config["build_classes"] as $key => $value) 
{
	req_class($value);
}

$Renderer = new Renderer();

$Database = req_database($config["db"]["main"]);

