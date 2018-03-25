<?php
include_once "autoload.php";

if(empty($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
}

$user = unserialize($_SESSION['account']);

if($_POST['submit']) {
	$job_title = $_POST['job_title'];
	$job_notes = $_POST['job_notes'];
	$job_status = "opened";
	$job_department = $_POST['job_department'];
	$job_submittedby = intval($user['id']);

	if(Job::createJob(
		$job_title,
		$job_notes,
		$job_status,
		$job_department,
		$job_submittedby,
		$database_connection
	)) {
		header("Location: dashboard.php");
		exit;
	} else {
		header("Location: jobs_create.php");
		exit;
	}
}	

getHeader();
?>

<div class="container">
	<div class="row">
		<div class="col col-sm-8 mx-auto">
			<h1>Add Job</h1>

			<form action="jobs_create.php" method="post" autocomplete="off">
				<div class="form-group">
					<label for="job_title">Title</label>
			    	<input type="text" class="form-control" name="job_title" id="job_title" placeholder="Title">
				</div>
				<div class="form-group">
					<label for="job_notes">Job Notes</label>
			    	<textarea class="form-control" name="job_notes" id="job_notes" placeholder="Notes"></textarea>
				</div>
				<div class="form-group">
					<label for="job_department">Department</label>
					<select class="form-control" id="job_department" name="job_department" size="8">
						<?php foreach (Account::$departments_list as $key => $value) { ?>
							<option value="<?=$key?>"><?=$value?></option>
						<?php } ?>
					</select>
				</div>
				<input type="submit" name="submit" class="btn btn-primary" value="Create Job" />
			</form>
		</div>
	</div>
</div>

<?php getFooter(); ?>