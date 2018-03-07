<?php
/**
	File:	UserDefined
	Definitions:
		-->	req_class()
		-->	req_func()
**/

function req_class($class) 
{
	return require_once LIBRARY_PATH . $class . ".class.php";
}

function req_controller($controller)
{
	echo "../../lib/controllers/" . $controller . ".controller.php";
}
?>