<?php
class Job 
{

	public static function createJob(
		$job_title,
		$job_notes,
		$job_status,
		$job_department,
		$job_submittedby,
		$dc
	){
		$q = mysqli_query(
			$dc, 
			"INSERT INTO jobs (id, title, notes, status, department, submitted_by) VALUES (NULL, '{$job_title}', '{$job_notes}', '{$job_status}', '{$job_department}', '{$job_submittedby}')");
		return true;
	}

	public static function assignJob(
		$job_id,
		$manager_id,
		$technician_id,
		$database_connection
	) {
		$assign_query = mysqli_query(
			$database_connection,
			"INSERT INTO `assigned_jobs` (technician_id, manager_id, job_id) VALUES ('{$technician_id}', '{$manager_id}', '{$job_id}')"
		);
		$job_update_query = mysqli_query(
			$database_connection,
			"UPDATE `jobs` SET status='assigned' WHERE id='{$job_id}'"
		);
		return true;
	}

}
?>