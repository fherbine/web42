<?php
class CommentsManager
{
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
				$req = $db->prepare('SELECT id, DATE_FORMAT(date_com, \'%m/%d at %Hh\') AS d_com, auth, content, rate FROM img_com WHERE img_id = ? ORDER BY id DESC');
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
				'i_id' => $img_id,
				'auth' => $auth,
				'content' => $content
			));
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