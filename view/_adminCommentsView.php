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
		
		<div class="formChapitre center">
			<form method="post" action="index.php?_validComments"  >
				<div class="collection">
				<?php
				for($i=0;$i<count($datas);$i++)
				{
					?>
					
					<div class="panel panel-default">
						<div class="row ">
							<div class="col-lg-6 panel-heading">
								<div class=" panel-collapse collapse in">
									<p id="name"><?= htmlspecialchars($datas[$i]->getName()) ?> </p>
									<input name="<?= htmlspecialchars($datas[$i]->getIdcomments()) ?>" type="hidden" id="<?= $datas[$i]->getIdcomments() ?>"  />
									
									<p id="content"><?= $datas[$i]->getContent() ?> </p>
									<?php
										if($datas[$i]->getSignaled() ){
											?>
											<span class="btn btn-warning ">
												<p class = " glyphicon glyphicon-exclamation-sign"> Commentaire signalé</p>
											</span>
											<?php
										} 
									?>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-control">
									<?php
										foreach ($params['status'] as $key => $value){										
											if($datas[$i]->getStatus_IdStatus()==$key){echo "<p>Statut du commentaire : <i>".$value."</i></p> ";} 
										}
									?>
								</div>
								<div class=" form-control">
									<label for="<?="action".$datas[$i]->getIdcomments() ?>">A modifier</label>
									<input type="checkbox" name="actionAFaire[]" id="<?= "action".$datas[$i]->getIdcomments() ?>" value="<?= $datas[$i]->getIdcomments() ?>" />	
								
								</div>
							</div>
							
						</div>
					</div>
					<?php 
				}
				
				?>
				</div>
				<div class="row">
					<select class="browser-default col-lg-5 " name="choix" >
						<option value="" disabled selected class="form-control">Choisissez l'opération à réaliser</option>
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
					<span class=" col-offset-1 col-lg-5  ">
						<input type="submit" class="glyphicon glyphicon-ok-sign btn btn-success " value="Appliquer les changements"/>
					</span> 				
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


		
		