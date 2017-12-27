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

		
		<div id="frame">
			<div id="liste">
				<form method="post" action="messageChoised" name="listeMessage">
					<p>Liste des messages</p>
					<?php
					for($i=0;$i<count($datas);$i++)
					{
						?>
						<input type="hidden" name="id" id="id" value="<?= $datas[$i]->getId() ?>"/>
						<input type="hidden" name="contexte" value="<?= $datas[$i]->getContexte() ?>"/>
						<input type="hidden" name="texte" value="<?= $datas[$i]->getTexte() ?>"/>
						<input type="hidden" name="idtypemessage" value="<?= $datas[$i]->getMessage_idtypemessage() ?>"/>
						<input class="with-gap"
						type="radio" name="message" class ="listData" value="<?= $datas[$i]->getId() ?>" id="<?= $datas[$i]->getId() ?>" onclick='javascript:change()'/>
							<label for="<?= $datas[$i]->getId() ?>" id="messageLU" title="<?= $datas[$i]->getcontexte() ?>"  ><?= $datas[$i]->getTexte() ?>  </label><br />
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
					<input type="text" name="idtypemessage" id="idtypemessage" />
					<!-- <textarea name="texte" id="texte" ></textarea>  -->
					<label for="texte" class="active">Texte du message</label>
					<input name="texte" id="texte" type="text" onfocus='javascript:chargeTypeMessage()' required/>
					<label for="contexte" class="active">Contexte d'emploi du message</label>
					<input name="contexte" id="contexte" type="text" required/>
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
		$asideView=$this->asideView;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
	}
}	


		
		