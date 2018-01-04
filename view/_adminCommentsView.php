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
		
		//echo"<PRE>";print_r($params);echo"</PRE>";
		?>
		
		<div id="center">
			<form method="post" action="index.php?_validComments"  >
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
								<?php
									if($datas[$i]->getSignaled() ){
										?>
										<span class="chip orange center"><i class="material-icons left">report_problem</i>Commentaire signalé</span>
										<?php
									} 
								?>
							</div>
							
							<div class="col s3 center">
								<?php
									foreach ($params['status'] as $key => $value){										
										if($datas[$i]->getStatus_IdStatus()==$key){echo "<p>Statut du commentaire :</p> <i>".$value."</i>";} 
									}
								?>
							</div>
							<div class="col s3">
								<p></p>&nbsp;<p></p>
								<input type="checkbox" class="filled-in" name="actionAFaire[]" id="<?= "action".$datas[$i]->getIdcomments() ?>" value="<?= $datas[$i]->getIdcomments() ?>" />	
								<label for="<?="action".$datas[$i]->getIdcomments() ?>">A modifier</label>
							</div>
						</div>
					</li>
					<?php 
				}
				
				?>
				</ul>
				<div class="row">
					<select class="browser-default" name="choix" >
						<option value="" disabled selected>Choisissez l'opération à réaliser</option>
						<?php
							foreach ($params['status'] as $key => $value){
								?>
								<option  id="<?="status".$key  ?>" value="<?= $key ?>" /> 
								<label for="<?="status".$key ?>"  ><?= $value ?></label>
								<?php
							}
						?>
						<option value="D">Détruire</option>
					</select>								
					<input type="submit"value="Appliquer les changements" class=" button center">
				
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


		
		