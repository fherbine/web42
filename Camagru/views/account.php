<?php
$title = "photobooth42 - Account";
?>

<?php ob_start(); ?>
	<link rel="stylesheet" type="text/css" href="public/css/account.css"/>
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
	<section id="container">
		<div>
			<h2>Public settings</h2>
			<hr /><br />
			<!-- profil pic ? -->
			<div>
				<h3>Edit your bio:</h3>
				<form method="POST" action="index.php?action=update_account">
					<textarea id="sumup" name="sumup" ><?= $_SESSION['sumup'] ?></textarea><br />
					<input type="submit" name="submit" />
				</form>
			</div>
			<div>
				<h3>Change your username:</h3>
				<form method="POST" action="index.php?action=new_usn">
					<input type="text" name="n_usn" placeholder="new username" required/><br />
					<input type="submit" name="submit" />
				</form>
			</div>
		</div>
		<div>
			<h2>Account settings</h2>
			<hr /><br />
			<div>
				<h3>Change your password:</h3>
				<form method="POST" action="index.php?action=newpw">
					<input type="password" name="old_passwd" placeholder="current password" required/><br />
					<input type="password" name="new_pass" placeholder="New password" required/><br />
					<input type="password" name="new_passc" placeholder="confirm new password" required/><br />
					<input type="submit" name="submit" />
				</form>
			</div>
			<div>
				<h3>Change your email adress:</h3>
				<form method="POST" action="index.php?action=new_email">
					<input type="email" name="email" placeholder="new email adress" required/><br />
					<input type="submit" name="submit" />
				</form>
			</div>
			<div id="delete_area">
				<h3>Delete your account:</h3>
				<p><span style="font-weight: bold;">NOTE:</span> This action is irreversible, please make sure that you want to delete your account and all your data !</p>
				<form method="POST" action="index.php?action=rm_acc">
					<input type="password" name="passwd" placeholder="password" required/><br />
					<input type="submit" name="submit" value="Delete" />
				</form>
			</div>
		</div>
	</section>
	<br />
<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>