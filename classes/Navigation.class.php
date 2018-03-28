<?php
/**
	File: Navigation.class
**/

class Navigation {
	public static function getTechnicalNavigation() {
		echo '
			<li class="nav-item active">
				<a class="nav-link" href="dashboard.php">Dashboard<!-- <span class="sr-only">(current)</span> --></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="technician_completed.php">Completed Jobs</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="account_logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
			</li>
		';
	}

	public static function getTeacherNavigation() {
		echo '
			<li class="nav-item active">
				<a class="nav-link" href="dashboard.php">Dashboard<!-- <span class="sr-only">(current)</span> --></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="jobs_create.php">Add Job</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="account_mydepartment.php">My Department</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="account_logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
			</li>
		';
	}

	public static function getManagerNavigation() {
		echo '
			<li class="nav-item active">
				<a class="nav-link" href="dashboard.php">Dashboard<!-- <span class="sr-only">(current)</span> --></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="manager_listaccounts.php">Accounts</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="manager_jobpool.php">Job Pool</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="manager_listassignedjobs.php">Assigned Jobs</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="account_logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
			</li>
		';
	}
}

?>
