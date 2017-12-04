<?php
	namespace web_max\ecrivain;
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class FieldsUser extends View
{
	public function __construct($avecParam){
		$this->template ='template.php';
		$this->avecParam=$avecParam;
	}
	public function show($params,$datas){
		$title="Voyage en Alaska"; 
		ob_start(); 
		$menuView=$this->renderTop();
		$asideView=$this->renderAside()

		?>
		<form method="post" action="index.php?action=registration" class="formUser">
			<input id="userName" name="userName" type="text" placeholder="Indiquez votre nom" required /><br />
			<input id="userPwd" name="userPwd" type="password"  placeholder="Saisissez votre mot de passe" pattern=".{5,}" title="5 caractères minimum" required><br />
			<input id="mail" name="mail" placeholder="Votre adresse mail" required><br />
			
			<br /><input type="submit" value="Soumettre votre demande" />
		</form>

	
		<?php
		$footerView=$this->renderBottom();
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$asideView=$this->asideView;		
		
		$contentView=ob_get_clean(); 
		include_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php');
	
	}
}