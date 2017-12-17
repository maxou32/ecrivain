<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _readOneChapterView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	
	public function show($params,$datas){
		
		$this->params=$params;
					
		ob_start(); 
		?>
		<div class="formChapitre">
			<input id="idChapter" name="idChapter" type="hidden"  value ="<?= htmlspecialchars($datas->getIdchapters()) ?>" /><br />
			<div class="row">
				<div class="col s8">
					<h4><?= htmlspecialchars($datas->getTitle()) ?></h4><br />
				</div>
				<div class="center col s4">
					<label>Date de création</label><br />
					<?= htmlspecialchars($datas->getDateFr()) ?><br />
					
					<label>Numéro d'ordre du chapitre</label><br />
					<?= $datas->getNumber() ?><br />
				</div>
			</div>
			<?= $datas->getContent() ?><br />
			
			
			<?php 
			if ($params['updateDeleteAreAutorized']){
				?>
				<form method="post" action="index.php?action=updateDeleteOneChapter&amp;Idchapters=<?= $datas->getIdchapters()?>" class="formChapitre">

					<input type="submit" name="sousAction" value="Mettre à jour" class="button">
					<input type="submit" name="sousAction" value="Supprimer" class="button">
					<input type="submit" name="sousAction" value="Fermer"  class="button"/>
				</form>
				<?php 
			}
			?>
		<div>
		<?php

		$contentView=ob_get_clean(); 	
		
		$menuView=$this->renderTop();
		$asideView=$this->renderAside();
 
				
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	
		echo "fin chargement ";
		//echo "<br / >content view ".$contentView;
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
			
	}
}
	