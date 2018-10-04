<?php
$title = "photobooth42 - Index";
?>

<?php ob_start(); ?>
	<link rel="stylesheet" type="text/css" href="public/css/index.css"/>
<?php $ext_head = ob_get_clean(); ?>

<!-- right header content -->

<?php ob_start(); 
if (isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] === true):?>
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
	<section>
		<article>
			<?php foreach($req_res as $uimg): ?>
				<div class="img_box">
					<h3><a href=<?php  echo (isset($_SESSION) && isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] === true) ? '"index.php?page=profil&usn=' .$uimg['auth'] . '"' : '"#"' ?>><?= $uimg['auth'] ?></a></h3>
					<img alt=<?= '"' . $uimg['auth'] . "-img-" . $uimg['up_date'] . '"' ?> src=<?= '"public/user/' . $uimg['uid'] . '-' . $uimg['id'] . '.png"'?> />
					<p><?=$uimg['up_date']?></p>
					<div class="under">
						<?php foreach ($uimg['coms'] as $com): ?>
							<div class="com">
								<div class="com_head">
									<p><?= $com['d_com'] ?></p>
									<p><?= $com['auth'] ?></p>
								</div>
								<p><?= $com['content'] ?></p>
							</div>
						<?php endforeach; ?>
						<div class="icons">
							<?php if (isset($_SESSION['logged_on_user'])): ?>
								<p><a href=<?= '"index.php?action=img_status&pic_id=' . $uimg['id'] . '"' ?> class=<?php echo (!getLike($uimg['id'])) ? "heart" : "heart_selected"; ?>>♥</a>  <span class="hrate"><?= $uimg['rate']?></span></p>
								<div class="form_container" >
									<form method="post" action=<?= '"index.php?action=postCom&img_id=' . $uimg['id'] . '"' ?>>
										<textarea name="com"></textarea>
										<input type="submit" name="submit" value="‣" class="sent" />
									</form>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</article>
		<div id="pagination">
			<?php if(isset($_COOKIE['pagination']) && $_COOKIE['pagination'] > 1): ?>
				<p><a href="index.php?page=previous"><button>Previous</button></a></p>
			<?php endif; ?>
			<p><a href="index.php?page=next"><button>Next</button></a></p>
		</div>
	</section>
<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>