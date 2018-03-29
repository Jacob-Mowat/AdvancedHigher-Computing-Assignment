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
?>

<div class="container">
	<div class="row">
		<div class="col col-sm-12 mx-auto">
			<?php
			$jobs = mysqli_query(
				$database_connection,
				"SELECT * FROM jobs WHERE status='opened'"
			);
			?>

			<h1>Job Pool</h1>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Title</th>
						<th scope="col">Status</th>
						<th scope="col">Submitted By</th>
						<th scope="col">Notes</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php while($job = mysqli_fetch_array($jobs)) {
						$username = Account::getUsernameByID($job['submitted_by'], $database_connection);
                        $note = mb_strimwidth(Job::processNotes($job['notes'])[0]['note'], 0, 20, "...");
					?>
					<tr>
						<th scope="row"><?=$job['id'];?></th>
						<td><?=$job['title'];?></td>
						<td><?=$job['status'];?></td>
						<td><?=$username;?></td>
						<td><?=$note?></td>
						<td><a href="manager_assignjob.php?id=<?=$job['id'];?>"> assign </a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php getFooter(); ?>.
