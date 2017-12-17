<?php 
	//namespace web_max\ecrivain;
	//require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class _createOneChapterView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	
	public function show($params,$datas){
		
		$this->params=$params;
			
		ob_start(); 
		
			?>	
			<form method="post" action="index.php?action=addOneChapter" class="formChapitre">
					
				<label>titre</label><br />
				<input id="title" name="title" type="text"  value ="" required /><br />
				<label>Date de création</label><br />
				<input id="dateFr" name="dateFr" type="text" value="
				<?php 
					$date = date("d-m-Y");
					list($finDate) = preg_split('/ /',$date);
					list($finAnnee,$finMois,$finJr) = preg_split('/-/',$finDate);					
					echo $finJr.'/'.$finMois.'/'.$finAnnee;
				?>" required><br />
				<label>Contenu du chapitre</label><br />
				<textarea id='content' name='content' ></textarea><br /> 
				<label>Numéro</label><br />
				<input id="number" name="number" type="text"  value ="" required /><br />
				
				<input type="submit" name="sousAction" value="Ajouter ce chapitre"  class="button">
				<input type="reset" name="sousAction" value="Annuler les modifications"  class="button">
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

		
		