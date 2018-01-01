<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _AdminCommentsView extends View{	
	public function __construct($template){
		$this->template =$template;
	}

	public function show($params,$datas){		
		ob_start(); 
		
		//echo"<PRE>";print_r($datas);echo"</PRE>";
		?>
		
		<div id="center">
			<form method="post" action="index.php?_validComments"  >
				<script language="javascript" type="text/javascript">
					function changeStatus($comment,$status) {
						document.getElementById($comment).value=$status;
					}
					function changeStatus($comment,$grade) {
						document.getElementById($comment).value=$grade;
					}
				</script>	
				<ul class="collection">
				<?php
				for($i=0;$i<count($datas);$i++)
				{
					?>
					<li class="collection-item">
						<div class="row">
							<div class="col s6">
								<p id="name"><?=$datas[$i]->getName() ?> </p>
								<input name="<?=$datas[$i]->getIdcomments() ?>" type="hidden" id="<?= $datas[$i]->getIdcomments() ?>"  />
								
								<p id="content"><?=$datas[$i]->getContent() ?> </p>
								
							</div>
							
							<div class="col s3 center">
								<?php
									foreach ($params['status'] as $key => $value){										
										if($datas[$i]->getStatus_IdStatus()==$key){echo "<p>Statut du commentaire :</p> <i>".$value."</i>";} 
										
									}
									?>
							</div>
							<div class="col s3">
								
								<input type="radio" class="filled-in" name="valide[]" id="<?= "valide".$datas[$i]->getIdcomments().$key ?>" value="<?= "C".$datas[$i]->getIdcomments() ?>" />
								<label for="<?="valide".$datas[$i]->getIdcomments().$key ?>">Valide</label>
								
								<input type="radio" class="filled-in" name="aValider[]" id="<?= "aValider".$datas[$i]->getIdcomments().$key ?>" value="<?= "C".$datas[$i]->getIdcomments() ?>" />
								<label for="<?="aValider".$datas[$i]->getIdcomments().$key ?>">A valider</label>
								
								<input type="radio" class="filled-in" name="invalide[]" id="<?= "invalide".$datas[$i]->getIdcomments().$key ?>" value="<?= "C".$datas[$i]->getIdcomments() ?>" />
								<label for="<?="invalide".$datas[$i]->getIdcomments().$key ?>">Invalide</label>				
								
								<input type="radio" class="filled-in" name="detruire[]" id="<?= "detruire".$datas[$i]->getIdcomments().$key ?>" value="<?= "C".$datas[$i]->getIdcomments() ?>"/>
								<label for="<?="detruire".$datas[$i]->getIdcomments().$key ?>">A détruire</label>
								
							</div>
						</div>
					</li>
					<?php 
				}
				?>
				</ul>
				<div class="center">
					<p><input type="submit" name="sousAction" value="Appliquer les changements" class="button center"></p>
				</div>
			</form>
			
		</div>
		<?php
		//$title="Voyage en Alaska"; 
		$contentView=ob_get_clean(); 		
		$menuView=$this->renderTop();
		$asideView=Null;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(NULL,NULL);
	}
}	


		
		