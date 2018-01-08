<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _askSendMail extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	
	public function show($params,$datas){
		
		$this->params=$params;
					
		ob_start(); 
		?>
		<div class="formChapitre">
			

			<form  action="index.php?sendMail" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="action" value="submit">
			Votre nom :<br>
			<input name="name" type="text" value="" size="30"/><br>
			Votre courriel :<br>
			<input name="email" type="text" value="" size="30"/><br>
			Votre message :<br>
			<textarea name="message" rows="7" cols="30"></textarea><br>
			<input type="submit" value="Envoyerl"/>
			</form
		</div>

		<?php

		$contentView=ob_get_clean(); 	
		
		$menuView=$this->renderTop();
		$asideView=$this->renderAside();
 
				
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(null,null);
			
	}
}
	