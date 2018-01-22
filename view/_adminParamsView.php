<?php 
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _adminParamsView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		//$message=$params['message'];
		ob_start();  
			
		?>
		<script language="javascript" type="text/javascript">
			function changeStatus($status) {
				document.getElementById("idstatus").value=document.getElementById("idstatus"+$status).value;
				document.getElementById("libelle").value=document.getElementById("libelle"+$status).value;
			}			
		</script>	
		<div class="row">
			<div class="card-panel col m4 offset-m4 s12">
				<form method="post" action="index.php?CRUDStatus" name="listeStatus">
					<h4>Liste des statuts utilisés</h4>
					<?php
					for($i=1;$i<=count($datas);$i++)
					{
						?>
						<div class=" orange lighten-5">
							<input type="text" class="col m2 offset-m2 center-align" name="idstatusLu" id="<?= "idstatus".$i ?>" value="<?= $i  ?>" disabled="disabled"/>
							<input type="text" class="col m4 offset-m2" name="libellelu" value="<?= htmlspecialchars($datas[$i])?>" id="<?= "libelle".$i ?>" onChange='javascript:changeStatus("<?= $i ?>")' />
							<input type="checkbox" name="actionAFaire[]" id="<?= "action".$i ?>" value="<?= $i ?>" />
						</div>
						<?php 
					}
					?>
					
					<div class="row">
						<div class=" orange lighten-5">
							<input type="hidden" class="col m2 offset-m2 center-align" name="idstatus" id="idstatus" />
							<input type="hidden" class="col m4 offset-m2" name="libelle" id="libelle" />
						</div>

						<span  class="col m6 offset-m3 s6 offset-s3 center-align  waves-effect waves-light btn btn-large blue">
							<input type="submit" name="sousAction" value="Mettre à jour"><i class="material-icons left">build</i>
						</span>
						
					</div>

				</form>
			</div>

		</div>
		<?php
		$title=Null; 
		$contentView=ob_get_clean(); 		
		$menuView=$this->renderTop();
		$asideView=Null;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
	}
}	


		
		