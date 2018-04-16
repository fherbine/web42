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
	elseif ($_GET['action'] === "add_own_pic")
		/////////////////////
	else
		require_once('views/indexView.php');