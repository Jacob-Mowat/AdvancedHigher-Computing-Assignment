<?php
include_once "autoload.php";

if(!empty($_SESSION['account_loggedin'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<?php getHeader(); ?>
The is the index file

<p>Welcome to the KGS Ticket system</p>

<?php getFooter(); ?>
