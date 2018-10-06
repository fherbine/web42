
<footer>
	<hr/>
	<div id="foot_blk">
		<p>2018 © Félix HERBINET (fherbine)</p>
		<?php if(!isset($_SESSION['logged_on_user'])): ?>
			<div>
				<a href="config/setup.php?action=Build"><img src="public/imgs/db.png" /></a><br/>
			</div>
		<?php endif;?>
	</div>
</footer>