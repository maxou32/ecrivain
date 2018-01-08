<?php
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _askSendMailView extends View{	
	public function __construct($template){
		$this->template =$template;
	}

	public function show($params,$datas){		
		ob_start(); 
		?>
		<div class="row">
		<form  action="index.php?sendMail"" method="POST" enctype="multipart/form-data" class="formUser center ">
			<input type="hidden" name="action" value="submit">
			<div class="col-xs-6 col s6">
				Votre nom:<br>
				<input name="name" type="text" value="" size="30" class="form-control"/><br>
			</div>
			<div class="col-xs-6 col s6">
				Votre email:<br>
				<input name="email" type="text" value="" size="30"class="form-control"/><br>
			</div>
			Votre message:<br>
			<textarea name="message" rows="7" cols="30"></textarea><br>
			<button type="submit" name="sousAction" value="Transmettre" class="btn btn-primary">
				<span class="glyphicon glyphicon-ok-sign"></span>
				 transmettre
			</button>
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

