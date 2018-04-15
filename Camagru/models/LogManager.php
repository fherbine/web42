<?php
// session_start();

class LogManager
{
	public function logUsr($email, $password)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM passwd WHERE email = :email AND passwd = :password AND confirm = 1');
		$request->execute(array('email' => $email, 'password' => hash('whirlpool', $password)));
		if ($request->fetch())
			return "okok";
		else
			return "error";
	}

	public function newUsr($email, $password, $pseudo, $admin)
	{
		$db = $this->dbConnect();
		$exist = $db->prepare('SELECT * FROM passwd WHERE email = ?');
		$exist->execute(array($email));
		if (!($exist->fetch()))
		{
			$request = $db->prepare('INSERT INTO passwd(email, passwd, pseudo, sign_date, admin, sumup, confirm, confirm_key)
				VALUES(:email, :password, :pseudo, NOW(), :admin, :sumup, :confirm, :confirm_key)');
			$request->execute(array('email' => $email,
								'password' => hash('whirlpool', $password),
								'pseudo' => $pseudo,
								'admin' => $admin,
								'sumup' => 'Hey I\'m new on Photobooth 42 !',
								'confirm' => 0,
								'confirm_key' => 22222
							)); ///////////////////////// -------------------------------- rand -> conf key
			return 'ok';
		}
		else
			return "usr already exist"; ///// -------------------------------------------
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