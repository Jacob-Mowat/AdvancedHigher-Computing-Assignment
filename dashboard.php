<?php
include_once "autoload.php";

if(empty($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
}

$user = unserialize($_SESSION['account']);
$userid = intval($user['id']);
switch(intval($user['type'])) {
	case 0:
		$dashboard = 0;
		break;
	case 1:
		$dashboard = 1;
		break;
	case 2:
		$dashboard = 2;
		break;
	case 3:
		exit(header("Location: admin_dashboard.php"));
}
getHeader();
?>

<?php if($dashboard == 0) {	//	Technical Dashboard ?>

<div class="container">
	<div class="row">
		<div class="col col-sm-4 mx-auto">
			<h3>Your Profile</h3>
			<hr>
			<ul class="list-group">
				<li class="list-group-item">
					Username: <?=$user['username'];?>
				</li>
				<li class="list-group-item">
					Full-name: <?=$user['firstname'];?> <?=$user['lastname'];?>
				</li>
			</ul>
		</div>
		<div class="col col-sm-8 mx-auto">
			<h3>Your jobs for today:</h3>
			<hr>
			<?php
			$jobs = mysqli_query(
				$database_connection,
				"SELECT jobs.id AS jobid, jobs.title, jobs.status, jobs.submitted_by, jobs.notes, assigned_jobs.id, assigned_jobs.technician_id, assigned_jobs.job_id
                FROM jobs, assigned_jobs
                WHERE jobs.status='assigned'
                AND jobs.id=assigned_jobs.job_id
                AND assigned_jobs.technician_id={$userid}"
			);
			?>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Title</th>
						<th scope="col">Status</th>
						<th scope="col">Submitted By</th>
						<th scope="col">Notes</th>
					</tr>
				</thead>
				<tbody>
					<?php while($job = mysqli_fetch_array($jobs)) {
						$username = Account::getUsernameByID($job['submitted_by'], $database_connection);
						$fullname = Account::getFullnameByID($job['submitted_by'], $database_connection);
                        $note = mb_strimwidth(Job::processNotes($job['notes'])[0]['note'], 0, 20, "...");
					?>
					<tr class='clickable-row' data-href="<?php echo "jobs_view.php?id={$job['jobid']}";?>">
						<th scope="row"><?=$job['jobid'];?></th>
						<td><?=$job['title'];?></td>
						<td><?=$job['status'];?></td>
						<td><?=$username;?> (<?=$fullname;?>)</td>
						<td><?=$note?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php } else if($dashboard == 1) {	//	Teacher Dashboard ?>

<div class="container">
	<div class="row">
		<div class="col col-sm-4 mx-auto">
			<h2>Your Profile</h2>
			<ul class="list-group">
				<li class="list-group-item">
					<?=$user['username'];?>
				</li>
				<li class="list-group-item">
					<?=$user['firstname'];?> <?=$user['lastname'];?>
				</li>
				<li class="list-group-item">
					<?=Account::$departments_list[$user['department']];?>
				</li>
			</ul>
		</div>
        <div class="col col-sm-8 mx-auto">
			<h3>Your job history</h3>
			<hr>
			<?php
			$jobs = mysqli_query(
				$database_connection,
				"SELECT jobs.id AS jobid, jobs.title, jobs.status, jobs.submitted_by, jobs.notes, assigned_jobs.technician_id
                FROM jobs, assigned_jobs
                WHERE jobs.submitted_by={$userid}"
			);
			?>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Title</th>
						<th scope="col">Status</th>
						<th scope="col">Notes</th>
                        <th scope="col">Technician</th>
					</tr>
				</thead>
				<tbody>
					<?php while($job = mysqli_fetch_array($jobs)) {
						$tech_username = Account::getUsernameByID($job['technician_id'], $database_connection);
						$tech_fullname = Account::getFullnameByID($job['technician_id'], $database_connection);
                        $note = mb_strimwidth(Job::processNotes($job['notes'])[0]['note'], 0, 20, "...");
					?>
					<tr class='clickable-row' data-href="<?php echo "jobs_view.php?id={$job['jobid']}";?>">
						<th scope="row"><?=$job['jobid'];?></th>
						<td><?=$job['title'];?></td>
						<td><?=$job['status'];?></td>
						<td><?=$note?></td>
                        <td><?=$tech_username?>(<?=$tech_fullname?>)</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php } else if($dashboard == 2) {	//	Manager Dashboard ?>

    <div class="container">
    	<div class="row">
    		<div class="col col-sm-4 mx-auto">
    			<h2>Your Profile</h2>
    			<ul class="list-group">
    				<li class="list-group-item">
    					<?=$user['username'];?>
    				</li>
    				<li class="list-group-item">
    					<?=$user['firstname'];?> <?=$user['lastname'];?>
    				</li>
    				<li class="list-group-item">
    					<?=Account::$departments_list[$user['department']];?>
    				</li>
    			</ul>
    		</div>
            <div class="col col-sm-8 mx-auto">
    			<h3>Assigned jobs history</h3>
    			<hr>
    			<?php
    			$jobs = mysqli_query(
    				$database_connection,
    				"SELECT jobs.id AS jobid, jobs.title, jobs.status, jobs.submitted_by, jobs.notes, assigned_jobs.technician_id
                    FROM jobs, assigned_jobs
                    WHERE jobs.id=assigned_jobs.job_id
                    AND assigned_jobs.manager_id={$userid}"
    			);
    			?>
    			<table class="table">
    				<thead>
    					<tr>
    						<th scope="col">ID</th>
    						<th scope="col">Title</th>
    						<th scope="col">Status</th>
    						<th scope="col">Notes</th>
                            <th scope="col">Teacher</th>
                            <th scope="col">Technician</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php while($job = mysqli_fetch_array($jobs)) {
                            $teacher_username = Account::getUsernameByID($job['submitted_by'], $database_connection);
                            $tech_username = Account::getUsernameByID($job['technician_id'], $database_connection);
                            $teacher_fullname = Account::getFullnameByID($job['submitted_by'], $database_connection);
                            $tech_fullname = Account::getFullnameByID($job['technician_id'], $database_connection);
                            $note = mb_strimwidth(Job::processNotes($job['notes'])[0]['note'], 0, 20, "...");
    					?>
    					<tr class='clickable-row' data-href="<?php echo "jobs_view.php?id={$job['jobid']}";?>">
    						<th scope="row"><?=$job['jobid'];?></th>
    						<td><?=$job['title'];?></td>
    						<td><?=$job['status'];?></td>
    						<td><?=$note?></td>
                            <td><?=$teacher_username?>(<?=$teacher_fullname?>)</td>
                            <td><?=$tech_username?>(<?=$tech_fullname?>)</td>
    					</tr>
    					<?php } ?>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>

<?php } ?>

<?php getFooter(); ?>
