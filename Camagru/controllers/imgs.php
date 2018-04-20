<?php
require_once('models/PostPicsManager.php');

function sendNewPic()
{
	$result = new PostPicsManager();
	$auth = $_SESSION['login'];

	if (isset($_POST['camContent']))
	{
		echo "tutu";
		$result->sendImg(base64_decode($_POST['camContent']), $auth);
	}
	// else
		// $result->sendImg($_POST['content'], $auth);
}