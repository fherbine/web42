<?php

class PostPicsManager
{

	public function createUsrImgPage($uid, $content, $iid)
	{
		if (!is_dir('public/user/'))
			mkdir('public/user/');
		$fpath = 'public/user/' . $uid . '-' . $iid . '.png';
		$file = fopen($fpath, 'w+');
		fwrite($file, $content);
		fclose($file);
		return $fpath;
	}

	public function deleteImg($uid, $iid)
	{
		$db = $this->dbConnect();

		try
		{
			$req = $db->prepare('DELETE FROM imgs WHERE id = ? AND uid = ?');
			$req->execute(array($iid, $uid));
		}
		catch(Exception $e)
		{
			echo 'an error occured ' . $e->getMessage();
		}
	}

	public function addImgtoDb($uid, $auth)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('INSERT INTO imgs(auth, uid, upload_date, rate, ncoms) VALUES(:auth, :uid, NOW(), :rate, :ncoms)');
			$req->execute(array(
				'auth' => htmlspecialchars($auth),
				'uid' => $uid,
				'rate' => 0,
				'ncoms' => 0
			));
		}
		catch (Exception $e)
		{
			echo 'an error occured during image uploading' . $e->getMessage();
		}
	}

	public function sendImg($content, $uid)
	{
		$db = $this->dbConnect();
		try
		{
			if (isset($_COOKIE['AddingPicID']))
				$iid = $_COOKIE['AddingPicID'];
			else 
				$iid = 0;
			$req = $db->query('SELECT MAX(id) AS iid FROM imgs');
			if ($iid == 0)
			{
				$iid = $req->fetch()['iid'];
				setcookie('initPicID', $iid);
			}
			else
				$iid = $iid + 1;
			setcookie('AddingPicID', $iid);
			return $this->createUsrImgPage($uid, $content, $iid);
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
			$req = $db->prepare('SELECT id, DATE_FORMAT(upload_date, \'%Y/%m/%d at %Hh%i\') AS up_date, rate, ncoms, uid FROM imgs WHERE auth = ? ORDER BY id DESC');
			$req->execute(array($user));
			if ($req->rowCount())
				$req_res = $req->fetchAll();
			$req_res['content'] = $req_res;
			$req_res['extras'] = $this->getUsrExtras($user);
			return $req_res;
		}
		catch (Exception $e)
		{
			echo "An error occured when tried to get datas: " . $e->getMessage();
		}

	}

	public function getAllImg($pagination)
	{
		$db = $this->dbConnect();
		$req_res = array();
		$x = $pagination - 1;
		try
		{
			$req = $db->query('SELECT id, DATE_FORMAT(upload_date, \'%Y/%m/%d at %Hh%i\') AS up_date, rate, ncoms, auth, uid FROM imgs ORDER BY id DESC LIMIT ' . ($x * 6) . ', ' . (($x * 6) + 6));
			if ($req->rowCount())
				$req_res = $req->fetchAll();
			else
			{
				setcookie('pagination', 1);
				echo "tutu";
				header('Location: index.php');
			}
			return $req_res;
		}
		catch (Exception $e)
		{
			echo "An error occured when tried to get datas: " . $e->getMessage();
		}

	}

	private function getUsrExtras($user)
	{
		$db = $this->dbConnect();

		try
		{
			$req = $db->prepare('SELECT SUM(rate) AS u_rate FROM imgs WHERE auth = ?');
			$req->execute(array($user));
			if ($req->rowCount())
				$res['urates'] = $req->fetch();
			$req2 = $db->prepare('SELECT pseudo, sumup, location FROM passwd WHERE pseudo = ?');
			$req2->execute(array($user));
			if ($req2->rowCount())
				$res['infos'] = $req2->fetch();
			return $res;
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