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
			$confirm_key = hash('md5', rand());
			$request = $db->prepare('INSERT INTO passwd(email, passwd, pseudo, sign_date, admin, sumup, confirm, confirm_key)
				VALUES(:email, :password, :pseudo, NOW(), :admin, :sumup, :confirm, :confirm_key)');
			$request->execute(array('email' => $email,
								'password' => hash('whirlpool', $password),
								'pseudo' => $pseudo,
								'admin' => $admin,
								'sumup' => 'Hey I\'m new on Photobooth 42 !',
								'confirm' => 0,
								'confirm_key' => $confirm_key
							)); ///////////////////////// -------------------------------- rand -> conf key
			$url = 'localhost:8080/web42/Camagru/index.php?page=activate&amplogin=' . urlencode($pseudo) . 'key=' . urlencode($confirm_key); ///////////////////////////// ----------------------------------------
			$content = 'Thanks for your subscription ' . $pseudo . ' and welcome on board.
			 Please click on the following link to activate your account: ' . $url;
			$content = wordwrap($content, 70, "\r\n");
			$this->sendMail('felix.herbinet@yahoo.com', $email, 'Activation of your account', $content);
			return "ok";
		}
		else
			return "usr already exist"; ///// -------------------------------------------
	}

	public function sendMail($from, $to, $subject, $content)
	{
		$email_header = 'From: ' . $from . "\r\n" .
 		'X-Mailer: PHP/' . phpversion();
 		try
 		{
			mail($to, $subject, $content, $email_header);
		}
		catch(Exception $e)
		{
			die('An error occured: ' . $e->getMessage());
		}
		var_dump($tst);
		echo $to . "<br/>";
		echo $content . "<br/>";
		echo $email_header . "<br/>";
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