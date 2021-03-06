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
	
	public function show($params, $datas){
		
		$this->params=$params;
					
		ob_start(); 
		//echo"<PRE> READ ONE CHAPTER VIEW 1: Datas ";print_r($datas);echo"</PRE>";
		?>
		
		<div class="row">
			<div class="formChapitre col m6 offset-m1 s12">
				<div class="row">
					<div  class="col m8 s12">
						<h4 class="panel-title"><?= htmlspecialchars($datas->getTitle()) ?></h4>
					</div>
					<div class="col m4 center-align">
						<br /><label>Date de création</label><br />
						<?= htmlspecialchars($datas->getDateFr()) ?><br />
						
						<label>Numéro d'ordre du chapitre</label><br />
						<?= $datas->getNumber() ?><br />
					</div>	
				</div>
				<?= $datas->getContent() ?>
				<?php 
				if(isset($params['updateDeleteAreAutorized'])){
					if ($params['updateDeleteAreAutorized']){
						?>
						<div class="row">
							<form class="col s12 center-align" method="post" action="index.php?askUpdateOneChapter/idchapter/<?= $datas->getIdchapters()?>" >
								<span  class=" waves-effect waves-light btn-large blue">
									<input type="submit" name="sousAction" value="Mettre à jour"><i class="material-icons left">build</i>
								</span>
								<input id="idChapter" name="idchapter" type="hidden"  value ="<?= htmlspecialchars($datas->getIdchapters()) ?>" />
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
			<div class="col m4 offset-m1 hide-on-med-and-down">
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
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
			
	}
}
	