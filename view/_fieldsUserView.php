<?php
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _FieldsUserView extends View
{
	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		ob_start(); 
		if ($params["action"]=="update"){
			?><form method="post" action="index.php?action=registration" class="formUser">
				<input id="sousActionUpdate" name="sousAction" type="hidden" value ="update" >
			<?php	
		}else{
			?><form method="post" action="index.php?action=registration" class="formUser">
				<input id="sousActionAdd" name="sousAction" type="text" value ="add" ><?php
		}
		?>
				<label>votre nom</label><input id="userName" name="userName" type="text"  value ="<?= htmlspecialchars($params["userName"]) ?>" required /><br />
				<label>votre mot de passe</label><input id="userPwd" name="userPwd" type="password" pattern=".{5,}" title="5 caractères minimum" required /><br />
				<label>votre adresse mail</label><input id="mail" name="mail" type="text"  value ="<?= htmlspecialchars($params["email"])?>" required /><br />
				
				<br />
				<input type="submit" value="Soumettre votre demande"class="button" />
				<input type="submit" name="sousAction" value="Fermer"  class="button"/>
			</form>

	
		<?php
		$contentView=ob_get_clean();
		
		$menuView=$this->renderTop();
		$asideView=$this->renderAside();
		$footerView=$this->renderBottom();
		$captionMessage = $this->captionMessage;
		$message=$this->message;		
		
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
	
	}
}