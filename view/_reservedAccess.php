<?php
$title="Voyage en Alaska"; 
ob_start(); 
?>
<form method="post" action="index.php?action=validAccessReserved" class="formChapitre">
    <input id="userName" name="userName" type="text" placeholder="Saisissez votre nom" 
           required /><br />
    <input id="userPwd" name="userPwd" type="password"  required><br />
	    
    <input type="submit" value="Accéder à l'espace réservé" />

	
</form>

<?php

$contentView=ob_get_clean(); 
$footerView="";

require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php'); 