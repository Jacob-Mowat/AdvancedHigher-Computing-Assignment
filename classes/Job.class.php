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
		$job_note_formatted = Job::initalizeJobNotes($job_submittedby, $job_notes);
		$q = mysqli_query(
			$dc,
			"INSERT INTO jobs (id, title, notes, status, department, submitted_by) VALUES (NULL, '{$job_title}', '{$job_note_formatted}', '{$job_status}', '{$job_department}', '{$job_submittedby}')"
		);
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

	public static function processNotes($notes) {
		return unserialize($notes);
	}

	public static function processNoteTime($note_time) {
		return $note_time;
	}

	public static function initalizeJobNotes($username, $note) {
		$notes_array = array();
		array_push($notes_array, array(
			"time" => time(),
			"username" => $username,
			"note" => $note
		));
		return serialize($notes_array);
	}

	public static function addNoteToJob($job_id, $username, $note, $database_connection) {
		$job_notes_query = mysqli_query(
			$database_connection,
			"SELECT notes FROM jobs WHERE id={$job_id}"
		);
		$notes_array = unserialize(mysqli_fetch_array($job_notes_query));
		$note_holder = array(
			"time" => time(),
			"username" => $username,
			"note" => $note
		);
		array_push($notes_array, $note_holder);
		$ser = serialize($notes_array);
		$note_query = mysqli_query(
			$database_connection,
			"INSERT INTO jobs (notes) VALUES ('{$ser}') WHERE id={$job_id}"
		);
	}
}
?>
