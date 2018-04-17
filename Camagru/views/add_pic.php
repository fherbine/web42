<?php
$title = "photobooth42 - Take a picture";
?>

<?php ob_start(); ?>
	<link rel="stylesheet" type="text/css" href="public/css/take_pic.css">
<?php $ext_head = ob_get_clean(); ?>

<?php ob_start(); ?>
	<a href="index.php?page=add_pic" title="add">ADD</a>
	<a href="index.php?page=profil" title="profil">PROFIL</a>
	<a href="index.php?page=account" title="account">ACCOUNT</a>
	<a href="index.php?action=logout" title="logout">LOGOUT</a>
<?php $header_content = ob_get_clean(); ?>

<!-- Main content -->

<?php ob_start(); ?>

<video id="screenshot-video" autoplay></video>
<img src="" id="screenshot-img">
<canvas style="display:none;"></canvas>
<button id="screenshot-button">take a picture</button>

<div id="buttons">
	<form method="post" action="index.php?action=add_own_pic">
		<input type="file" name="image" accept="image/*"/> 
	</form>
</div>

<script type="text/javascript" src="public/scripts/usrCam.js"></script>
<!-- <script type="text/javascript" src="public/scripts/getImg.js"></script> -->

<?php $content = ob_get_clean(); ?>




<?php require_once('template.php'); ?>