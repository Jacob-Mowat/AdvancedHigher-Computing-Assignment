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
		if($Account->attemptLogin()) {}

		header("Location: ../../public/index.php");
		exit();

	} 
	catch (Exception $e) 
	{
		// add exception stuff here
		exit();
	}
} 
else 
{
	return $Renderer->renderPage("home");
}

?>