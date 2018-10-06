<?php
class SetupManager
{
	public function buildTbl()
	{
		$this->createTabs();
	}

	private function createTabs()
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->query('CREATE TABLE `passwd` ( `id` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(255) NOT NULL , `passwd` VARCHAR(255) NOT NULL , `pseudo` VARCHAR(255) NOT NULL , `sign_date` DATETIME NOT NULL , `notif` INT NOT NULL , `sumup` TEXT NOT NULL , `location` VARCHAR(255) NOT NULL , `confirm` INT NOT NULL , `confirm_key` VARCHAR(32) NOT NULL , PRIMARY KEY (`id`))');
			if (!$req)
				die('An error occured during db table creation');
			$req = $db->query('CREATE TABLE `imgs` ( `id` INT NOT NULL , `auth` VARCHAR(255) NOT NULL , `uid` INT NOT NULL , `upload_date` DATETIME NOT NULL , `rate` INT NOT NULL , `ncoms` INT NOT NULL )');
			if (!$req)
				die('An error occured during db table creation');
			$req = $db->query('CREATE TABLE `img_vote` ( `img_id` INT NOT NULL , `uid` INT NOT NULL )');
			if (!$req)
				die('An error occured during db table creation');
			$req = $db->query('CREATE TABLE `img_com` ( `id` INT NOT NULL AUTO_INCREMENT , `img_id` INT NOT NULL , `date_com` DATETIME NOT NULL , `auth` VARCHAR(255) NOT NULL , `content` TEXT NOT NULL , `rate` INT NOT NULL , PRIMARY KEY (`id`))');
			if (!$req)
				die('An error occured during db table creation');
		}
		catch(Exception $e)
		{
			header('Location: ../index.php?msg=Tables already exist !');
			exit();
		}
		header('Location: ../index.php?msg=Done !');
		exit();
	}
	private function dbConnect()
	{
		include('database.php');
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

$toExec =  new SetupManager();

if (isset($_GET['action']))
{
	if ($_GET['action'] === "Build")
		$toExec->buildTbl();
}
header('Location: ../index.php?msg=Nothing can be done !');