<?php
ob_start();
include "autoload.php";
?>

<?php
if($_POST['submit']) {
	$username_untrusted = trim(strip_tags(stripslashes($_POST['username'])));
	$password_untrusted = trim(strip_tags(stripslashes($_POST['password'])));
	$passwordconfirm_untrusted = trim(strip_tags(stripslashes($_POST['passwordconfirm'])));
	$email_untrusted = trim(strip_tags(stripslashes($_POST['email'])));
	$firstname_untrusted = trim(strip_tags(stripslashes($_POST['firstname'])));
	$lastname_untrusted = trim(strip_tags(stripslashes($_POST['lastname'])));
	$usertype_untrusted = trim(strip_tags(stripslashes($_POST['usertype'])));
	$department_untrusted = trim(strip_tags(stripslashes($_POST['department'])));

	if(Account::register(
		$username_untrusted,
		$password_untrusted,
		$passwordconfirm_untrusted,
		$email_untrusted,
		$firstname_untrusted,
		$lastname_untrusted,
		$usertype_untrusted,
		$department_untrusted,
		$database_connection
	)) {
		$_SESSION['account'] = serialize(Account::getAccount($username_untrusted, $password_untrusted, $database_connection));
		$_SESSION['account_loggedin'] = true;

		header('Location: dashboard.php');
		exit;
	} else {
		header('Location: account_register.php');
		exit;
	}
} else {
?>

<?php getHeader(); ?>
<div class="container">
	<div class="row">
		<div class="col col-sm-6 mx-auto">
			<h1>Register</h1>
			<form action="account_register.php" method="post" autocomplete="off">

				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" id="username" placeholder="Username">
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" name="email" id="email" placeholder="Email">
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
					</div>
					<div class="form-group col-md-6">
						<label for="passwordconfirm">Confirm Password</label>
						<input type="password" class="form-control" name="passwordconfirm" id="passwordconfirm" placeholder="Enter password again">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="firstname">First Name</label>
						<input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
					</div>
					<div class="form-group col-md-6">
						<label for="lastname">Last Name</label>
						<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="usertype">Account Type</label>
						<select class="form-control" name="usertype" id="usertype" size="3">
							<option value="technician">Technician</option>
							<option value="teacher">Teacher</option>
							<option value="management">Management</option>
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="department">Department</label>
						<select class="form-control" id="department" name="department" size="3">
							<?php foreach (Account::$departments_list as $key => $value) { ?>
								<option value="<?=$key?>"><?=$value?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<input type="submit" name="submit" class="btn btn-primary" value="Register" />
			</form>
		</div>
	</div>
</div>
<?php getFooter(); ?>

<?php }?>
