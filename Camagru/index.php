<?php
	session_start();
	require_once('controllers/passwd.php');
	var_dump($_SESSION);

	if ($_GET['page'] === "log")
		require_once('views/log.php');
	elseif ($_GET['action'] === "signin")
		signin();
	elseif ($_GET['action'] === "signup")
		signup();
	elseif ($_GET['page'] === "activate" && isset($_GET['key']) && isset($_GET['login']))
		activation();
	elseif ($_GET['page'] === "add_pic" && $_SESSION['logged_on_user'] === true)
		require_once('views/add_pic.php');
	elseif ($_GET['page'] === "account" && $_SESSION['logged_on_user'] === true)
		require_once('views/account.php');
	elseif ($_GET['action'] === "newpw")
		changePw();
	elseif ($_GET['action'] === "rm_acc")
		delAccount();
	elseif ($_GET['page'] === "reset_mail" && !$_SESSION['logged_on_user'])
		require_once('views/reset_mail.php');
	elseif ($_GET['action'] === "send_rst_mail")
		sendRstMail();
	elseif ($_GET['page'] === "reset_pwd" && !$_SESSION['logged_on_user'])
		require_once('views/reset_pwd.php');
	else
		require_once('views/indexView.php');