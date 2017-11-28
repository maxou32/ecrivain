<?php
ob_start(); 
?>
	<footer>
			<p id="message"> <?= $captionMessage . $message   ?></p>
	</footer>
<?php

$footerView=ob_get_clean(); 
