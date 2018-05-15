<?php

class PostPicsManager
{

	public function sendImg($content, $auth, $uid)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('INSERT INTO imgs(auth, uid, upload_date, content, rate, ncoms) VALUES(:auth, :uid, NOW(), :content, :rate, :ncoms)');
			$req->execute(array(
				'auth' => $auth,
				'uid' => $uid,
				'content' => $content,
				'rate' => 0,
				'ncoms' => 0
			));
		}
		catch (Exception $e)
		{
			echo 'an error occured during image uploading' . $e->getMessage();
		}
	}

	public function getUsrImg($user)
	{
		$db = $this->dbConnect();
		$req_res = array();
		try
		{
			$req = $db->prepare('SELECT id, DATE_FORMAT(upload_date, \'%Y/%m/%d at %Hh%i\') AS up_date, content, rate, ncoms FROM imgs WHERE auth = ? ORDER BY id DESC');
			$req->execute(array($user));
			if ($req->rowCount())
				$req_res = $req->fetchAll();
			return $req_res;
		}
		catch (Exception $e)
		{
			echo "An error occured when tried to get datas: " . $e->getMessage();
		}

	}

	public function getAllImg()
	{
		$db = $this->dbConnect();
		$req_res = array();
		try
		{
			$req = $db->query('SELECT id, DATE_FORMAT(upload_date, \'%Y/%m/%d at %Hh%i\') AS up_date, content, rate, ncoms, auth FROM imgs ORDER BY id DESC');
			if ($req->rowCount())
				$req_res = $req->fetchAll();
			return $req_res;
		}
		catch (Exception $e)
		{
			echo "An error occured when tried to get datas: " . $e->getMessage();
		}

	}

	private function getUsrRates($user)
	{
		$db = $this->dbConnect();

		try
		{
			$req = $db->prepare('SELECT SUM(rate) AS u_rate FROM imgs WHERE auth = ?');
			$req->execute(array($user));
			return $req->fetch();
		}
		catch (Exception $e)
		{
			echo "An error occured!" . $e;
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
			echo 'An error occured during the db connection : ' . $e->getMessage();
		}
	}
}