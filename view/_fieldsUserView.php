<?php
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
use web_max\ecrivain\view\_ErrorView;
	
class _FieldsUserView extends View
{
	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		ob_start(); 
		if ($params["action"]=="update"){
			?><form method="post" action="index.php?registration" class="formUser">
				<input id="sousActionUpdate" name="sousAction" type="hidden" value ="update" >
			<?php	
		}else{
			?><form method="post" action="index.php?registration" class="formUser">
				<input id="sousActionAdd" name="sousAction" type="hidden" value ="add" ><?php
		}
		?>
				<label>votre nom</label>
				<input id="userName" name="userName" type="text"  class="form-control" value ="<?= htmlspecialchars($params["userName"]) ?>" required /><br />
				<label>votre mot de passe</label>
				<input id="userPwd" name="userPwd" type="password" class="form-control" pattern=".{5,}" title="5 caractères minimum" required /><br />
				<label>votre adresse mail</label>
				<input id="mail" name="mail" type="email" class="form-control" value ="<?= htmlspecialchars($params["email"])?>" required /><br />
				
				<br />
			 
				<span  class=" waves-effect center-align waves-light  btn btn-large blue ">
					<input type="submit" name="add" value="Soumettre votre demande" class="right-align"><i class="material-icons left">send</i>
				</span>
					
			</form>

	
		<?php
		$monErrorView=new _ErrorView();
		if ($monErrorView->hasError()){
			echo $monErrorView->show();
		}
		$contentView=ob_get_clean();
		
		$menuView=$this->renderTop();
		$asideView=Null;
		$footerView=$this->renderBottom();
		$captionMessage = $this->captionMessage;
		$message=$this->message;		
		
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
	
	}
}