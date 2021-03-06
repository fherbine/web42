<?php
	session_start();
	require_once('controllers/passwd.php');
	require_once('controllers/imgs.php');
	require_once('controllers/img_vote.php');
	require_once('controllers/img_com.php');

	if (t_verif() && isset($_GET['page']) && $_GET['page'] === "log")
		require_once('views/log.php');
	else if (t_verif() && isset($_GET['page']) && $_GET['page'] === "register")
		require_once('views/register.php');
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "signin" && !$_SESSION['logged_on_user'])
		signin();
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "signup" && (!isset($_SESSION['logged_on_user']) || !$_SESSION['logged_on_user']))
		signup();
	elseif (t_verif() && isset($_GET['page']) && $_GET['page'] === "activate" && isset($_GET['key']) && isset($_GET['login']))
		activation();
	elseif (t_verif() && isset($_GET['page']) && $_GET['page'] === "add_pic" && isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] === true)
		require_once('views/add_pic.php');
	elseif (t_verif() && isset($_GET['page']) && $_GET['page'] === "account" && isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] === true)
		require_once('views/account.php');
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "newpw")
		changePw();
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "rm_acc" && isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] === true)
		delAccount();
	elseif (t_verif() && isset($_GET['page']) &&  $_GET['page'] === "reset_mail" && !isset($_SESSION['logged_on_user']))
		require_once('views/reset_mail.php');
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "send_rst_mail")
		sendRstMail();
	elseif (t_verif() && isset($_GET['page']) && $_GET['page'] === "reset_pwd" && !isset($_SESSION['logged_on_user']))
		require_once('views/reset_pwd.php');
	elseif (isset($_GET['action']) && $_GET['action'] === "logout")
	{ session_destroy(); header('Location: index.php'); }
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "update_account" && isset($_SESSION['logged_on_user']))
		updateAccount();
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "new_email" && isset($_SESSION['logged_on_user']))
		updateEmail();
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "new_usn" && isset($_SESSION['logged_on_user']))
		updateUsn();
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "notif_status" && isset($_SESSION['logged_on_user']))
		updateNstat();
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "AddPic" && isset($_SESSION['logged_on_user']))
		AddNewPic();
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "SendPic" && isset($_SESSION['logged_on_user']))
		AddImgToDb();
	elseif (t_verif() && isset($_GET['page']) && $_GET['page'] === "profil" && $_SESSION['logged_on_user'])
	{
		if (isset($_GET['usn']))
			getUsrPics($_GET['usn']);
		else
			getUsrPics($_SESSION['login']);
	}
	elseif (t_verif() && isset($_GET['action']) && $_GET['action'] === "del_pic" && isset($_SESSION['logged_on_user']))
		deleteUserPic();
	elseif (t_verif() && isset($_SESSION['logged_on_user']) && isset($_GET['action']) && isset($_GET['pic_id']) && $_GET['action'] === "img_status")
		addLike();
	elseif (t_verif() && isset($_SESSION['logged_on_user']) && isset($_GET['action']) && isset($_GET['img_id']) && $_GET['action'] === "postCom" && isset($_POST['com']) && $_POST['com'] !== "")
		sendCom();
	elseif (t_verif() && isset($_GET['page']) && ($_GET['page'] === "next" || $_GET['page'] === "previous" || $_GET['page'] === "reset"))
	{
		$val = (isset($_COOKIE['pagination'])) ? $_COOKIE['pagination'] : 1;
		$add = ($_GET['page'] === "next") ? 1 : -1;
		$add = ($_GET['page'] === "reset") ? 1 - $val: $add;
		setcookie('pagination', $val + $add);
		header('Location: index.php');
	}
	else
	{
		$req_res = getPics();
		require_once('views/indexView.php');
	}
