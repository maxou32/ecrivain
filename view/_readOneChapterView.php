<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
use web_max\ecrivain\view\_AsideView;	
use web_max\ecrivain\view\_CommentView;

class _readOneChapterView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	
	public function show($params,$datas){
		
		$this->params=$params;
					
		ob_start(); 
		?>
		<div class="row">
			<div class="col-xs-1 col s1"></div>
			<div class="col-xs-7 formChapitre  col s7">
				
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div  class="col-xs-8">
								<h4 class="panel-title"><?= htmlspecialchars($datas->getTitle()) ?></h4>
							</div>
							<div class="col-xs-4">
								<label>Date de création</label><br />
								<?= htmlspecialchars($datas->getDateFr()) ?><br />
								
								<label>Numéro d'ordre du chapitre</label><br />
								<?= $datas->getNumber() ?><br />
							</div>	
						</div>
					</div>
					<?= $datas->getContent() ?>
						
				</div>
				<?php 
				if(isset($params['updateDeleteAreAutorized'])){
					if ($params['updateDeleteAreAutorized']){
						?>
						<div class="row">
							<form class="col-lg-6 col" method="post" action="index.php?askUpdateOneChapter/idchapter/<?= $datas->getIdchapters()?>" >
								<input type="submit" name="sousAction" value="Mettre à jour" class="button">
								<input id="idChapter" name="idchapter" type="hidden"  value ="<?= htmlspecialchars($datas->getIdchapters()) ?>" />
							</form>
							<form class="col-lg-6 col" method="post" action="index.php?deleteOneChapter/idchapter/<?= $datas->getIdchapters()?>" >
							   <input id="idChapter" name="idchapter" type="hidden"  value ="<?= htmlspecialchars($datas->getIdchapters()) ?>" />
								<input type="submit" name="sousAction" value="Supprimer" class="button">
							</form>
						</div>
						<?php 
					}
				}
				//echo "<pre> READONECHPATER params ";print_r($params);echo"</pre>";
				$monCommentView=new _CommentView($params);	
				$CommentView=$monCommentView->show();	
				?>
			</div>
			<div class="col-xs-1 col s1"></div>
			<div class="col-xs-2 col s2">
				<?php
					$monAsideView=new _AsideView($params);	
					$asideView=$monAsideView->show();	
				?>
			</div>
		<div>
		<?php

		$contentView=ob_get_clean(); 	
		
		$menuView=$this->renderTop();
			
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	
		//echo "fin chargement ";
		//echo "<br / >content view ".$contentView;
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
			
	}
}
	