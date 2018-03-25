<?php
include "../autoload.php"; 

if($_POST['submit']) {

	$username_untrusted = trim(strip_tags(stripslashes($_POST['username'])));
	$password_untrusted = trim(strip_tags(stripslashes($_POST['password'])));

	print($username_untrusted);
	print($password_untrusted);

	if(Account::login($username_untrusted, $password_untrusted, $database_connection)) {
		$_SESSION['account_instance'] = $tmp_account;
		$_SESSION['account_loggedin'] = true;
	}

	redirect('../index.php');
	exit();

}

exit();
?>