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
			<h2>Sign up</h2>
			<?php
				if (isset($_GET['issue']))
					echo '<p class="issue">' . htmlspecialchars($_GET['issue']) . '</p>';
			?>
			<form action="index.php?action=signup" method="POST">
				<label for="email">email adress</label>
				<input type="email" name="email" id="email" required /><br />
				<label for="password">password</label>
				<input type="password" name="passwd" id="password" required /><br />
				<label for="password_c">confirm your password</label>
				<input type="password" name="passwd_confirm" id="password_c" required /><br />
				<label for="pseudo">pseudo</label>
				<input type="text" name="pseudo" id="pseudo" required /><br />
				<input type="submit" name="submit" />
			</form>
		</div>
		<div class="link_box">
			<p>Already registered ? <a href="index.php?page=log">Sign in !</a></p>
		</div>
	</div>
<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>