<?php
$title = "photobooth42 - Index";
?>

<?php ob_start(); ?>
	<link rel="stylesheet" type="text/css" href="public/css/index.css"/>
	
<?php $ext_head = ob_get_clean(); ?>

<?php ob_start(); ?>
	<div class = "begin_drop"><a href="#">Begin the experience</a>
		<div class = "begin_hide">
			<p>tutu<p>
			<p>tutu<p>
			<p>tutu<p>
		</div>
	</div>

<video id="screenshot-video" autoplay></video>
<img src="" id="screenshot-img">
<canvas style="display:none;"></canvas>
<button id="screenshot-button">tutu</button>

<script type="text/javascript" src="public/scripts/usrCam.js"></script>
<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>