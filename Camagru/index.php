<?php
	if (isset($_GET['page']) && $_GET['page'] === "log")
		require_once('views/log.php');
	else
		require_once('views/indexView.php');