<?php
/**
	File:	Account.class
**/

class Account 
{
	protected $account_username;
	private $account_password;

	protected $account_databasePlug;

	public function __construct( $username, $password ) 
	{
		$this->username = trim($username);
		$this->password = trim($password);	//	<-- Hashing will be applied here
	}

	public function attachDatabasePlug($databasePlug)
	{
		$this->account_databasePlug = $databasePlug;
	}

	public function attemptLogin() 
	{
		$this->account_databasePlug->query(
			"SELECT * FROM accounts WHERE username=($this->account_username) AND password=($this->account_password)");
		return ($this->account_databasePlug->result().count() > 0 ? true : false );
	}
}

?>