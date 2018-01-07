<?php 
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\_ErrorView;
use web_max\ecrivain\view\Template;
use web_max\ecrivain\controler\ErrorController;
use web_max\ecrivain\model\MessageManager;
	
class _askReservedAccess extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		ob_start();  
		?>

			<form  class="formUser" >  <!-- method="post" action="index.php?validAccessReserved"   -->
				<i class="material-icons prefix">account_circle</i>
				<label for ="userName"> Nom :</label>
				<input id="userName" name="userName" type="text" required class="validate"/><br />
				<label for ="userPwd"> Mot de passe :</label>	
				<input id="userPwd" name="userPwd" type="password" pattern=".{5,}" title="5 caractères minimum" required/><br />
				<input id="cible" name="cible" type="hidden" value="validAccessReserved"/><br />
					
				<input type="submit" id="submit" value="Accéder à l'espace réservé"  class="button alert"/>
				<div id="resultat">
				</div>
				<p>Content here. <a class="alert" href=#>Alert!</a></p>
			</form>
				<script>
					$(".alert").click(function(e) {
						bootbox.alert("Hello world!", function() {
							console.log("Alert Callback");
						});
					});
				</script>
			

		<?php 

		$contentView=ob_get_clean(); 
		//$monErrorView=new _ErrorView();
		
		$menuView=$this->renderTop();
		$asideView=null;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
	}
}