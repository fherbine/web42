<?php

class PostPicsManager
{

	public function sendImg($content, $auth)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('INSERT INTO imgs(auth, upload_date, content, rate, ncoms) VALUES(:auth, NOW(), :content, :rate, :ncoms)');
			$req->execute(array(
				'auth' => $auth,
				'content' => $content,
				'rate' => 0,
				'ncoms' => 0
			));
		}
		catch (Exception $e)
		{
			die('an error occured during image uploading');
		}
	}

	private function dbConnect()
	{
		include('config/database.php');
		try
		{
			$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		}
		catch(PDOException $e)
		{
			die('An error occured during the db connection : ' . $e->getMessage());
		}
	}
}