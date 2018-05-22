<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="public/css/style.css" />
	<?= $ext_head ?>
	<title><?= $title ?></title>
</head>
<body>
	<header>
		<a href="index.php"> <i class="far fa-paper-plane"></i> <h1>PhotoBooth 42</h1></a>
		<div class = "rheader">
			<?= $header_content ?>
		</div>
	</header>
	<?= $content ?>
	<?php include_once('footer.php') ?>
</body>
</html>