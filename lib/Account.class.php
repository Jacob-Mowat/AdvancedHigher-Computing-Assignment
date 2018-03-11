<?php
/**
	File:	Account.class
**/

class Account 
{
	private $account_username;
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
		$q = $this->account_database->query("SELECT * FROM accounts WHERE username='$this->account_username' AND password='$this->account_password'");
		
		$result = $q->fetch(PDO::FETCH_ASSOC);
		
		if(count($result) > 0)
		{
			$_SESSION["login_verified"] = true;
			return true;
		} 
		else 
		{
			$_SESSION["login_verified"] = false;
			return false;
		}
	}
}

?>