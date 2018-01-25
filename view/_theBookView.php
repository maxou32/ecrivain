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
		$chapitre=$datas['data']->getNumber();
		?>
		<script type="text/javascript">
			window.onload =  function(e){
				if (<?= $chapitre ?> === <?= $datas['mini']['valeur'] ?>){
					$('#previous').css({visibility:'hidden'});
				}else{
					$('#previous').css({visibility:'visible'});
				};
				if (<?= $chapitre  ?> === <?= $datas['maxi']['valeur'] ?>){
					$('#next').css({visibility:'hidden'});
				}else{
					$('#next').css({visibility:'visible'});
				};
			};
		</script>
		
		
		<div class ="row">
			<div class="formBook col m8">
				<div class="carousel-item " href="<?= htmlspecialchars( $datas['data']->getNumber()) ?>">
					<h3><?= $datas['data']->getTitle() ?></h3>

					<em id="dateCreation" class="right-align">rédigé le : <?= htmlspecialchars($datas['data']->getDateFr()) ?></em>
					<p><?= $datas['data']->getContent() ?></p>
				</div>
				<div class="row">
					<form method="post" id="previous"  class="col s5" name="changePage" action="index.php?_ThePreviousBookView/chap/<?= htmlspecialchars($chapitre) ?>">
						<span  class=" waves-effect waves-light  btn btn-large blue">
							<input type="submit" name="sousAction" value="précédent"><i class="material-icons left">navigate_before</i>
						</span>
					</form>
					<div class="col s2"></div>
					<form method="post" id="next"  class="col s5 right-align"  name="changePage" action="index.php?_TheNextBookView/chap/<?= $chapitre ?>">
						<span  class=" waves-effect waves-light btn btn-large blue">
							<input type="submit" name="sousAction" value="Suivant" class="right-align"><i class="material-icons right">navigate_next</i>
						</span>
					</form>
					
				</div>
				<div class="row jumbotron card-panel hoverable orange lighten-4">
					<h4>Ajoutez un commentaire :</h4>
				
					<form method="post" name="addComment" action="index.php?addComment/chap/<?= htmlspecialchars($datas['data']->getNumber()) ?>" >
						<input type="hidden" name="chapter" id="chapter" value="<?= htmlspecialchars($datas['data']->getIdchapters()) ?>"/>
						
						<div class="col s6">				
							<label for="name" class="active">Votre nom</label>
							<input type="text" name="name" id="name"  class="form-control validate" pattern='[a-zA-Zéèêïë ]*' title="Seules les lettres sont admises"/>						
						</div>
						<div class="col s6">
							<label for="email" class="active">Votre email</label>
							<input type="email" name="email" id="email" class="form-control validate"  />
							
						</div>
						<div class="col s12">
							<label for="content" class="active">Texte du message</label>
							<textarea name="content" id="content" type="text" /></textarea>
							<br />
						</div>
						<div class="row">
							<span class="col s4 offset-s4 waves-effect waves-light btn btn-large blue">
								<input type="submit" name="sousAction" value="Soumettre" class="right-align"><i class="material-icons left">send</i>
							</span>
						</div>
					</form>
				</div>
				<?php
					$monCommentView=new _CommentView($params);	
					$CommentView=$monCommentView->show();	
				?>
			</div>
			<div class="col m4 hide-on-med-and-down">
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


		
		