<?php
include_once "autoload.php";

if(empty($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
}

$user = unserialize($_SESSION['account']);
$userdepartment = $user['department'];

getHeader();
?>

<h1>My Department</h1>

<div class="container">
	<div class="row">
		<div class="col col-sm-12 mx-auto">
			<?php
			$jobs = mysqli_query($database_connection, "SELECT * FROM `jobs` WHERE department='{$userdepartment}' AND status!='closed'");
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
                        $note = mb_strimwidth(Job::processNotes($job['notes'])[0][2], 0, 20, "...");
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

<?php getFooter(); ?>
