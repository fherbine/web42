<?php
$title = "photobooth42 - Account";
?>

<?php ob_start(); ?>
	<!-- <link rel="stylesheet" type="text/css" href="public/css/index.css"/> -->
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
	<h2>Account settings</h2>
	<div>
		<h3>Change your password:</h3>
		<form method="POST" action="index.php?action=newpw">
			<input type="password" name="old_passwd" placeholder="current password" required/>
			<input type="password" name="new_pass" placeholder="New password" required/>
			<input type="password" name="new_passc" placeholder="confirm new password" required/>
			<input type="submit" name="submit" />
		</form>
	</div>
	<div>
		<h3>Delete your account:</h3>
		<p><span style="font-weight: bold;">NOTE:</span> This action is irreversible, please make sure that you want to delete your account and all your data !</p>
		<form method="POST" action="index.php?action=rm_acc">
			<input type="password" name="passwd" placeholder="password" required/>
			<input type="submit" name="submit" value="DELETE" />
		</form>
	</div>
	<hr/>
<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>