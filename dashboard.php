<?php
include_once "autoload.php";

if(empty($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
}

$user = unserialize($_SESSION['account']);
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
				"SELECT * FROM jobs WHERE status='assigned'"
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
					?>
					<tr>
						<th scope="row"><?=$job['id'];?></th>
						<td><?=$job['title'];?></td>
						<td><?=$job['status'];?></td>
						<td><?=$username;?> (<?=$fullname;?>)</td>
						<td><?=$job['notes'];?></td>
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
			<h2>Your jobs for today:</h2>
			<!-- Echo out all jobs for technicians-->
		</div>
	</div>
</div>

<?php } else if($dashboard == 2) {	//	Manager Dashboard ?>

<div class="container">
	<div class="row">
		<div class="col col-sm-12 mx-auto">
		</div>
	</div>
</div>

<?php } ?>

<?php getFooter(); ?>