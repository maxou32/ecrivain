<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _updateOneChapterView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	
	public function show($params,$datas){
		
			$this->params=$params;
			
		ob_start(); 
			?>	
			<form method="post" action="index.php?updateOneChapter" class="formChapitre">
				<div class="row">
					<div class="col s9">
						<label>titre</label><input id="title" name="title" type="text"  value ="<?= htmlspecialchars($datas->getTitle()) ?>" required />
					</div>
					<div class="center col s3">
						<label>Numéro</label><br />
						<input class="center" id="number" name="number" type="text" value="<?= htmlspecialchars($datas->getNumber()) ?>" required />
						<label>Date de création</label><br />
						<input class="center" id="dateFr" name="dateFr" type="text" value="<?= htmlspecialchars($datas->getDateFr()) ?>" required />
						<label>status du chapitre</label>
						<select class="input-field" name="Status_IdStatus" value="<?= $datas->getStatus_IdStatus() ?>">
							<option value ="01" /> Validé</option>
							<option value ="02" />à validé</option>
							<option value ="03" />Refusé</option>
						</select>
						<input class="center" id="idchapter" name="idchapter" type="hidden" value="<?= $datas->getIdchapters()?>" required />
					</div>						
				</div>
				<textarea id='content' name='content' rows="10" cols="50" class="texte"><?= $datas->getContent() ?> </textarea><br /> 
							
				<input type="submit" name="sousAction" value="Mettre à jour" class="button">
				<input type="reset" name="sousAction" value="Annuler les modifications" class="button">
			
		</form>
		<?php

		$contentView=ob_get_clean(); 	
		
		$menuView=$this->renderTop();
		$asideView=Null;
 
				
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	
		//echo "<br / >content view ".$contentView;
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
			
	}
}

		
		