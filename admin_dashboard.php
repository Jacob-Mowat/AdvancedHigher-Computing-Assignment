<?php
include_once "autoload.php";

$user = unserialize($_SESSION['account']);

if(empty($_SESSION['account_loggedin'])) {
    header('Location: index.php');
    exit;
} else if (Account::isAdmin($user['username'], $database_connection) != true) {
	// header('Location: index.php');
	// exit;
}

getAdminHeader();

?>
This is the dashboard

<?php getFooter(); ?>