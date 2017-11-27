<?php
ob_start(); 
?>

<aside id="barreAside">
	
	<div">
		<ul id="choixAside">
			<li><a href="index.php?action=listValidChapter" class="item_menu">Accueil</a></li>
			<li><a href="#" class="item_menu">Derniers chapitres</a></li>
			<li><a href="#" class="item_menu">Contact</a></li>
			<li><a href="#" class="item_menu">Accès réservé</a></li>
		</ul>
	</div>
											<!-- fin "flottage" du menu -->
</aside>
	
<?php

$asideView=ob_get_clean(); 
