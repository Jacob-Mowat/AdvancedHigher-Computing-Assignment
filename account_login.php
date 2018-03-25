<?php 
ob_start();
include "autoload.php"; 
?>

<?php
if($_POST['submit']) {
	$username_untrusted = trim(strip_tags(stripslashes($_POST['username'])));
	$password_untrusted = trim(strip_tags(stripslashes($_POST['password'])));

	if(Account::login($username_untrusted, $password_untrusted, $database_connection)) {
		$_SESSION['account'] = serialize(Account::getAccount($username_untrusted, $password_untrusted, $database_connection));
		$_SESSION['account_loggedin'] = true;
		exit(header('Location: dashboard.php'));
	} else {
		exit(header('Location: account_login.php'));
	}
} else {
?>

<?php getHeader(); ?>
<div class="container">
	<div class="row">
		<div class="col col-sm-6 mx-auto">
			<h1>Login</h1>
			<form action="account_login.php" method="post" autocomplete="off">
				<div class="form-group">
					<label for="username">Username</label>
			    	<input type="text" class="form-control" name="username" id="username" placeholder="Username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
			    	<input type="password" class="form-control" name="password" id="password" placeholder="Password">
				</div>
				<input type="submit" name="submit" class="btn btn-primary" value="Login" />
			</form>

<?php getFooter(); ?>

<?php } ?>