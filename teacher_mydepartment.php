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
			$q = mysqli_query($database_connection, "SELECT * FROM `jobs` WHERE department='{$userdepartment}'");
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
					<?php while($row = mysqli_fetch_array($q)) { 
						$username = Account::getUsernameByID($row['submitted_by'], $database_connection);
					?>
					<tr>
						<th scope="row"><?=$row['id'];?></th>
						<td><?=$row['title'];?></td>
						<td><?=$row['status'];?></td>
						<td><?=$username;?></td>
						<td><?=$row['notes'];?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php getFooter(); ?>