<?php
require_once('models/PostPicsManager.php');

function sendNewPic()
{
	$result = new PostPicsManager();
	$auth = $_SESSION['login'];

	if (isset($_POST['camContent']))
		$result->sendImg(base64_decode($_POST['camContent']), $auth);
	else
		$result->sendImg($_POST['content'], $auth);
}