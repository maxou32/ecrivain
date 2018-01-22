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
		
		?>
		<script language="javascript" type="text/javascript">
			function changeStatus($user,$status) {
				document.getElementById($user).value=$status;
				document.getElementById("action"+$user).checked=true;
			}
			function changeGrade($user,$grade) {
				document.getElementById($user).value=$grade;
				document.getElementById("action"+$user).checked=true;
			}
			function detruit($user) {
				document.getElementById("action"+$user).checked=true;
			}
		</script>			
		<div class="row">
			<div class="card-panel col s12 m8 offset-m2">
				<form method="post" action="index.php?_validUsers" class="formChapitre " >
					<?php
					for($i=0;$i<count($datas);$i++)
					{
						?>
						<div  class="collection-item ">
							<div class="row card-panel orange lighten-5">
								<div class="col m4 s12 center-align">
									<h4 id="content"><?=$datas[$i]->getName() ?> 
									<input name="<?=$datas[$i]->getIdusers()  ?>" type="hidden" id="<?= $datas[$i]->getIdusers() ?>"  />
									</h4>
								</div>
								<div class="col m3 offset-m1 s6 left-align">
									<?php
										foreach ($params['grade'] as $key => $value){
											?>
											<input name="<?= "G".$datas[$i]->getIdusers() ?>"  class="blue"type="radio" id="<?="gradeUsers".$datas[$i]->getIdusers().$key ?>" <?php if($datas[$i]->getGrade_IdGrade()==$key){echo "checked";} ?> onClick='javascript:changeGrade("<?= $datas[$i]->getIdusers() ?>","<?=$key ?>")' value=" <?= $key ?>" />
											<label for="<?="gradeUsers".$datas[$i]->getIdusers().$key ?>" ><?= $value ?></label>
											<?php
										}
									?>
									<br/>
								</div>
								<div class="col m2 offset-m1 s6 left-align">
									<?php
										foreach ($params['status'] as $key => $value){
											?>
											<input name="<?= "S".$datas[$i]->getIdusers() ?>" type="radio" id="<?="statusUsers".$datas[$i]->getIdusers().$key ?>" <?php if($datas[$i]->getStatus_IdStatus()==$key){echo "checked";} ?> onClick='javascript:changeStatus("<?= $datas[$i]->getIdusers() ?>","<?=$key ?>")' value="<?= $key ?>" /> 
											<label for="<?="statusUsers".$datas[$i]->getIdusers().$key ?>"  ><?= $value ?></label>
											<?php
										}
									?>
								</div>
							
								<div class="row">
									<input class="left-align" name="<?= "D".$datas[$i]->getIdusers() ?>" class="center-align " type="checkbox" id="<?="D".$datas[$i]->getIdusers()?>" value="<?="D".$datas[$i]->getIdusers() ?>" onClick='javascript:detruit("<?= $datas[$i]->getIdusers() ?>")'/> 
										<label class="red-text" for="<?="D".$datas[$i]->getIdusers()?>" >    Supprimer cet utilisateur</label>
									<input type="checkbox" name="actionAFaire[]" id="<?= "action".$datas[$i]->getIdusers() ?>" value="<?= $datas[$i]->getIdusers() ?>" />	
								</div>
							</div>
						</div>	
						<?php 
					}
					?>

					<div class="row">											
						<span  class="col m4 s12 offset-m4 center-align  waves-effect waves-light btn-large blue">
							<input type="submit" name="sousAction" value="Mettre à jour"><i class="material-icons left">build</i>
						</span>
					</div>			
				</form>
			</div>			
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


		
		