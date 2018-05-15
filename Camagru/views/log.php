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
		<p>New on Photobooth ? <a href="index.php?page=register">Create an account!</a></p>
	</div>
<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>