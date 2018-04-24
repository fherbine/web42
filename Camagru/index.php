<?php
	session_start();
	require_once('controllers/passwd.php');
	require_once('controllers/imgs.php');
	require_once('controllers/img_vote.php');

	if (isset($_GET['page']) && $_GET['page'] === "log")
		require_once('views/log.php');
	elseif (isset($_GET['action']) && $_GET['action'] === "signin" && !$_SESSION['logged_on_user'])
		signin();
	elseif (isset($_GET['action']) && $_GET['action'] === "signup" && !$_SESSION['logged_on_user'])
		signup();
	elseif (isset($_GET['page']) && $_GET['page'] === "activate" && isset($_GET['key']) && isset($_GET['login']))
		activation();
	elseif (isset($_GET['page']) && $_GET['page'] === "add_pic" && $_SESSION['logged_on_user'] === true)
		require_once('views/add_pic.php');
	elseif (isset($_GET['page']) && $_GET['page'] === "account" && $_SESSION['logged_on_user'] === true)
		require_once('views/account.php');
	elseif (isset($_GET['action']) && $_GET['action'] === "newpw")
		changePw();
	elseif (isset($_GET['action']) && $_GET['action'] === "rm_acc" && $_SESSION['logged_on_user'] === true)
		delAccount();
	elseif (isset($_GET['page']) &&  $_GET['page'] === "reset_mail" && !isset($_SESSION['logged_on_user']))
		require_once('views/reset_mail.php');
	elseif (isset($_GET['action']) && $_GET['action'] === "send_rst_mail")
		sendRstMail();
	elseif (isset($_GET['page']) && $_GET['page'] === "reset_pwd" && !isset($_SESSION['logged_on_user']))
		require_once('views/reset_pwd.php');
	elseif (isset($_GET['action']) && $_GET['action'] === "logout")
	{ session_destroy(); header('Location: index.php'); }
	elseif (isset($_GET['action']) && $_GET['action'] === "update_account" && $_SESSION['logged_on_user'] === true)
		updateAccount();
	elseif (isset($_GET['action']) && $_GET['action'] === "postPic" && $_SESSION['logged_on_user'] === true)
		sendNewPic();
	elseif (isset($_GET['page']) && $_GET['page'] === "profil" && $_SESSION['logged_on_user'])
		getUsrPics();
	elseif (isset($_SESSION['logged_on_user']) && isset($_GET['action']) && isset($_GET['pic_id']) && $_GET['action'] === "img_status")
		addLike();
	else
		getPics();