<?php
require_once('models/LogManager.php');
require_once('models/AccountManager.php');

function signin()
{
	if (isset($_POST) && isset($_POST['username']) && isset($_POST['passwd']))
	{
		$result = new LogManager();
		$res = $result->logUsr($_POST['username'], $_POST['passwd']);
		header('Location: index.php');
	}
	else
		echo "An error occurred, check if your inputs are not empty and try again.";
}

function signup()
{
	if (isset($_POST) && isset($_POST['email']) && isset($_POST['passwd']) && isset($_POST['pseudo']) && $_POST['passwd'] === $_POST['passwd_confirm'])
	{
		$admin = 0;
		$result = new LogManager();
		$res = $result->newUsr($_POST['email'], $_POST['passwd'], $_POST['pseudo'], $admin);
		echo $res;
	}
	else
		echo "An error occurred, check if your inputs are not empty and try again.";
}

function activation()
{
	$result = new LogManager();
	$result->confirmAccount($_GET['key'], $_GET['login']);
}

function changePw()
{
	$result = new AccountManager();
	if (isset($_GET['key']) && !isset($_SESSION['logged_on_user']) && $_POST['npasswd'] === $_POST['cnpasswd'])
		$result->changePasswd(1, $_POST['npasswd'], null, $_GET['key']);
	else if(isset($_POST['old_passwd']) && isset($_POST['new_pass']) && $_POST['new_pass'] === $_POST['new_passc'])
	{
		var_dump($_POST);
		if ($result->truePass($_SESSION['login'], $_POST['old_passwd']))
		{
			$result->changePasswd(0, $_POST['new_pass'], $_SESSION['login'], null);
		}
		else
			echo "wrong password";
	}
	else
		echo "error";
}

function delAccount()
{
	$result = new AccountManager();
	if (isset($_POST['passwd']))
		$result->rmAccount($_SESSION['login'], $_POST['passwd']);
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