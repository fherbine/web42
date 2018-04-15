<?php
	require_once('controllers/passwd.php');

	if ($_GET['page'] === "log")
		require_once('views/log.php');
	elseif ($_GET['action'] === "signin")
		signin();
	elseif ($_GET['action'] === "signup")
		signup();
	else
		require_once('views/indexView.php');