<?php
ob_start(); 
?>
<form method="post" action="index.php?action=updateOneChapter&amp;Idchapters=<?= $chapter->getIdchapters()?>" class="formChapitre">
    <?php   
		require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_fieldsChapter.php'); 
	?>
    
    <input type="submit" value="Enregistrer les changements" />

	
</form>

<?php

$contentView=ob_get_clean(); 
$footerView="";
$message="";

require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php'); 