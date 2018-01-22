<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
		
class _createOneChapterView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	
	public function show($params,$datas){
		
		$this->params=$params;
			
		ob_start(); 
		
			?>
			<div class="row">	
				<div class="card-panel col m8 offset-m2 s12 formChapitre">
					<form method="post" action="index.php?addOneChapter" class="orange lighten-5">
						
						<div class ="col  m6 offset-m1 s12 ">
							<label for ="title" >titre</label><br />
							<input id="title" name="title" type="text"  value ="" required /><br />
						</div>
						<div class="center-align col m4 s12">
							<label for="dateFr">Date de création</label>
							<input id="dateFr" name="dateFr" type="date" class="center-align" value="" required />
						</div>
						
						
						<div class="col m12 s12">
							<label>Contenu du chapitre</label><br />
							<textarea id='content' name='content' class='texteChapitre'></textarea><br /> 
							<input id="number" name="number" type="hidden"  value ="999" required /><br />
						</div>	
						<div class="row">
							<span  class="col m4 s12 offset-m4 center-align  waves-effect waves-light btn-large blue">
								<input type="submit" name="sousAction" value="Ajouter ce chapitre"><i class="material-icons left">build</i>
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
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
			
	}
}

		
		