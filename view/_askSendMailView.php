<?php
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _AskSendMailView extends View{	
	public function __construct($template){
		$this->template =$template;
	}

	public function show($params,$datas){		
		ob_start(); 
		?>
		<div class="row">
		<form  action="index.php?sendMail" method="POST" enctype="multipart/form-data" class="formUser center hoverable orange lighten-5 col m6 offset-m3">
			<input type="hidden" name="action" value="submit">
			<div class="col m6 s12">
				Votre nom:<br>
				<input name="name" type="text" value="" size="30" title="Seules les lettres sont admises" pattern="[a-zA-Zéèêïë ]*" class="form-control validate"/><br>
			</div>
			<div class="col m6 s12">
				Votre email:<br>
				<input name="email" class="email form-control validate" type="email"  value="" size="30"/><br>
			</div>
			L'objet de votre message:<br />
			<input name="subject" class="form-control validate" type="text" title="Seules les lettres sont admises" pattern="[a-zA-Zéèêïë ]*" value="" size="30"/><br>
			Votre message:<br>
			<textarea name="message" rows="7" cols="30"></textarea><br>
			
			<div class="row">	
				<span  class=" waves-effect waves-light btn btn-large blue center-align">
					<input type="submit" name="sousAction" value="Transmettre" class="right-align"><i class="material-icons left">send</i>
				</span>
			</div>
		</form>

		<?php
		
		$contentView=ob_get_clean(); 		
		$menuView=$this->renderTop();
		$asideView=Null;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(NULL,NULL);
	}
}	

