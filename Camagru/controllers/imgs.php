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

function getUsrPics()
{
	$result = new PostPicsManager();

	$req_res = $result->getUsrImg($_SESSION['login']);
	// $req_res[] = array_map("base64_encode", $req_res[]);

	require_once('views/profilView.php');
}

function getPics()
{
	$result = new PostPicsManager();

	$req_res = $result->getAllImg();
	// $req_res[] = array_map("base64_encode", $req_res[]);

	require_once('views/indexView.php');
}