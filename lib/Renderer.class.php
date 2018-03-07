<?php
/**
	File:	Renderer.class.php
	Definitions:
		-->	Page
**/

class Page 
{
	private $page_location;
	private $page_title;
	
	public function __construct($loc, $title) 
	{
		$this->page_location = $loc;
		$this->page_title = $title;
	}

}

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