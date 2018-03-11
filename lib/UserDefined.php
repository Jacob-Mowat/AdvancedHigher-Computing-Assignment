<?php
/**
	File:	UserDefined
	Definitions:
		-->	req_class()
		-->	req_func()
		--> req_database()
**/

// require_once "../core/config.php";

function req_class($class)
{
	return require_once LIBRARY_PATH . $class . ".class.php";
}


function req_controller($controller)
{
	return "http://kgscompsci.kirkwallgrammarschool.highercomputingscience.org" . "/lib/" . "controllers/" . $controller . ".controller.php";
}

function req_database( $database_settings )	
{
	$dsn = $database_settings["driver"] . 
			":host=" . $database_settings["host"] . 
			((!empty($database_settings["port"])) ? (";port=" . $database_settings["port"]) : "") .
			";dbname=" . $database_settings["schema"] .
			";charset=" . $database_settings["charset"];

	return new PDO($dsn, $database_settings["username"], $database_settings["password"], $database_settings["options"]);
}
?>