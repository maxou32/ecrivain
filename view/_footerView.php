<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
	
class _FooterView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	
	public function getMessage($message){
		$this->message=$message;
	}
	public function show($params,$datas){


		ob_start(); 
		?>
			<footer id="footer" class="page-footer">
				
					<div class="row row_footer">
						<div class="col l6 s12">
							<p class="grey-text text-lighten-2"><?= $this->message ?></p>
						</div>
						<div class="col l4 offset-l2 s12">
							
								
								<a class="grey-text text-lighten-4 right" href="http://web-max.fr">© 2017 Copyright Web-Max</a>
							
						</div>
					
					</div>
				 
			</footer>
		<?php

		$footerView=ob_get_clean(); 
		return $footerView;  
	}
	
}