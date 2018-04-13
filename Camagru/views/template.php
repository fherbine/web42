<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="public/css/style.css" />
	<link rel="stylesheet" type="text/css" href=<?= $page_style ?> />
	<title><?= $title ?></title>
</head>
<body>
	<?= $header ?>
	<?= $content ?>
	<?php include_once('footer.php') ?>
</body>
</html>