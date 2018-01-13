<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _AdminUsersView extends View{	
	public function __construct($template){
		$this->template =$template;
	}

	public function show($params,$datas){		
		ob_start(); 
		
		//echo"<PRE>";print_r($params);echo"</PRE>";
		?>
		
		<div class="formChapitre center">
			<form method="post" action="index.php?_validUsers"  >
				<script language="javascript" type="text/javascript">
					function changeStatus($user,$status) {
						document.getElementById($user).value=$status;
					}
					function changeStatus($user,$grade) {
						document.getElementById($user).value=$grade;
					}
				</script>	
				<div class="collection">
				<?php
				for($i=0;$i<count($datas);$i++)
				{
					?>
					<div  class="collection-item">
						<div class="row">
							<div class="col s6">
								<p id="content"><?=$datas[$i]->getName() ?> 
								<input name="<?=$datas[$i]->getIdusers()  ?>" type="hidden" id="<?= $datas[$i]->getIdusers() ?>"  />
								</p>
							</div>
							<div class="col s3">
								
								<?php
									foreach ($params['grade'] as $key => $value){
										?>
										<input name="<?= "G".$datas[$i]->getIdusers() ?>"  type="radio" id="<?="gradeUsers".$datas[$i]->getIdusers().$key ?>" <?php if($datas[$i]->getGrade_IdGrade()==$key){echo "checked";} ?> onClick='javascript:changeGrade("<?= $datas[$i]->getIdusers() ?>","<?=$key ?>")' value=" <?= $key ?>" />
										<label for="<?="gradeUsers".$datas[$i]->getIdusers().$key ?>"  ><?= $value ?></label>
										<br/>
										<?php
									}
								?>
								<br/>
							</div>
							<div class="col s3">
								<?php
									foreach ($params['status'] as $key => $value){
										?>
										<input name="<?= "S".$datas[$i]->getIdusers() ?>" type="radio" id="<?="statusUsers".$datas[$i]->getIdusers().$key ?>" <?php if($datas[$i]->getStatus_IdStatus()==$key){echo "checked";} ?> onClick='javascript:changeStatus("<?= $datas[$i]->getIdusers() ?>","<?=$key ?>")' value="<?= $key ?>" /> 
										<label for="<?="statusUsers".$datas[$i]->getIdusers().$key ?>"  ><?= $value ?></label>
										<br/>
										<?php
										
									}
								?>
								
							</div>
						
						</div>
					</div>
					<?php 
				}
				?>
				</div>

					<button type="submit" class=" btn btn-success  glyphicon glyphicon-ok-sign">
						 Mettre à jour
					</button>
				
				
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


		
		