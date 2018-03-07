<?php 
include_once "../core/setup.php"; 
$Renderer->getHeader();
?>

<div class="container">
	<h1>The content goes here.</h1>
</div>

<?php $Renderer->renderView('LoginForm'); ?>


<?php
$Renderer->getFooter();
?>