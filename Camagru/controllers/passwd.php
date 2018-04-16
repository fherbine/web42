<?php
require_once('models/LogManager.php');
function signin()
{
	if (isset($_POST) && isset($_POST['email']) && isset($_POST['passwd']))
	{
		$result = new LogManager();
		$res = $result->logUsr($_POST['email'], $_POST['passwd']);
		echo $res;
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