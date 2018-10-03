<?php
require_once('models/CommentsManager.php');
require_once('models/PostPicsManager.php');


function sendNewPic()
{
	$result = new PostPicsManager();
	$auth = $_SESSION['login'];

	//if (isset($_POST['fpath']))
	//{
	//	$image = imagecreatefrompng(filename)
	//}

	if (isset($_POST['camContent']))
	{
		$ipath = $result->sendImg(base64_decode($_POST['camContent']), $auth, $_SESSION['uid']);
	}

	if (isset($_POST['fpath']))
	{
		$image = imagecreatefrompng($ipath);
		$filter = imagecreatefrompng($_POST['fpath']);
		$image = imagescale($image, 400);
		imagecopy($image, $filter, 0, 0, 0, 0, imagesx($filter), imagesy($filter));
		$file = fopen($ipath, 'w+');
		imagepng($image, $file);
		//fclose($file);
		imagedestroy($image);
		imagedestroy($filter);
	}

	// else
		// $result->sendImg($_POST['content'], $auth);
	return "toto";
}

function getUsrPics($user)
{
	$result = new PostPicsManager();

	$req_res = $result->getUsrImg($user);
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