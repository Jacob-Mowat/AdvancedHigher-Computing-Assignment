<?php 
require_once "../core/setup.php"; 
$Renderer->getHeader();
?>

<div class="container">
	<h1>The content goes here.</h1>

	<?php if($_SESSION["login_verified"] == true) { ?>
		<p>LOGGED IN!</p>
	<?php } else { ?>
		<?php $Renderer->renderView('LoginForm'); ?>
	<?php } ?>
</div>


<?php
$Renderer->getFooter();
?>