<?php 
	//namespace web_max\ecrivain;
	//require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class _alertView //extends View
{	
	
	public function __construct(){
		
	}
	public function show($params){
		$message=$params['message'];
		

				ob_start(); 
				?>
				 onload='javascript:affiche()'
				<div id="modal1" class="modal">
					<div class="modal-content">
						<h4>Modal Header</h4>
						<p>titit<?= $message ?></p>
					</div>
					<div class="modal-footer">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
					</div>
				</div>
			</body>

				<?php
		$messageView=ob_get_clean();
		<script language="javascript" type="text/javascript">
				function affiche() {
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
		return  $messageView;
		
	}
}
