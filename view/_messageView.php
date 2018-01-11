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
			<div class="col-xs-1 col s1"></div>
			<article id="barreMessage" class="col-xs-7 col s7">
				<div>
					 <p><?= $datas->getTexte() ?></p>
				</div>									<!-- fin "flottage" du menu -->
			</article>
		
			<div class="col-xs-1 col s1"></div>
			<div class="col-xs-3 col s2">
				<?php
					$monAsideView=new _AsideView($params);	
					$asideView=$monAsideView->show();	
				?>
			</div>
		</div>	
		<?php
		//$title="Voyage en Alaska"; 
		//echo "message view avant erreur";
		$monErrorView=new _ErrorView();
		if ($monErrorView->hasError()){
			echo $monErrorView->show();
		}
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