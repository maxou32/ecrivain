<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;


class _messageView extends View
{	
	
	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		isset($params['message']) ? $message=$params['message'] :true;
		
		ob_start(); 
		?>

		<article id="barreMessage">
			
			<div>
				 <p><?= $datas->getTexte() ?></p>
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
