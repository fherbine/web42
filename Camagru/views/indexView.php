<?php
$title = "photobooth42 - Index";
$page_style = "public/css/index.css";
?>

<?php ob_start(); ?>
	<div class = "begin_drop"><a href="#">Begin the experience</a>
		<div class = "begin_hide">
			<p>tutu<p>
			<p>tutu<p>
			<p>tutu<p>
		</div>
	</div>
<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>