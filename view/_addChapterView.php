<?php
$title="Voyage en Alaska"; 
ob_start(); 
?>
<form method="post" action="index.php?action=addOneChapter" class="formChapitre">
    <input id="title" name="title" type="text" placeholder="Le titre du chapitre" 
           required /><br />
    <textarea id="resume" name="resume" rows="4" 
              placeholder="Le résumé du chapitre" required></textarea><br />
	<textarea id="content" name="content" rows="20" 
              placeholder="Le chapitre" required></textarea><br />
	 <input id="auteur" name="auteur" type="text" placeholder="L'auteur" 
           required /><br />
    
    <input type="submit" value="Insérer dans le livre" />

	
</form>

<?php

$contentView=ob_get_clean(); 
$footerView="";

require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php'); 