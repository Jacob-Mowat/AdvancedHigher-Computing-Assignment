<?php
/**
	File:	System.class
**/

function getHeader() {
	include "includes/header.inc.php";
}

function getAdminHeader() {
	include "includes/admin_header.inc.php";
}

function getFooter() {
	include "includes/footer.inc.php";
}

function auto_version($file)
{
  if(strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file))
    return $file;

  $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
  return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
}
?>