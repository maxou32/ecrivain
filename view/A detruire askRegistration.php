<?php
	//namespace web_max\ecrivain;
	//require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class _askRegistration extends View
{
	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){

		ob_start(); 
		
		?>
		<!-- -----------------------------------------------------------------
		                      page supprimée
		--------------------------------------------------------------
		<form method="post" action="index.php?action=registration" class="formUser">

			<input id="sousActionAdd" name="sousAction" type="hidden" value ="add" />
			<input id="userName" name="userName" type="text" placeholder="Indiquez votre nom" required /><br />
			<input id="userPwd" name="userPwd" type="password"  placeholder="Saisissez votre mot de passe" pattern=".{5,}" title="5 caractères minimum" required/><br />
			<input id="mail" name="mail" type="text" placeholder="Votre adresse mail" required /><br />
			
			<br /><input type="submit" value="Soumettre votre demande" />
		</form>
		-->
		<?php
		
		$this->contentView=ob_get_clean(); 
		
		$menuView=$this->renderTop();
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$asideView=$this->asideView;		
		$footerView=$this->renderBottom();

		$monTemplate= new template($menuView,$asideView,$footerView,$this->contentView);
		$monTemplate->show();
	}
}
