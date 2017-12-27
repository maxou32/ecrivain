<?php 
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _askReservedAccess extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		ob_start();  
		?>

			<form method="post" action="index.php?validAccessReserved" class="formUser">
				<i class="material-icons prefix">account_circle</i>
				<label for ="userName"> Nom :</label>
				<input id="userName" name="userName" type="text" required class="validate"/><br />
				<label for ="userPwd"> Mot de passe :</label>	
				<input id="userPwd" name="userPwd" type="password" pattern=".{5,}" title="5 caractères minimum" required><br />
					
				<input type="submit" value="Accéder à l'espace réservé"  class="button"/>

				
			</form>

		<?php 
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