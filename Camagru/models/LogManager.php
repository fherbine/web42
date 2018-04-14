<?php
// session_start();
require_once('config/database.php');

class LogManager
{
	public function login($email, $password)
	{
		$db = $this->dbConnect();
		$request = prepare('SELECT * FROM passwd WHERE email = :email AND password = :password AND confirm = 1');
		$request->execute(array('email' => $email, 'password' => hash('whirlpool', $password)));
		if ($request->fetch())
			echo "okok";
		else
			echo "error";
	}

	public function sigup($email, $password, $pseudo, $admin)
	{
		$db = $this->dbConnect();
		$exist = prepare('SELECT * FROM passwd WHERE email = ?');
		$exist->execute(array($email));
		if (!($exist->fetch()))
		{
			$request = prepare('INSERT INTO passwd(email, passwd, pseudo, sign_date, admin, sumup, confirm, confirm_key)
				VALUES(:email, :password, :pseudo, NOW(), :admin, :sumup, :confirm, :confirm_key)');
			$request->execute(array('email' => $email,
								'password' => hash('whirlpool', $password),
								'pseudo' => $pseudo,
								'admin' => $admin,
								'sumup' => 'Hey I\'m new on Photobooth 42 !',
								'confirm' => 0,
								'confirm_key' => 22222
							)); ///////////////////////// -------------------------------- rand -> conf key
		}
		else
			echo "usr already exist"; ///// -------------------------------------------
	}

	private function dbConnect()
	{
		try
		{
			$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			die('An error occured during the db connection : ' . $e->getMessage());
		}
	}
}