<?php
$title="Voyage en Alaska"; 
ob_start(); 
?>

<form method="post" action="index.php?action=registration" class="formUser">
	<input id="userName" name="userName" type="text" placeholder="Indiquez votre nom" required /><br />
    <input id="userPwd" name="userPwd" type="password"  placeholder="Saisissez votre mot de passe" pattern=".{5,}" title="5 caractères minimum" required><br />
	<input id="mail" name="mail" placeholder="Votre adresse mail" required><br />
	
	<br /><input type="submit" value="Soumettre votre demande" />
</form>

<?php

$contentView=ob_get_clean(); 
$footerView="";

require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php'); 