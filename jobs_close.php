<?php
include_once "autoload.php";

if(empty($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
}

/*
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Make this page only available to ACCOUNT_TECHNICIAN and ACCOUNT_MANAGER
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
*/

$user = unserialize($_SESSION['account']);

if($_GET['id']) {
    $job_id = $_GET['id'];
} else {
    header("Location: dashboard.php");
    exit;
}

if($_POST['submit_closejob']) {

	if(Job::closeJob(
		$job_id,
        $user['username'],
		$database_connection
	)) {
		header("Location: dashboard.php");
		exit;
	} else {
		header("Location: jobs_close.php?id=".$job_id);
		exit;
	}
}

getHeader();
?>

<div class="container">
	<div class="row">
		<div class="col col-sm-8 mx-auto">
			<h1>Close Job</h1>

			<form action="jobs_close.php?id=<?=$job_id?>" method="post" autocomplete="off">
				<p>Are you sure you want to close this job?</p>
				<input type="submit" name="submit_closejob" class="btn btn-primary" value="Yes" />
			</form>
		</div>
	</div>
</div>

<?php getFooter(); ?>
