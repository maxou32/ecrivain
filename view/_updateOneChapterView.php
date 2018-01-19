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
				<div class="row">
					<div class="card-panel col m8 offset-m2 s12">
						<form method="post" action="index.php?updateOneChapter" class="formChapitre ">
							
							<h4 class="col m8 offset-m2 s12">
								<input id="title" name="title" type="text" value ="<?= htmlspecialchars($datas->getTitle()) ?>" required />
							</h4>
							<div class="row">
								<div class="col m2 offset-m2 s4">
									<label for="number">Numéro </label>
									<input class="center" id="number" name="number" type="text" value="<?= htmlspecialchars($datas->getNumber()) ?>" required />
								</div>
								<div class="col  m2 s4">
									<label for="dateFr" >Créé le :</label><br />
									<input class="center" id="dateFr" name="dateFr" type="text" value="<?= htmlspecialchars($datas->getDateFr()) ?>" required />
								</div>
								<div class=" col m4">
									<label>Status du chapitre</label>
									<select class="browser-default" >
										<option value =1 /> Validé</option>
										<option value =2 />à validé</option>
										<option value =3 />Refusé</option>
									</select>
									
									
									<input id="idchapter" name="idchapter" type="hidden" value="<?= $datas->getIdchapters()?>" required />
								</div>						
							</div>
							<div clas="row">
								<textarea id='content' name='content' rows="10" cols="50" class=" col m12 texteChapitre "><?= $datas->getContent() ?> </textarea><br /> 
							</div>
							<div class="center-align">
								<span  class=" waves-effect waves-light btn-large blue">
									<input type="submit" name="sousAction" value="Appliquer les modifications"><i class="material-icons left">send</i>
								</span>	
							</div>
						</form>
					</div>
				</div>
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

		
		