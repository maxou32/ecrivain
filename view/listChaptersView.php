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

for($i=0;$i<count($chapters);$i++)
{
	
	?>
	<div class ="chapter">	
		<!-- A voir avec SANDY pour traiter le cas des caractères accentués  ->
		<h2 id="title"> <?php //htmlspecialchars($chapters[$i]->getTitle()) ?> </h2> 
		<h2 id="title"> <?= $chapters[$i]->getTitle() ?> </h2>
		
		<p><em id="dateCreation">rédigé le : <?= htmlspecialchars($chapters[$i]->getDateFr()) ?></em></p>
		<p id="resume"><?= htmlspecialchars($chapters[$i]->getResume()) ?> 
			<a href='#'>  (lire la suite...)</a>
		</p>
		
	</div>
	
<?php 

}
//$chapters->closeCursor();
$captionError ="";
$error="";
require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
$contentView=ob_get_clean(); 



?>

<?php require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php'); ?>
	
	


		
		