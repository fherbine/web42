<?php
require_once('models/LikesManager.php');

function getLike($pic_id)
{
	$result = new LikesManager();
	$res = $result->checkUsrLike($_SESSION['uid'], $pic_id);
	return ($res);
}

function addLike()
{
	$result = new LikesManager();
	$already = $result->checkUsrLike($_SESSION['uid'], $_GET['pic_id']);
	if (!$already)
		$result->addUsrLike($_SESSION['uid'], $_GET['pic_id']);
	else
		header("Location: index.php");
}