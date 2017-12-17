<?php 
	//namespace web_max\ecrivain;
	//require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class ReservedAccess extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		ob_start();  
		?>

			<form method="post" action="index.php?action=validAccessReserved" class="formUser">
				<input id="userName" name="userName" type="text" placeholder="Saisissez votre nom" 
					   required /><br />
				<input id="userPwd" name="userPwd" type="password" pattern=".{5,}" title="5 caractères minimum" required><br />
					
				<input type="submit" value="Accéder à l'espace réservé"  class="button"/>

				
			</form>

			
			<form method="post" action="index.php?action=askUpdateProfil" class="formUser">
				<br /><input type="submit" value="Modifier votre profil"  class="button"/>
			</form>

		<?php 
		$contentView=ob_get_clean(); 

		$menuView=$this->renderTop();
		$asideView=$this->asideView;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show();
	}
	
}