<?php
include_once "autoload.php";

if(empty($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
}

$user = unserialize($_SESSION['account']);

getHeader();
?>

<div class="container">
	<div class="row">
		<div class="col col-sm-12 mx-auto">
			<?php
			$q = mysqli_query($database_connection, "SELECT * FROM `accounts`");
			?>

			<h1>All Accounts</h1>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Username</th>
						<th scope="col">Firstname</th>
						<th scope="col">Lastname</th>
						<th scope="col">Email</th>
						<th scope="col">Account Type</th>
						<th scope="col">Department</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = mysqli_fetch_array($q)) { ?>
					<tr>
						<th scope="row"><?=$row['id'];?></th>
						<td><?=$row['username'];?></td>
						<td><?=$row['firstname'];?></td>
						<td><?=$row['lastname'];?></td>
						<td><?=$row['email'];?></td>
						<td><?=$row['type'];?></td>
						<td><?=$row['department'];?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php getFooter(); ?>