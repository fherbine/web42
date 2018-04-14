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
	<input type="file" accept="image/*;capture=camera"/>
	<device type="media" onchange="update(this.data)"></device>
<video autoplay></video>
<script>
  function update(stream) {
    document.querySelector('video').src = stream.url;
  }
</script>
<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>