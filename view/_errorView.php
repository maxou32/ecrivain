<?php 
namespace web_max\ecrivain\view;
use web_max\ecrivain\View\MaskErrorView;
	
class _ErrorView {	
	private $aside;
	
	public function __construct(){
		
	}
	public function show($message){

		ob_start(); 
		//echo"<br /><pre> charge ASIDE ";print_r($this->aside);echo"</pre>";
		?>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>		
		<script type="text/javascript">
			jQuery(document).ready(function($){
				OpenAlert();
			});
		
			function OpenAlert(){
				"coucou";
				width=300;
				height=200;
				if(window.InnerWidth){
					var left=(window.InnerWidth-width)/2;
					var top=(window.InnerHeight-height)/2;
				}else{
					var left=(document.body.ClientWidth-width)/2;
					var top=(document.body.ClientHeight-height)/2;
				} ;
				window.open('view/MaskErrorView.html','Erreur','menubar=no, location=no, status=no, resizable=no, scrollbar=no , top='+top+',left='+left+' ,height='+height+', width='+width+''); 
			};
		
		</script>
		<?php
		echo ob_get_clean();

		//return $asideView;
	}
}
