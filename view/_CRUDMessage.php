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
		
		//echo"CONTROLLEUR : 0 prepareMessage<br /> <PRE>";print_r($datas);echo"</PRE>";
		//echo"CONTROLLEUR : 0 prepareMessage<br /> <PRE>";print_r($params);echo"</PRE>";
		
		
		ob_start();  
			
		?>

		
		<div id="frame">
			<div id="liste">
				<form method="post" action="messageChoised" name="listeMessage">
					<p>Liste des messages</p>
					<?php
					for($i=0;$i<count($datas);$i++)
					{
						?>
						<div class="row">
							<div class="col-xs-2">
								<input type="hidden" name="id" id="id" value="<?= $datas[$i]->getId() ?>"/>
								<input type="hidden" name="contexte" value="<?= $datas[$i]->getContexte() ?>"/>
								<input type="hidden" name="number" value="<?= $datas[$i]->getNumber() ?>"/>
								<input type="hidden" name="texte" value="<?= $datas[$i]->getTexte() ?>"/>
								<input type="hidden" name="idtypemessage" value="<?= $datas[$i]->getMessage_idtypemessage() ?>"/>
								<input type="radio" name="message"  value="<?= $datas[$i]->getId() ?>" id="<?= $datas[$i]->getId() ?>" onclick='javascript:change()'/>
							</div >
							<div class="col-xs-10">
								<label for="<?= htmlspecialchars($datas[$i]->getId()) ?>" id="messageLU" title="<?= htmlspecialchars($datas[$i]->getcontexte()) ?>"  >
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
			
			<div id="CRUD">
				<form method="post" name="messageUpdated" action="index.php?CRUDMessage" >
					<input type="hidden" name="id" id="Id"/>
					<input type="hidden" name="idtypemessage" id="idtypemessage" />
					<label for="number" class="active">Numéro du message</label>
					<input type="text" name="number" class="form-control" id="number" required/>
					<label for="texte" class="active">Texte du message</label>
					<input name="texte" id="texte" type="text" class="form-control" onfocus='javascript:chargeTypeMessage()' required/>
					<label for="contexte" class="active">Contexte d'emploi du message</label>
					<input name="contexte" id="contexte" type="text" class="form-control" required/>
					<!-- mettre balise PHP //$params["MessageTypeList"] ?> -->
					<input type="submit" name="sousAction" value="Mettre à jour" class="button"/>
					<input type="submit" name="sousAction" value="Supprimer" class="button"/>
					<input type="submit" name="sousAction" value="Ajouter" class="button"/>
					<input type="submit" name="sousAction" value="Fermer"  class="button"/>
				</form>
			</div>
		</div>
		<p  id="infoMessage"><?= $message ?></p>
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


		
		