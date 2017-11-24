<!-- vue liste des chapitres

affichage titre du blog

affichage menu

transformation écran en variable (ob_start)

titre de la page : liste des chapitre déjà parus

boucle sur liste des chapitres
	
		affichage titreChapitre (h2 et protégé)
		affichage dateChapitre (italique et protégé)
		affichage resuméChapitre (p et protégé)
		
fin boucle (close cursor)

stockage variable (ob_get_clean)

appel templateListChapters
-->
<?php 
	$title="Voyage en Alaska"; 
	ob_start(); 
	
	
?>
	
	<!-- affichage menu   -->
<h1> Mon voyage en Alaska </h1>

<?php

while ($chapter = $chapters->fetch())
{
	?>
	<div class ="chapter">	
		
		<p id="title"> <?= htmlspecialchars($chapter['title']) ?> </p>
		<p id="dateCreation">rédigé le : <?= htmlspecialchars($chapter['date_fr']) ?></p>
		<p id="resume"><?= htmlspecialchars($chapter['resume']) ?> 
			<a href='#'>lire la suite...</a>
		</p>
	</div>
	
<?php 

}
$chapters->closeCursor();
$captionError ="";
$error="";
require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
$contentView=ob_get_clean(); 



?>

<?php require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php'); ?>
	
	


		
		