<?php
$title = "photobooth42 - Reset your password";
?>

<?php ob_start(); ?>
	<link rel="stylesheet" type="text/css" href="public/css/send_rst_mail.css"/>
<?php $ext_head = ob_get_clean(); ?>

<!-- right header content -->

<?php ob_start(); ?>
	<a href="index.php?page=log" title="sign in/sign up">SIGN IN</a>
<?php $header_content = ob_get_clean(); ?>

<!-- Main view -->

<?php ob_start(); ?>
	<div class="main_box">
		<a href="index.php" class="index_a">
			<i class="far fa-paper-plane"></i>
			<h1>PhotoBooth 42</h1>
		</a>
		<div class="send_box">
			<p>Give us your email to reset your password: </p>
			<form method="POST" action="index.php?action=send_rst_mail">
				<input type="email" name="email" placeholder="Your email" required/><br />
				<input type="submit" name="submit" value="send reset email" />
			</form>
		</div>
	</div>
<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>