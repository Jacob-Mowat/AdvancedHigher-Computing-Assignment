<?php
include_once "autoload.php";

if(empty($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
}

$user = unserialize($_SESSION['account']);
$userid = intval($user['id']);

if(intval($user['type']) != ACCOUNT_TECHNICIAN) {
	header('Location: dashboard.php');
    exit;
}

getHeader();
?>

<div class="container">
	<div class="row">
		<div class="col col-sm-12 mx-auto">
			<?php
            $jobs = mysqli_query(
				$database_connection,
				"SELECT jobs.id, jobs.title, jobs.status, jobs.submitted_by, jobs.notes, assigned_jobs.id, assigned_jobs.technician_id, assigned_jobs.job_id
                FROM jobs, assigned_jobs
                WHERE jobs.status='closed'
                AND jobs.id=assigned_jobs.job_id
                AND assigned_jobs.technician_id={$userid}"
			);
			?>

			<h1>Your completed jobs</h1>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Title</th>
						<th scope="col">Status</th>
						<th scope="col">Submitted By</th>
						<th scope="col">Notes</th>
						<th scope="col">Closed On</th>
					</tr>
				</thead>
				<tbody>
					<?php while($job = mysqli_fetch_array($jobs)) {
						$username = Account::getUsernameByID($job['submitted_by'], $database_connection);
					?>
					<tr>
						<th scope="row"><?=$job['id'];?></th>
						<td><?=$job['title'];?></td>
						<td><?=$job['status'];?></td>
						<td><?=$username;?></td>
						<td><?=$job['notes'];?></td>
						<td><?=$job['completed_time'];?></td>
					</tr>
					<?php } ?>
                    <?php
                    if(mysql_num_rows($jobs) < 1) {
                        echo "<tr><p>You haven't completed any jobs yet...</p></tr>";
                    }
                    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php getFooter(); ?>.
