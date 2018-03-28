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

    if($_POST['submit_newnote']) {
        $newnote = $_POST['newnote'];

        Job::addNoteToJob($jobid, $user['username'], $newnote, $database_connection);
    }

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
        					Status: <?=$job['status']?> <a class="float-right" href="jobs_close.php?id=<?=$jobid?>"><i class="fas fa-check"></i></a>
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
                        </a>
                        <?php } ?>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <small><?=Job::processNoteTime($note[0])?></small> -->
                        </div>
                        <p class="mb-1">
                            <form action="jobs_view.php" method="post" autocomplete="off">
                				<div class="form-group">
                					<label for="newnote"></label>
                			    	<textarea class="form-control" name="newnote" id="newnote" placeholder="Notes"></textarea>
                				</div>
                				<input type="submit" name="submit_newnote" class="btn btn-primary" value="Send" />
                			</form>
                        </p>
                        </a>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

<?php getFooter(); ?>
