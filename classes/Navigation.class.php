<?php
/**
	File: Navigation.class
**/

class Navigation {
	public static function getTechnicalNavigation() {
		echo '
			<li class="nav-item">
				<a class="nav-link" href="technician_completed.php"><i class="fas fa-check"></i> Completed Jobs</a>
			</li>
		';
	}

	public static function getTeacherNavigation() {
		echo '
			<li class="nav-item">
				<a class="nav-link" href="jobs_create.php"><i class="fas fa-plus"></i> Add Job</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="account_mydepartment.php"><i class="fas fa-building"></i> My Department</a>
			</li>
		';
	}

	public static function getManagerNavigation() {
		echo '
			<li class="nav-item">
				<a class="nav-link" href="manager_listaccounts.php">Accounts</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="manager_jobpool.php">Job Pool</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="manager_listassignedjobs.php">Assigned Jobs</a>
			</li>
		';
	}
}

?>
