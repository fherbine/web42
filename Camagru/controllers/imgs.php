<?php
require_once('models/CommentsManager.php');
require_once('models/PostPicsManager.php');

function sendNewPic()
{
	$result = new PostPicsManager();
	$auth = $_SESSION['login'];

	if (isset($_POST['camContent']))
	{		$result->sendImg(base64_decode($_POST['camContent']), $auth, $_SESSION['uid']);
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
	$res_com = new CommentsManager();
	$pics = array();

	$req_res = $result->getAllImg();
	foreach ($req_res as $master => $value)
	{
		$req_res[$master]['coms'] = $res_com->getImgCom($req_res[$master]['id'], 0);
		// var_dump($master);
	}
	// $req_res[] = array_map("base64_encode", $req_res[]);
	return ($req_res);
}