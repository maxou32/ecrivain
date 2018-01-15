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
		<script language="javascript" type="text/javascript">
			function changeStatus($comment,$status) {
				document.getElementById($comment).value=$status;
				document.getElementById("action"+$comment).checked=true;
			}
		</script>	
		<div class="formChapitre center">
			<form method="post" action="index.php?_validComments"  >
				<div class="collection">
				<?php
				for($i=0;$i<count($datas);$i++)
				{
					?>
					
					<div class="collection-item">
						<div class="row ">
							<div class="col s6 panel-heading">
								<div class=" panel">
									<p id="name"><?= htmlspecialchars($datas[$i]->getName()) ?> </p>
									<input name="<?= htmlspecialchars($datas[$i]->getIdcomments()) ?>" type="hidden" id="<?= $datas[$i]->getIdcomments() ?>"  />
									
									<p id="content"><?= $datas[$i]->getContent() ?> </p>
									<?php
										if($datas[$i]->getSignaled() ){
											?>
											<p class = "waves-light btn-large right orange darken-1">Commentaire signalé <i class="material-icons">info</i> </p>
											<?php
										} 
									?>
								</div>
							</div>
							<div class="col s6">
								<div>
									<?php
										foreach ($params['status'] as $key => $value){		
											?>
											<input name="<?= "R".$datas[$i]->getIdcomments() ?>" type="radio" class="with-gap" id="<?= $datas[$i]->getIdcomments().$value ?>" 
												<?php if($datas[$i]->getStatus_IdStatus()==$key){echo "checked";}?> 
												onClick='javascript:changeStatus("<?= $datas[$i]->getIdcomments() ?>","<?= $key ?>")'
											/>
											<label for="<?= $datas[$i]->getIdcomments().$value ?>"><?= $value ?></label>
											<?php
										}
									?>
								</div>
								<div >
									<input type="hidden" name="actionAFaire[]" id="<?= "action".$datas[$i]->getIdcomments() ?>" value="<?= $datas[$i]->getIdcomments() ?>" />	
								</div>
							</div>
							
						</div>
					</div>
					<?php 
				}
				
				?>
				</div>
				<div class="row">											
					<span  class=" waves-effect waves-light btn-large blue">
						<input type="submit" name="sousAction" value="Mettre à jour"><i class="material-icons left">build</i>
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


		
		