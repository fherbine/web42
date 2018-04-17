<?php
if (!isset($_GET['key']))
	header('Location: index.php');
$title = "photobooth42 - Reset your password";
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
	<h2>Reset your password: </h2>
	<form method="POST" action=<?= 'index.php?action=newpw&key=' . $_GET['key'] ?>>
		<input type="password" name="npasswd" placeholder="New password" required/>
		<input type="password" name="cnpasswd" placeholder="Confirm new password" required/>
		<input type="submit" name="submit" />
	</form>
<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>