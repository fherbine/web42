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

<div id="cam">
	<div class="cam_elem">
		<img src="" id="filterV" />
		<video id="screenshot-video" autoplay></video>
	</div>
	<div class="cam_elem">
		<img src="" id="screenshot-img" class="cam_elem">
	</div>
</div>
<canvas style="display:none;"></canvas>

<div id="buttons">
	<button id="screenshot-button" class="addPicButs">take a picture</button>
	<label for="uImg" class="addPicButs">Upload your own</label>
</div>

<input type="file" name="image" accept="image/png" id="uImg"/>
<fieldset>
	<legend>filtres</legend>
	<div id="filters">
		<button id="filter_42" autofocus><img src="./public/imgs/42neg.png" alt="logo42">logo 42</button>
		<button id="filter_sun"><img src="./public/imgs/sun.png" alt="sun">Sun glasses</button>
	</div>
</fieldset>

<script type="text/javascript" src="public/scripts/usrCam.js"></script>
<!-- <script type="text/javascript" src="public/scripts/getImg.js"></script> -->

<?php $content = ob_get_clean(); ?>




<?php require_once('template.php'); ?>