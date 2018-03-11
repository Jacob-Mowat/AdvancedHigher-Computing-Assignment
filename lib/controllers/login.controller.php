<?php
/**
	File:	login.controller
**/

require_once "../../core/setup.php";

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
	try 
	{
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);

		$Account = new Account(
			$username, $password
		);

		$Account->attachDatabase($Database);

		print("hi");
		$Account->attemptLogin();
		print("Doooo");
	} 
	catch (Exception $e) 
	{
		// add exception stuff here
	}
} 
else 
{
	return $Renderer->renderPage("home");
}

?>