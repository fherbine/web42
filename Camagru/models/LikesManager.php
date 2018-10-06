<?php

class LikesManager
{

	public function sendMail($to, $subject, $content)
	{
		mail($to, $subject, $content);
	}

	public function getPicAuthMail($iid)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('SELECT auth FROM imgs WHERE id = ?');
			$req->execute(array($iid));
			$res = $req->fetch();

			$req = $db->prepare('SELECT email, notif FROM passwd WHERE pseudo = ?');
			$req->execute(array($res['auth']));
			$ret = $req->fetch();
			if ($ret['notif'] == 0)
				return false;
			return $ret['email'];
		}
		catch(Exception $e)
		{
			echo "An error occured : ". $e->getMessage();
		}
	}

	public function sendLikeNotif($iid)
	{
		$to = $this->getPicAuthMail($iid);
		$subject = "New like on PhotoBooth 42 !";
		$content = "Congrats !
		Someone has just liked one of your photos !";
		if ($to)
			$this->sendMail($to, $subject, $content);
	}

	public function checkUsrLike($uid, $img_id)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('SELECT * FROM img_vote WHERE uid = :uid AND img_id = :img_id');
			$req->execute(array(
				'uid' => $uid,
				'img_id' => $img_id
			));
			if ($req->rowCount())
				return True;
			else
				return False;
		}
		catch (Exception $e)
		{
			echo "An error occured" . $e->getMessage();
		}
	}

	public function addUsrLike($uid, $img_id)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('INSERT INTO img_vote(img_id, uid) VALUES(:img, :uid)');
			$req->execute(array(
				'uid' => $uid,
				'img' => $img_id
			));
			try
			{
				$req2 = $db->prepare('UPDATE imgs SET rate = (rate + 1) WHERE id = ?');
				$req2->execute(array($img_id));
				$this->sendLikeNotif($img_id);
				header("Location: index.php");
			}
			catch (Exception $e)
			{
				echo "An error occured : ". $e->getMessage();
			}
		}
		catch (Exception $e)
		{
			echo "An error occured" . $e->getMessage();
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