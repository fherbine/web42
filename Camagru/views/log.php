<?php
$title = "photobooth42 - Index";
?>

<?php ob_start(); ?>
	<link rel="stylesheet" type="text/css" href="public/css/log.css"/>
<?php $ext_head = ob_get_clean(); ?>

<!-- right header content -->

<?php ob_start(); ?>
<?php $header_content = ob_get_clean(); ?>

<!-- Main view -->

<?php ob_start(); ?>
	<div class="main_box">
		<a href="index.php" class="index_a">
			<i class="far fa-paper-plane"></i>
			<h1>PhotoBooth 42</h1>
		</a>
		<div class="sign_box">
			<h2>Sign in</h2>
			<form action="index.php?action=signin" method="POST">
				<label for="email">email address</label>
				<input type="email" name="email" id="email" required /><br />
				<div class="over_pass"><label for="passwd">password</label><a href="index.php?page=reset_mail">You forgot your password ?</a></div>
				<input type="password" name="passwd" id="passwd" required/><br />
				<input type="submit" name="submit" value="Sign in" />
			</form>
		</div>
		<div class="link_box">
			<p>New on Photobooth ? <a href="index.php?page=register">Create an account!</a></p>
		</div>
	</div>
<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>