<?php
/**
	File:	Renderer.class.php
**/

class Renderer 
{

	public function renderPage($page)
	{
		include_once TEMPLATES_PATH . "pages/" . $page . ".php";
	}

	public function renderView($view) 
	{
		include_once TEMPLATES_PATH . "views/" . $view . ".php";
	}

	public static function getHeader()
	{
		include_once TEMPLATES_PATH . "core/header.php";
	}

	public static function getFooter()
	{
		include_once TEMPLATES_PATH . "core/footer.php";
	}

}

?>