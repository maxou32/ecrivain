<?php 
	//namespace web_max\ecrivain;
	//require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class _messageView extends View
{	
	
	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		$message=$params['message'];
		
		ob_start(); 
		?>

		<article id="barreMessage">
			
			<div>
				 <p><?= $message ?></p>
			</div>
													<!-- fin "flottage" du menu -->
		</article>
			
		<?php
		//$title="Voyage en Alaska"; 
		$messageView=ob_get_clean();
		$contentView= $messageView;
		$menuView=$this->renderTop();
		$asideView="";		
		$captionMessage = "";
		$message="";
		$footerView=$this->renderBottom();		

		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(NULL,NULL);
	}
}
