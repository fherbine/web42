<?php
// session_start();

class LogManager
{
	public function logUsr($usn, $password)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM passwd WHERE pseudo = :usn AND passwd = :password AND confirm = 1');
		$request->execute(array('usn' => $usn, 'password' => hash('whirlpool', $password)));
		if ($user_info = $request->fetch())
		{
			$_SESSION['uid'] = $user_info['id']; 
			$_SESSION['login'] = $user_info['pseudo']; 
			$_SESSION['email'] = $user_info['email']; 
			$_SESSION['sumup'] = $user_info['sumup']; 
			$_SESSION['ulocate'] = $user_info['location'];
			$_SESSION['logged_on_user'] = true;
			$_SESSION['logged_on_admin'] = ($user_info['admin'] = '0') ? false : true; 
		}
		else
			return "error";
	}

	public function newUsr($email, $password, $pseudo, $admin)
	{
		$db = $this->dbConnect();
		$exist = $db->prepare('SELECT * FROM passwd WHERE email = ? OR pseudo = ?');
		$exist->execute(array($email, $pseudo));
		if (!($exist->fetch()))
		{
			$confirm_key = hash('md5', rand());
			try {
			$request = $db->prepare('INSERT INTO passwd(email, passwd, pseudo, sign_date, admin, sumup, location, confirm, confirm_key)
				VALUES(:email, :password, :pseudo, NOW(), :admin, :sumup, :locate, :confirm, :confirm_key)');
			$request->execute(array('email' => htmlspecialchars($email),
								'password' => hash('whirlpool', htmlspecialchars($password)),
								'pseudo' => htmlspecialchars($pseudo),
								'admin' => $admin,
								'sumup' => 'Hey I\'m new on Photobooth 42 !',
								'locate' => '',
								'confirm' => 0,
								'confirm_key' => $confirm_key
							)); ///////////////////////// -------------------------------- rand -> conf key
		}
			catch(Exception $e) {echo "An error occured" . $e->getMessage();}
			$url = 'http://localhost:8080/camagru/index.php?page=activate&login=' . urlencode($pseudo) . '&key=' . urlencode($confirm_key); ///////////////////////////// ----------------------------------------
			$content = 'Thanks for your subscription ' . htmlspecialchars($pseudo) . ' and welcome on board.
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
		$email_header = 'From: ' . $from;
		mail($to, $subject, $content);
	}

	public function confirmAccount($key, $login)
	{
		$db = $this->dbConnect();
		try
		{
			///////////////// already activated
			$request = $db->prepare('UPDATE passwd SET confirm = 1 WHERE pseudo = :pseudo AND confirm_key = :key');
			$request->execute(array('pseudo' => $login, 'key' => $key));
			echo "Your account is now activated ! Welcome on board !";
		}
		catch(Exception $e)
		{
			die("An error occured during account activation: " . $e->getMessge());
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