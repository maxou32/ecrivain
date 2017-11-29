<!-- vue d'un chapitre

affichage titre du blog

affichage menu

transformation écran en variable (ob_start)

titre de la page : liste des chapitre déjà parus

affichage du chapitre

boucle sur les commentaires
	
		affichage contenu du commentaire (p et protégé)
		affichage auteur
		affichage date de création
		
fin boucle (close cursor)

stockage variable (ob_get_clean)

appel templateOneChapter
-->

<?php 
	$title="Voyage en Alaska"; 
	ob_start(); 
?>
	
	<!-- affichage menu   -->
<h1> Mon voyage en Alaska </h1>
<div class ="chapter">	

	<!-- A voir avec SANDY pour traiter le cas des caractères accentués  -->

	<h2> <?php //htmlspecialchars($chapters[$i]->getTitle()) ?> </h2> 
	<h2 id="title"> <?= $chapter->getTitle() ?> </h2>
	<p><em id="dateCreation">rédigé le : <?= htmlspecialchars($chapter->getDateFr()) ?></em></p>
	<p id="resume"><?= htmlspecialchars($chapter->getContent()) ?> </p>
	<div	
		<?php
		if(!isset($_SESSION['user'])){
			?>style="display:none;"<?php
		}else{
			?>style="display:block;"<?php
		}
		?>
		>
		<form method="post" action="index.php?action=deleteChapter&amp;Idchapters=<?= $chapter->getIdchapters()?>" class="formChapitre">
			<input type="submit" value="Supprimer le chapitre en cours">
		</form>
		<form method="post" action="index.php?action=askUpdateChapter&amp;Idchapters=<?= $chapter->getIdchapters()?>" class="formChapitre">
			
			<input type="submit" value="Modifier le contenu du chapitre">
		</form>
	</div>
</div>


	
<?php 


$captionMessage ="";
$message="";
require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
$contentView=ob_get_clean(); 

require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php'); 
	
	


		
		