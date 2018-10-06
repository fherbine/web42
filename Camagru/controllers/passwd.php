<?php
require_once('models/LogManager.php');
require_once('models/AccountManager.php');

function signin()
{
	if (isset($_POST) && isset($_POST['username']) && isset($_POST['passwd']))
	{
		$result = new LogManager();
		$res = $result->logUsr($_POST['username'], $_POST['passwd']);
		if ($res == "ok")
			header('Location: index.php');
		else
			header('Location: index.php?page=log&issue=' . $res);
	}
	else
		echo "An error occurred, check if your inputs are not empty and try again.";
}

function signup()
{
	if (isset($_POST) && isset($_POST['email']) && isset($_POST['passwd']) && isset($_POST['pseudo']) && $_POST['passwd'] === $_POST['passwd_confirm'])
	{
		$notif = 1;
		$result = new LogManager();
		$res = $result->newUsr($_POST['email'], $_POST['passwd'], $_POST['pseudo'], $notif);
		if ($res == "ok")
			header('Location: index.php?msg=Check your emails to confirm your account.');
		else
			header('Location: index.php?page=register&issue=' . $res);
	}
	else
		header('Location: index.php?page=register&issue=An error occurred, check if your inputs are not empty and try again.');
}

function t_verif()
{
	$result = new LogManager();
	return $result->tblCreated(); 
}

function activation()
{
	$result = new LogManager();
	$res = $result->confirmAccount($_GET['key'], $_GET['login']);
	header('Location: index.php?msg=' . $res);

}

function changePw()
{
	$result = new AccountManager();
	if (isset($_GET['key']) && !isset($_SESSION['logged_on_user']) && $_POST['npasswd'] === $_POST['cnpasswd'])
	{
		$res = $result->changePasswd(1, $_POST['npasswd'], null, $_GET['key']);
		if ($res != "ok")
			header("Location: index.php?msg=" . $res);
		else
			header("Location: index.php");
	}
	else if(isset($_POST['old_passwd']) && isset($_POST['new_pass']) && $_POST['new_pass'] === $_POST['new_passc'])
	{
		if ($result->truePass($_SESSION['login'], $_POST['old_passwd']))
		{
			$res = $result->changePasswd(0, $_POST['new_pass'], $_SESSION['login'], null);
		}
		else
			$res = "wrong password";
		if ($res != "ok")
			header("Location: index.php?page=account&issue=" . $res);
		else
			header("Location: index.php");
	}
	else
	{
		if (isset($_GET['key']))
			header("Location: index.php?msg=Passwords mismatch");
		else
			header("Location: index.php?page=account&issue=Passwords mismatch");
	}
}

function delAccount()
{
	$result = new AccountManager();
	if (isset($_POST['passwd']))
		$res = $result->rmAccount($_SESSION['login'], $_POST['passwd']);
	header('Location: index.php?page=account&issue=' . $res);
}

function sendRstMail()
{
	$result = new AccountManager();
	if (isset($_POST['email']))
		$result->forgotPw($_POST['email']);
}

function updateAccount()
{
	$result = new AccountManager();
	$result->updateBio($_POST['sumup'], $_SESSION['login']);
}

function updateEmail()
{
	$result = new AccountManager();
	if (isset($_POST['email']))
		$result->updateEmail($_POST['email'], $_SESSION['login']);
}

function updateUsn()
{
	$result = new AccountManager();
	if (isset($_POST['n_usn']))
		$result->updateUsn($_POST['n_usn'], $_SESSION['login']);
}

function updateNstat()
{
	$result = new AccountManager();
	$result->updateNstatus($_SESSION['login']);
}