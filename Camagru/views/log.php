<?php
$title = "photobooth42 - Index";
?>

<?php ob_start(); ?>
	<!-- <link rel="stylesheet" type="text/css" href="public/css/log.css"/> -->
<?php $ext_head = ob_get_clean(); ?>

<!-- right header content -->

<?php ob_start(); ?>
<?php $header_content = ob_get_clean(); ?>

<!-- Main view -->

<?php ob_start(); ?>
	<div>
		<h2>Sign in</h2>
		<form action="index.php?action=signin" method="POST">
			<input type="email" name="email" placeholder="user@example.com" required />
			<input type="password" name="passwd" placeholder="Password" required/>
			<input type="submit" name="submit" />
		</form>
		<a href="index.php?page=reset_mail">You forgot your password ?</a>
	</div>
	<div>
		<h2>Sign up</h2>
		<form action="index.php?action=signup" method="POST">
			<input type="email" name="email" placeholder="user@example.com" required />
			<input type="password" name="passwd" placeholder="password" required />
			<input type="password" name="passwd_confirm" placeholder="Confirm your password" required />
			<input type="text" name="pseudo" placeholder="pseudo" required />
			<input type="submit" name="submit" />
		</form>
	</div>
<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>