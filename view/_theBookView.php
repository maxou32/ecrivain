<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
use web_max\ecrivain\view\_AsideView;
	
class _TheBookView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		ob_start();  			
		
		?>
		<div class ="row">
			<div class="col s1"></div>
			<div class="formBook col s7">
				<div class="carousel-item " href="<?= $datas->getNumber() ?>">
					<h3><?= $datas->getTitle() ?></h3>

					<em id="dateCreation">rédigé le : <?= $datas->getDateFr() ?></em>
					<p class="flow-text"><?= $datas->getContent() ?></p>
				</div>
				
				<ul class="pagination center">
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

				<p>Ajoutez un commentaire :</p>
				<form method="post" name="addComment" action="index.php?addComment/chap/<?= $datas->getNumber() ?>" >
					<input type="hidden" name="chapter" id="chapter" value="<?= $datas->getIdchapters() ?>"/>
					
					<div class=" col s6">				
						<input type="text" name="name" id="name" />
						<label for="name" class="active">Votre nom</label>
					</div>
					<div class="col s6">
						<input type="text" name="email" id="email" />
						<label for="email" class="active">Votre email</label>
					</div>
					<label for="content" class="active">Texte du message</label><textarea name="content" id="content" type="text" /></textarea>
					<input type="submit" name="sousAction" value="Soumettre" class="button"/>
				</form>
			</div>
			<div class="col s1"></div>
			<div class="col s2">
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


		
		