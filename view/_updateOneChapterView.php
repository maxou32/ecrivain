<?php 
	//namespace web_max\ecrivain;
	//require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class _updateOneChapterView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	
	public function show($params,$datas){
		
			$this->params=$params;
			
		ob_start(); 
		if ($params["action"]=="update"){
			?>	
			<form method="post" action="index.php?action=updateOneChapter&amp;Idchapters=<?= $datas->getIdchapters()?>" class="formChapitre">
			<?php	
		}else{
			?>	
			<form method="post" action="index.php?action=addOneChapter" class="formChapitre">
			<?php
		}
		?> 
			<div class="row">
				<div class="col s8">
					<label>titre</label><input id="title" name="title" type="text"  value ="<?= htmlspecialchars($datas->getTitle()) ?>" required />
				</div>
				<div class="center  col s4">
					<label>Numéro</label>
					<input id="number" name="number" type="text" value="<?= htmlspecialchars($datas->getNumber()) ?>" required />
					<label>Date de création</label><br />
					<input id="dateFr" name="dateFr" type="text" value="<?= htmlspecialchars($datas->getDateFr()) ?>" required />
					<select class="input-field" name="Status_IdStatus" value="<?= $datas->getStatus_IdStatus() ?>">
						<option value ="01"> Validé</option>
						<option value ="02" />à validé</option>
						<option value ="03" />Refusé</option>
					</select>
			</div>						
				</div>
				<textarea id='content' name='content' ><?= $datas->getContent() ?> </textarea><br /> 
							
				<input type="submit" name="sousAction" value="Mettre à jour" class="button">
				<input type="reset" name="sousAction" value="Annuler les modifications" class="button">
			
		</form>
		<?php

		$contentView=ob_get_clean(); 	
		
		$menuView=$this->renderTop();
		$asideView=$this->renderAside();
 
				
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	
		//echo "<br / >content view ".$contentView;
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show();
			
	}
}

		
		