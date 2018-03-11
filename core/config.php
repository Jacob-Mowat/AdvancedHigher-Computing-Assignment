<?php
$config = array(
	"db" => array(
		"main" => array(
			"driver" => "mysql",
			"schema" => "kgscomps_main",
			"username" => "kgscomps_root",
			"password" => "b2c3f1k91212",
			"host" => "kgscompsci.kirkwallgrammarschool.highercomputingscience.org",
			"charset" => "utf8",
			"options" => [
			    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]
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
		"library" => $_SERVER["DOCUMENT_ROOT"] . "/lib/"
	),
	"debug_mode" => true,
	"site_title" => "Ticket System",
	"build_classes" => array(
		"Renderer",
		"Account",
		// "DatabasePlug"
		// "Job",
		// "Team",
		// "Management"
	)
);
?>