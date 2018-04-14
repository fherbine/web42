<?php
$title = "photobooth42 - Take a picture";
?>

<?php ob_start(); ?>
	<!-- ext_head -->
<?php $ext_head = ob_get_clean(); ?>


<!-- Main content -->

<?php ob_start(); ?>

<video id="screenshot-video" autoplay></video>
<img src="" id="screenshot-img">
<canvas style="display:none;"></canvas>
<button id="screenshot-button">tutu</button>

<script type="text/javascript" src="public/scripts/usrCam.js"></script>

<?php $content = ob_get_clean(); ?>




<?php require_once('template.php'); ?>