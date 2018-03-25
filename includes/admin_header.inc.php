<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
 
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Ticket System - Admin</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo auto_version('assets/master.css'); ?>">

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script src="<?php echo auto_version('assets/main.js'); ?>" type="text/javascript"></script>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="/">KGS Ticket</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<?php if ($_SESSION['account_loggedin'] && $_SESSION['account_isadmin']) { ?>
				<li class="nav-item active">
					<a class="nav-link" href="#">Admin Dashboard<!-- <span class="sr-only">(current)</span> --></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Accounts</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Jobs Pool</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Assigned Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Finished Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="account_logout.php">Logout</a>
				</li>
			<?php } else { ?>
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <!-- <span class="sr-only">(current)</span> --></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="account_login.php">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="account_register.php">Register</a>
				</li>
			<?php } ?>
		</ul>
	</div>
</nav>

<div class="container">