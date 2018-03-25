<?php
include_once "autoload.php";

if(empty($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
}

$user = unserialize($_SESSION['account']);

if(intval($user['type']) != ACCOUNT_MANAGER) {
	header('Location: dashboard.php');
    exit;
}

getHeader();

if($_POST['submit']) {
	$job_id = intval($_POST['job_id']);
	$manager_id = intval($_POST['manager_id']);
	$technician_id = intval($_POST['technician_id']);

	if(Job::assignJob(
		$job_id,
		$manager_id,
		$technician_id,
		$database_connection
	)) {
		header("Location: manager_jobpool.php");
		exit;
	} else {
		header("Location: manager_assignjob.php?id=" + $job_id);
		exit;
	}
}

?>

<div class="container">
	<div class="row">
		<div class="col col-sm-6 mx-auto">
			<?php

			if(!$_GET['id']) {
				header("Location: manager_jobpool.php");
				exit;
			}

			$technicians_query = mysqli_query(
				$database_connection,
				"SELECT * FROM `accounts` WHERE type=0"
			);
			?>

			<form action="manager_assignjob.php" method="post" autocomplete="off">	
				<div class="form-row">
					<input type="hidden" name="manager_id" value="<?=$user['id'];?>">
					<input type="hidden" name="job_id" value="<?=$_GET['id'];?>">
					<div class="form-group col-md-12">
						<label for="technician_id">Pick a technician</label>
						<select class="form-control" name="technician_id" id="technician_id" size="3">
							<?php while($row = mysqli_fetch_array($technicians_query)) { ?>
							<option value="<?=$row['id'];?>"><?=$row['username'];?> (<?=$row['firstname'];?> <?=$row['lastname'];?>)</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<input type="submit" name="submit" class="btn btn-primary" value="Assign" />
			</form>
		</div>
	</div>
</div>

<?php getFooter(); ?>.