<?php
ob_start(); 
?>

<aside id="aside">

	<div id="contenu">
		<ul >
			<li><a href="index.php?action=listValidChapter" class="item_menu">Accueil</a></li>
			<li><a href="#" class="item_menu">Derniers chapitres</a></li>
			<li><a href="#" class="item_menu">Contact</a></li>
			<li><a href="#" class="item_menu">Accès réservé</a></li>
		</ul>
	</div>
	<p id="souslogoflottant"></p>												<!-- fin "flottage" du menu -->
</aside>
	
<?php

$assideView=ob_get_clean(); 