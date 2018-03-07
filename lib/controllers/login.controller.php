<?php
/**
	File:	login.controller
**/

include_once "../../core/setup.php";

if($_POST['submit']) 
{
	try 
	{
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);

		$Account = new Account(
			$username, $password
		);

		if($Account->attemptLogin())
		{
			// $Account->login();
			// $Account->init();
			echo "dSUSSSS";
		}
	} 
	catch (Exception $e) 
	{
		// add exception stuff here
	}
}

?>