<?php

$config = array(
	"db" => array(
		"main" => array(
			"driver" => "mysql",
			"schema" => "kgscomps_main",
			"username" => "kgscomps_root",
			"password" => "b2c3f1k91212",
			"host" => "kgscompsci.kirkwallgrammarschool.highercomputingscience.org",
		)
	),
	"urls" => array(
		"rootURL" => "http://kgscompsci.kirkwallgrammarschool.highercomputingscience.org"
	),
	"paths" => array(
		"resources" => $_SERVER["DOCUMENT_ROOT"] . "/resources",
		"images" => array(
			"page_content" => $_SERVER["DOCUMENT_ROOT"] . "/resources/images/page_content/",
			"job_images" => $_SERVER["DOCUMENT_ROOT"] . "/resources/images/job_images/",
		),
		"templates" => $_SERVER["DOCUMENT_ROOT"] . "/resources/templates/",
		"library" => $_SERVER["DOCUMENT_ROOT"] . "/lib/",
	),
	"debug_mode" => true,
	"site_title" => "Ticket System",
	"build_classes" => array(
		"Renderer",
		"Account",
		"DatabasePlug"
		// "Job",
		// "Team",
		// "Management"
	)
);

defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", $config["paths"]["library"]);

defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", $config["paths"]["templates"]);

// 	Enable all error reporting since 

switch ($config["debug_mode"]) {
	case true:
		ini_set("error_reporting", "true");
		error_reporting(E_ALL|E_STRCT);
		break;
	case false:
		ini_set("error_reporting", "false");
		// error_rporting(E_|E_STRCT);
		break;
	default:
		break;
}

require_once LIBRARY_PATH . "UserDefined.php";

foreach ($config["build_classes"] as $key => $value) 
{
	req_class($value);
}

$Renderer = new Renderer();

$DatabasePlug = new DatabasePlug($config["db"]["main"]);

