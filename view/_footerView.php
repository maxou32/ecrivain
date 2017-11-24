<?php
ob_start(); 
?>
	<footer>
			<p id="messError"> <?= $captionError . $error   ?></p>
	</footer>
<?php

$footerView=ob_get_clean(); 
