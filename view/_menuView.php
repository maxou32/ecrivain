<?php
ob_start(); 
?>

<div id="barre_menu">
	<div id= "logo">															<!-- logo et nom société -->
		<a href="#">
			<img src="" alt="Mon voyage en Alaska" title="Alaska">
		</a>
	</div>
	<nav id="menu">
		<ul id="menu">
			<li><a href="index.php?action=listValidChapter" class="item_menu">Accueil</a></li>
			<li><a href="#" class="item_menu">Derniers chapitres</a></li>
			<li><a href="#" class="item_menu">Contact</a></li>
			<li><a href="#" class="item_menu">Accès réservé</a></li>
			<li><a href="index.php?action=askAddOneChapter" class="item_menu">Création article</a></li>
		</ul>
	</nav>
	<p id="souslogoflottant"></p>												<!-- fin "flottage" du menu -->
</div>
	
<?php

$menuView=ob_get_clean(); 
