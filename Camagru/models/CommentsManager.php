<?php
class CommentsManager
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

	public function sendComNotif($iid)
	{
		$to = $this->getPicAuthMail($iid);
		$subject = "New comment on PhotoBooth 42 !";
		$content = "Someone has just wrote a comment on one of your photos !";
		if ($to)
			$this->sendMail($to, $subject, $content);
	}

	public function getImgCom($img_id, $all)
	{
		$db = $this->dbConnect();
		$com_tab = array();
		// echo 'tutu: |' . $img_id . '| ' . $all. '<br/>';

		try
		{
			// echo "toto";
			if ($all)
				$req = $db->prepare('SELECT id, DATE_FORMAT(date_com, \'%Y/%m/%d at %Hh%i\') AS d_com, auth, content, rate FROM img_com WHERE img_id = ?');
			else
				$req = $db->prepare('SELECT id, DATE_FORMAT(date_com, \'%m/%d at %Hh\') AS d_com, auth, content, rate FROM img_com WHERE img_id = ? ORDER BY id DESC LIMIT 5');
			$req->execute(array($img_id));
			$com_tab = $req->fetchAll();
			// var_dump($com_tab);
		}
		catch(Exception $e)
		{
			echo "An error occured : " . $e->getMessage();
		}
		return $com_tab;

	}
	public function addUsrCom($auth, $content, $img_id)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('INSERT INTO img_com(img_id, date_com, auth, content, rate) VALUES(:i_id, NOW(), :auth, :content, 0)');
			$req->execute(array(
				'i_id' => htmlspecialchars($img_id),
				'auth' => htmlspecialchars($auth),
				'content' => htmlspecialchars($content)
			));
			$req2 = $db->prepare('UPDATE imgs SET ncoms = (ncoms + 1) WHERE id = ?');
			$req2->execute(array($img_id));
			$this->sendComNotif($img_id);
			header("Location: index.php");
		}
		catch(Exception $e)
		{
			echo "An error occured : " . $e->getMessage();
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