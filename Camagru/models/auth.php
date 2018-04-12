<?php
function db_auth()
{
	$require('../config/database.php');
	try
	{
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	}
	catch (PDOException $e)
	{
		echo 'Connection failed : ' . $e->getMessage();
	}
}