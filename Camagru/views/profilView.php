<?php
$title = "photobooth42 - profil";
?>

<?php ob_start(); ?>
	<link rel="stylesheet" type="text/css" href="public/css/profil.css"/>
	<link rel="stylesheet" type="text/css" href="public/css/style.css"/>
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
		<div class="usrBio">
			<div class="rbio">
				<h2><?= $_SESSION['login'] ?></h2>
				<?php if(isset($_SESSION['ulocate'])) : ?>
					<p><i class="fas fa-map-marker-alt"></i> <?php echo $_SESSION['ulocate'];?></p>
				<?php endif; ?>
				<p><b>Bio: </b><?= $_SESSION['sumup'] ?></p>
			</div>
			<div class="urates">
				<p style="color:red;font-size:3.9vw;text-shadow: -1px -1px lightgrey;">♥</p>
				<p class="urates_int"><?= $req_res['urates']['u_rate'] ?></p>
			</div>
		</div>
		<article>
			<?php foreach($req_res['content'] as $uimg): ?>
				<div class="img_box">
					<img alt=<?= '"' . $_SESSION['login'] . "-img-" . $uimg['up_date'] . '"' ?> src=<?= '"data:image/png;charset:utf-8;base64,' . base64_encode($uimg['content']) . '"'?> />
					<p><?=$uimg['up_date']?></p>
					<div class="icons">
						<p><a href=<?= '"index.php?action=img_status&pic_id=' . $uimg['id'] . '"' ?> class=<?php echo (!getLike($uimg['id'])) ? "heart" : "heart_selected"; ?>>♥</a>  <?= $uimg['rate']?></p>
						<p><a href="#"><i class="far fa-comment"></i></a><?= $uimg['ncoms'] ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</article>
	</section>

<?php $content = ob_get_clean(); ?>



<?php require_once('template.php'); ?>