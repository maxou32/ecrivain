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
			<li><a href="index.php?action=askAddOneChapter" class="item_menu">Enregistrement d'un chapitre</a></li>
			<li><a href="index.php?action=abortAccess" class="item_menu">Deconnexion</a></li>
			
		</ul>
	</nav>
	<p id="souslogoflottant"></p>												<!-- fin "flottage" du menu -->
</div>
	
<?php

$menuView=ob_get_clean(); 
