<?php
/**
	File:	Database.class
**/

class DatabasePlug extends PDO
{
	public function __construct( $database_settings )	
	{
		$dns = $database_settings["driver"] . 
				":host=" . $database_settings["host"] . 
				((!empty($database_settings["port"])) ? (";port=" . $database_settings["port"]) : "") .
				";dbname=" . $database_settings["schema"];

				parent::__construct($dns, $database_settings["username"], $database_settings["password"]);
	}
}

?>