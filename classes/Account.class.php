<?php
/**
	File:	Account.class
**/
class Account 
{
	public static $departments_list = array(
		"artdesign" => "Art & Design",
		"adminit" => "Administration & IT",
		"compsci" => "Computing Science",
		"cursupport" => "Curriculum Support",
		"designtech" => "Design & Technology",
		"drama" => "Drama",
		"english" => "English",	
		"guidance" => "Guidance",
		"library" => "Library",
		"mathematics" => "Maths",
		"lang" => "Languages",
		"music" => "Music",
		"pe" => "PE",
		"science" => "Science",
		"socialsubj" => "Social Subjects"
	);

	public static function checkPasswordForUser(
		$username, 
		$password,
		$database_connection
	) {
		$q = mysqli_query(
			$database_connection,
			"SELECT password FROM accounts WHERE username='{$username}' LIMIT 1"
		);

		$password_database_hashed = $q->fetch_array(MYSQLI_ASSOC)['password'];

		if (password_verify(
			$password, $password_database_hashed
		)) {
			return true;
		} else {
			return false;
		}
	}

	public static function isAdmin($username, $connection) {
		$q = mysqli_query(
			$connection,
			"SELECT * FROM accounts WHERE username='{$username}'"
		);
		$result = $q->fetch_array(MYSQLI_ASSOC);
		if(count($result) >= 1) {
			if($result[0]['type'] == 3) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	// TODO: doesUsernameExist();

	public static function filter($var) {
		return filter_var($var, FILTER_SANITIZE_STRING);
	}

	public static function filter_email($var) {
		return filter_var($var, FILTER_SANITIZE_EMAIL);
	}

	public static function validate_password($password) {
		if (strlen($password) <= '8') {
			return false;
		} elseif(!preg_match("#[0-9]+#", $password)) {
			return false;
		} elseif(!preg_match("#[A-Z]+#", $password)) {
			return false;
		} elseif(!preg_match("#[a-z]+#", $password)) {
			return false;
		} else {
			return true;
		}
	}

	public static function changeAccountTypeToInt($type) {
		switch($type) {
			case "technician":
				return 0;
				break;
			case "teacher":
				return 1;
				break;
			case "management":
				return 2;
				break;
		}
	}

	public static function register(
		$username_untrusted, 
		$password_untrusted, 
		$passwordconfirm_untrusted, 
		$email_untrusted, 
		$firstname_untrusted, 
		$lastname_untrusted, 
		$usertype_untrusted,
		$department_untrusted, 
		$database_connection
	) {
		$username = Account::filter($username_untrusted); 
		$password = Account::filter($password_untrusted); 
		$passwordconfirm = Account::filter($passwordconfirm_untrusted);
		$email = Account::filter_email($email_untrusted);
		$firstname = Account::filter($firstname_untrusted);
		$lastname = Account::filter($lastname_untrusted);
		$usertype = Account::changeAccountTypeToInt(Account::filter($usertype_untrusted));
		$department = Account::filter($department_untrusted);

		if ($password == $passwordconfirm) {
			if(Account::validate_password($password)) {
				$password = password_hash($password, PASSWORD_BCRYPT);
				$q = mysqli_query(
					$database_connection,
					"INSERT INTO accounts (username, password, type, firstname, lastname, email, department) VALUES ('{$username}', '{$password}', '{$usertype}', '{$firstname}', '{$lastname}', '{$email}', '{$department}')"
				);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

	public static function login(
		$username, 
		$password, 
		$database_connection
	) {
		$q = mysqli_query(
			$database_connection,
			"SELECT * FROM accounts WHERE username='{$username}'");
		
		$result = $q->fetch_array(MYSQLI_ASSOC);
		print_r($result);
		
		if(count($result) >= 1)
		{
			if(Account::checkPasswordForUser($username, $password, $database_connection)) {
				return true;
			} else {
				return false;
			}
		} 
		else 
		{
			return false;
		}
	}

	public static function getAccount(
		$username, 
		$password, 
		$database_connection
	) {
		if (Account::login($username, $password, $database_connection)) {
			$q = mysqli_query(
				$database_connection,
				"SELECT * FROM accounts WHERE username='{$username}'"
			);
			return $q->fetch_array(MYSQLI_ASSOC);
		} else {
			return array();
		}
	}

	public static function getUsernameByID($id, $database_connection) {
		$q = mysqli_query($database_connection, "SELECT * FROM accounts WHERE id='{$id}'");
		return $q->fetch_array(MYSQLI_ASSOC)['username'];
	}

	public static function getFullnameByID($id, $database_connection) {
		$q = mysqli_query($database_connection, "SELECT * FROM accounts WHERE id='{$id}'");
		$account = $q->fetch_array(MYSQLI_ASSOC);
		return $account['firstname'] . " " . $account['lastname'];
	}
}
?>