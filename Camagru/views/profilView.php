<?php
$title = "photobooth42 - profil";
?>

<?php ob_start(); ?>
	<link rel="stylesheet" type="text/css" href="public/css/profil.css"/>
<?php $ext_head = ob_get_clean(); ?>

<!-- right header content -->

<?php ob_start(); ?>
	<a href="index.php?page=add_pic" title="add">ADD</a>
	<a href="index.php?page=profil" title="profil">PROFIL</a>
	<a href="index.php?page=account" title="account">ACCOUNT</a>
	<a href="index.php?action=logout" title="logout">LOGOUT</a>
<?php $header_content = ob_get_clean(); ?>

<!-- Main view -->

<?php ob_start(); ?>
	<section>
		<div>
			<h2><?= $_SESSION['login'] ?></h2>
		</div>
		<article>
			<?php foreach($req_res as $uimg): ?>
				<div class="img_box">
					<img alt=<?= '"' . $_SESSION['login'] . "-img-" . $uimg['up_date'] . '"' ?> src=<?= '"data:image/png;charset:utf-8;base64,' . base64_encode($uimg['content']) . '"'?> />
					<p><?=$uimg['up_date']?></p>
					<div class="icons">
						<p><a href="#">♥</a><?= $uimg['rate']?></p>
						<p><a href="#">💬</a><?= $uimg['ncoms'] ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</article>
	</section>

<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>