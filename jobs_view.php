<?php
include_once "autoload.php";

if(empty($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
}

$user = unserialize($_SESSION['account']);

if(!empty($_GET['id'])) {
    $jobid = $_GET['id'];
    $job_query = mysqli_query(
        $database_connection,
        "SELECT * from jobs WHERE id='{$jobid}'"
    );

    $job = $job_query->fetch_array(MYSQLI_ASSOC);
    $notes = Job::processNotes($job['notes']);   // Process the notes into an array.
} else {
    header("Location: dashboard.php");
    exit;
}

getHeader();
?>

<div class="container">
	<div class="row">
		<div class="col col-sm-12">
            <div class="row">
                <div class="col col-sm-6">
                    <ul class="list-group">
                        <h2><?=$job['title']?></h2>
        				<li class="list-group-item">
        					Status: <?=$job['status']?>
        				</li>
        				<li class="list-group-item">
        					Department: <?=$job['department']?>
        				</li>
        			</ul>
                </div>
                <div class="col col-sm-6">
                    <br>
                    <br>
                    <div class="list-group">
                        <?php foreach($notes as $note) { ?>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?=$note[1]?></h5>
                            <small><?=Job::processNoteTime($note[0])?></small>
                        </div>
                        <p class="mb-1"><?=$note[2]?></p>
                        <!-- <small>N/A</small> -->
                        </a>
                        <?php } ?>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <!-- <h5 class="mb-1">Sen</h5>
                            <small><?=Job::processNoteTime($note[0])?></small> -->
                        </div>
                        <p class="mb-1">
                        <form action="jobs_create.php" method="post" autocomplete="off">
            				<div class="form-group">
            					<label for="job_notes"></label>
            			    	<textarea class="form-control" name="job_notes" id="job_notes" placeholder="Notes"></textarea>
            				</div>
            				<input type="submit" name="submit" class="btn btn-primary" value="Send" />
            			</form>
                        </p>
                        <!-- <small>N/A</small> -->
                        </a>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

<?php getFooter(); ?>
