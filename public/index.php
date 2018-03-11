<?php 
require_once "../core/setup.php"; 
$Renderer->getHeader();
?>

<div class="container">
	<h1>The content goes here.</h1>

	<?php if($_SESSION["login_verified"]) { ?>

		LOGGED IN!

		<?php } ?>
</div>

<?php $Renderer->renderView('LoginForm'); ?>


<?php
$Renderer->getFooter();
?>