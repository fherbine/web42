<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="public/css/style.css" />
	<?= $ext_head ?>
	<title><?= $title ?></title>
</head>
<body>
	<header>
		<a href="index.php"><h1>PhotoBooth 42</h1></a>
		<div class = "rheader">
			<?= $header_content ?>
		</div>
	</header>
	<?= $content ?>
	<?php include_once('footer.php') ?>
</body>
</html>