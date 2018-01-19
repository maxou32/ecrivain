<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
use web_max\ecrivain\view\_AsideView;
use web_max\ecrivain\view\_ErrorView;

class _messageView extends View
{	
	public function __construct($template){
		$this->template =$template;
	}

	public function show($params,$datas){
		isset($params['message']) ? $message=$params['message'] :true;
		ob_start(); 
		?>
		<div class ="row">
			<article id="barreMessage" class="col s12 m7 offset-m1">
				<div>
					 <p><?= $datas->getTexte() ?></p>
				</div>									
			</article>
		
			<div class="col s12 m3  offset-m1">
				<?php
					$monAsideView=new _AsideView($params);	
					$asideView=$monAsideView->show();	
				?>
			</div>
		</div>	
		<?php
		
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