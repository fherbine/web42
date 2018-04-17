<?php
$title = "photobooth42 - Index";
?>

<?php ob_start(); ?>
	<link rel="stylesheet" type="text/css" href="public/css/index.css"/>
<?php $ext_head = ob_get_clean(); ?>

<!-- right header content -->

<?php ob_start(); 
if ($_SESSION['logged_on_user'] === true):?>
	<a href="index.php?page=add_pic" title="add">ADD</a>
	<a href="index.php?page=profil" title="profil">PROFIL</a>
	<a href="index.php?page=account" title="account">ACCOUNT</a>
	<a href="index.php?action=logout" title="logout">LOGOUT</a>
<?php else: ?>
	<a href="index.php?page=log" title="sign in/sign up">SIGN IN</a>
<?php endif; ?>
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