<?php

class AccountManager
{
	public function changePasswd($param, $newpw, $login, $key)
	{
		if ($param === 0) /// session
		{
			$res = $this->updatePasswd($newpw, $login, $key);
		}
		else /// not session
		{
			$res = $this->updatePasswd($newpw, $login, $key);
		}
		if (!$res)
			echo "An error occured";
	}

	private function updatePasswd($newpw, $login, $key)
	{
		$db = $this->dbConnect();
		try
		{
			$request = $db->prepare('UPDATE passwd SET passwd = :new WHERE pseudo = :log OR confirm_key = :gave_key');
			$request->execute(array(
				'new' => hash('whirlpool', $newpw),
				'log' => $login,
				'gave_key' => $key
			));
			return true;
		}
		catch (Exception $e)
		{return false;}
	}

	public function forgotPw($email)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT confirm_key FROM passwd WHERE email = ?');
		$request->execute(array($email));
		$check = $request->fetch();
		if ($check)
		{
			$url = 'http://localhost:8080/camagru/index.php?page=reset_pwd&key=' . urlencode($check['confirm_key']);
			$content = 'Hi, you ask to reset your password, click on the following link to get a new one : ' . $url;
			$subject = 'Photobooth42 - reset password';
			$this->sendMail($email, $subject, $content);
		}
	}

	private function sendMail($to, $subject, $content)
	{
		mail($to, $subject, $content);
	}

	public function rmAccount($login, $passwd)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('DELETE FROM passwd WHERE pseudo = :log AND passwd = :pass');
			$req->execute(array(
				'log' => $login,
				'pass' => hash('whirlpool', $passwd)
			));
			if ($req->rowCount() > 0)
			{
				session_destroy();
				header('Location: index.php');
			}
			else
				echo "wrong password";
		}
		catch (Exception $e)
		{
			die('Check your password before deleting your account !');
		}
	}

	public function truePass($login, $passwd)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM passwd WHERE pseudo = :log AND passwd = :pawd');
		$req->execute(array(
			'log' => $login,
			'pawd' => hash('whirlpool', $passwd) 
		));
		if ($req->fetch())
			return true;
		else
			return false;
	}

	public function updateBio($newBio, $login)
	{
		$db = $this->dbConnect();
		try
		{
			$request = $db->prepare('UPDATE passwd SET sumup = :bio WHERE pseudo = :log');
			$request->execute(array(
				'bio' => $newBio,
				'log' => $login
			));
			$_SESSION['sumup'] = ($request->rowCount()) ? $newBio : $_SESSION['sumup'];
			header('Location: index.php?page=account');
		}
		catch(Exception $e)
		{
			echo "cannot update your bio.";
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