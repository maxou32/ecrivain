<?php 
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\_ErrorView;
use web_max\ecrivain\view\Template;
use web_max\ecrivain\controler\ErrorController;
use web_max\ecrivain\model\MessageManager;
	
class _AskReservedAccess extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		ob_start();  
		?>
		<div class="row">
			<div class="card-panel col m6 offset-m3 s12">
				<form  class="formUser" method="post" action="index.php?validAccessReserved">  <!--    -->
					
					<i class="material-icons prefix">account_circle</i>
					<label for ="userName"> Nom :</label>
					<input id="userName" name="userName" type="text"  class="form-control"  title="Seules les lettres et les chiffres sont admis" pattern="[a-zA-Z0-9éèêïë ]*" required class="validate"/><br />
					<label for ="userPwd"> Mot de passe :</label>	
					<input id="userPwd" name="userPwd" type="password"  class="form-control validate" pattern=".{5,}" title="Seules les lettres et les chiffres sont admis" pattern="[a-zA-Z0-9éèêïë ]*"required/><br />
					<input id="cible" name="cible" type="hidden" value="validAccessReserved"/><br />
					<span  class=" waves-effect center-align waves-light  btn btn-large blue ">
						<input type="submit" name="sousAction" value="Accéder à l'espace réservé" class="right-align"><i class="material-icons left">send</i>
					</span>
				</form>
			</div>
		</div>		
			

		<?php 
		
		$contentView=ob_get_clean(); 
		
		
		$menuView=$this->renderTop();
		$asideView=null;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
		
	}
}