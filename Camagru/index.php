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
	else
		require_once('views/indexView.php');