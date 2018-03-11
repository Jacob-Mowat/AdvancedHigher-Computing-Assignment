<?php
/**
	File:	Account.class
**/

class Account 
{
	protected $account_username;
	private $account_password;

	private $account_database;

	public function __construct( $username, $password ) 
	{
		$this->username = trim($username);
		$this->password = trim($password);	//	<-- Hashing will be applied here
	}

	function attachDatabase($database)
	{
		$this->account_database = $database;
	}

	function attemptLogin() 
	{
		$this->account_database->query("SELECT * FROM accounts WHERE username='$this->account_username' AND password='$this->account_password'");
		$result = $this->account_database->fetch(PDO::FETCH_ASSOC);
		if($result->rowCount() > 0)
		{
			print("dooooo");
			$_SESSION["login_verified"] = true;
			header("Location: http://kgscompsci.kirkwallgrammarschool.highercomputingscience.org/public/");
		} 
		else 
		{
			print("dooooo");
			$_SESSION["login_verified"] = false;
			header("Location: http://kgscompsci.kirkwallgrammarschool.highercomputingscience.org/public/");
		}
	}
}

?>