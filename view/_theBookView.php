<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
use web_max\ecrivain\view\_AsideView;
use web_max\ecrivain\view\_CommentView;
	
class _TheBookView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		ob_start();  			
		//echo "<br /><pre>THE BOOK VIEW 1 = ";print_r($params["aside"]);echo"</pre>";
		
		?>
		<div class ="row">
			<div class="col-xs-1 col s1"></div>
			<div class="formBook col-xs-7 col s7">
				<div class="carousel-item " href="<?= htmlspecialchars( $datas->getNumber()) ?>">
					<h3><?= $datas->getTitle() ?></h3>

					<em id="dateCreation">rédigé le : <?= htmlspecialchars($datas->getDateFr()) ?></em>
					<p class="flow-text"><?= $datas->getContent() ?></p>
				</div>
				
				<ul class="pagination pagination-lg">
				<?php 
				for($i=0;$i<$params["nbChapters"];$i++)
				{
					$j=$i+1;
					?>
					<li class="waves-effect"><a href="index.php?_TheBookView/chap/<?= $j?>"><?=  $j ?></a>
				<?php 
				}
				?>
				</ul>

				<div class="jumbotron"><h4>Ajoutez un commentaire :</h4></div>
				<form method="post" name="addComment" action="index.php?addComment/chap/<?= htmlspecialchars($datas->getNumber()) ?>" >
					<input type="hidden" name="chapter" id="chapter" value="<?= htmlspecialchars($datas->getIdchapters()) ?>"/>
					
					<div class="col-xs-6 col s6">				
						<label for="name" class="active">Votre nom</label>
						<input type="text" name="name" id="name"  class="form-control"/>						
					</div>
					<div class="col-xs-6 col s6">
						<label for="email" class="active">Votre email</label>
						<input type="text" name="email" id="email" class="form-control" />
						
					</div>
					<label for="content" class="active">Texte du message</label><textarea name="content" id="content" type="text" /></textarea>
					<button type="submit" name="sousAction" value="Soumettre" class="btn btn-primary">
						<span class="glyphicon glyphicon-ok-sign"></span>
						soumettre
					</button>
				</form>
				<?php
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
		</div>
		<?php


		
		$contentView=ob_get_clean(); 		
		$menuView=$this->renderTop();

		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(NULL,NULL);
	}
}	


		
		