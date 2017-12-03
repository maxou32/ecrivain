<?php
$title="Voyage en Alaska"; 
ob_start(); 
?>
<form method="post" action="index.php?action=validAccessReserved" class="formUser">
    <input id="userName" name="userName" type="text" placeholder="Saisissez votre nom" 
           required /><br />
    <input id="userPwd" name="userPwd" type="password" pattern=".{5,}" title="5 caractères minimum" required><br />
	    
    <input type="submit" value="Accéder à l'espace réservé" />

	
</form>

<form method="post" action="index.php?action=askRegistration" class="formUser">
	<br /><input type="submit" value="Demander à être inscrit" />
</form>
<form method="post" action="index.php?action=askUpdateProfil" class="formUser">
	<br /><input type="submit" value="Modifier votre profil" />
</form>

<?php

$contentView=ob_get_clean(); 
$footerView="";

require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php'); 