<?php
/**
	File:	Renderer.class.php
**/

class Renderer 
{
	public static function redirectToPage($page) {
		header("Location: " + TEMPLATES_PATH . "pages/" . $page . ".php");
	}

	public static function renderPage($page)
	{
		include_once TEMPLATES_PATH . "pages/" . $page . ".php";
	}

	public static function renderView($view) 
	{
		include_once TEMPLATES_PATH . "views/" . $view . ".php";
	}

	public static function gotoPage($page)
	{
		$url = TEMPLATES_PATH . "pages/" . $page . ".php";
		header("Location: " + $url);
	}

}
?>