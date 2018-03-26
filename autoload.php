<?php
require_once "setup.php";

error_reporting(E_ERROR | E_WARNING | E_PARSE);

include "classes/System.class.php";
include "classes/Account.class.php";
include "classes/Renderer.class.php";
include "classes/Job.class.php";
include "classes/Navigation.class.php";

try {
	$database_connection = new mysqli(
		$database_config["host"],
		$database_config["username"],
		$database_config["password"],
		$database_config["database"]
	);
} catch (mysqli_sql_exception $e) {
	print $e->errorMessage();
	throw $e;
}

if(!isset($_SESSION['started'])) {
	session_start();
	$_SESSION['started'] = true;
}

define("ACCOUNT_TEACHER", 1);
define("ACCOUNT_TECHNICIAN", 0);
define("ACCOUNT_MANAGER", 2);

ob_start();
?>
