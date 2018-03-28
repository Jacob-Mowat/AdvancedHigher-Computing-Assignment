<?php
/**
	File: Dashboard.class
**/

class Dashboard {
	public static function getDashboardForTeacher() {
		include_once "../dashboards/teacher.dashboard.php";
	}

	public static function getDashboardForTechnical() {
		include_once "../dashboards/technical.dashboard.php";
	}

	public static function getDashboardForManager() {
		include_once "../dashboards/manager.dashboard.php";
	}
}

?>
