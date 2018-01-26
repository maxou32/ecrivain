<?php 
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _CRUDMessage extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		$message=$params['message'];
		ob_start();  
			
		?>
		<div class="row">
			<div class="formChapitre col m8 offset-m2 s12">
				<form method="post" action="messageChoised" name="listeMessage">
					<p>Liste des messages</p>
					<?php
					for($i=0;$i<count($datas);$i++)
					{
						?>
						<div class="row card-panel hoverable orange lighten-5">
							<div class="col m1 s1">
								<input type="hidden" name="id" id="id" value="<?= $datas[$i]->getId() ?>"/>
								<input type="hidden" name="contexte" value="<?= $datas[$i]->getContexte() ?>"/>
								<input type="hidden" name="number" value="<?= $datas[$i]->getNumber() ?>"/>
								<label for="number" class="black-text" title="numéro du message"  >
										<?= $datas[$i]->getNumber() ?> 
								</label>
								<input type="hidden" name="texte" value="<?= $datas[$i]->getTexte() ?>"/>
								<input type="hidden" name="idtypemessage" value="<?= $datas[$i]->getMessage_idtypemessage() ?>"/>
								<input type="radio" name="message"  value="<?= $datas[$i]->getId() ?>" id="<?= $datas[$i]->getId() ?>" onclick='javascript:change()'/>
							</div >
							<div class="col s11 m11">
								<label for="<?= htmlspecialchars($datas[$i]->getId()) ?>" id="messageLU" class="black-text" title="<?= htmlspecialchars($datas[$i]->getcontexte()) ?>"  >
										<?= htmlspecialchars($datas[$i]->getTexte()) ?> <br /> 
								</label>
							</div>
						</div>
						<?php 
					}
					?>
				</form>
			</div>
			<script language="javascript" type="text/javascript">
				function change() {
					var valeur = '';
					for (i=0; i<document.listeMessage.id.length; i++) {
						if (document.listeMessage.message[i].checked) {
							valeur = i;
						}
					}
					document.messageUpdated.contexte.value=document.listeMessage.contexte[valeur].value;
					document.messageUpdated.number.value=document.listeMessage.number[valeur].value;
					document.getElementById('texte').value=document.listeMessage.texte[valeur].value;
					document.getElementById('idtypemessage').value=document.listeMessage.idtypemessage[valeur].value;
					document.messageUpdated.id.value=document.listeMessage.id[valeur].value;
				}
				function chargeTypeMessage(){
					document.getElementById('idtypemessage').value=document.listeMessage.idtypemessage[0].value;		
				}
			</script>
			
			<div class="card-panel orange lighten-5  col m8 offset-m2 s12">
				<form method="post" name="messageUpdated" action="index.php?CRUDMessage" >
					<div class="row">
						<input type="hidden" name="id" id="Id"/>
						<input type="hidden" name="idtypemessage" id="idtypemessage" />
						<label for="number" class="active">Numéro du message</label>
						<input type="text" name="number" class="form-control" id="number" required/>
						<label for="texte" class="active">Texte du message</label>
						<input name="texte" id="texte" type="text" class="form-control" onfocus='javascript:chargeTypeMessage()' required/>
						<label for="contexte" class="active">Contexte d'emploi du message</label>
						<input name="contexte" id="contexte" type="text" class="form-control" required/>
					</div>
					<!-- mettre balise PHP //$params["MessageTypeList"] ?> -->
					<div class="row">
						<span  class="col m2 s6 offset-m1 center-align  waves-effect waves-light btn blue">
							<input type="submit" name="sousAction" value="Mettre à jour">
						</span>
						<span  class="col m2 s6 offset-m1 center-align  waves-effect waves-light btn blue">
							<input type="submit" name="sousAction" value="Supprimer">
						</span>
						<span  class="col m2 s6 offset-m1 center-align  waves-effect waves-light btn blue">
							<input type="submit" name="sousAction" value="Ajouter">
						</span>
						<span  class="col m2 s6 offset-m1 center-align  waves-effect waves-light btn blue">
							<input type="submit" name="sousAction" value="Fermer">
						</span>
					</div>
				</form>
			</div>
			<div  class="card-panel col m8 offset-m2 s12 yellow accent-2 center-align">
				<?= $message ?>
			</div>
		</div>
		<?php
		$title="Voyage en Alaska"; 
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


		
		