<?php

require_once('models/CommentsManager.php');
// depreciated
//function getComs()
//{
//	$res_com = new CommentsManager();
//
//	$com_tab = $res_com->getImgCom();
//}

function sendCom()
{
	$resCom = new CommentsManager();

	$resCom->addUsrCom($_SESSION['login'], $_POST['com'], $_GET['img_id']);
}