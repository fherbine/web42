<?php
$title = "photobooth42 - Index";
?>

<?php ob_start(); ?>
	<!-- <link rel="stylesheet" type="text/css" href="public/css/index.css"/> -->
<?php $ext_head = ob_get_clean(); ?>

<!-- right header content -->

<?php ob_start(); ?>
	<a href="index.php?page=log" title="sign in/sign up">SIGN IN</a>
<?php $header_content = ob_get_clean(); ?>

<!-- Main view -->

<?php ob_start(); ?>

	<!-- <div class = "begin_drop"><a href="#">Begin the experience</a> -->
		<!-- <div class = "begin_hide"> -->
			<!-- <p>tutu<p> -->
			<!-- <p>tutu<p> -->
			<!-- <p>tutu<p> -->
		<!-- </div> -->
	<!-- </div> -->

<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>