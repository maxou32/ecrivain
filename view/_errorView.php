<?php 
namespace web_max\ecrivain\view;
use web_max\ecrivain\View\MaskErrorView;
use web_max\ecrivain\controler\ErrorController;
use web_max\ecrivain\model\MessageManager;
use web_max\ecrivain\model\Message;
	
class _ErrorView {	
	private $leMessage;
	private $laRaison;
	
	public function __construct(){
	}
	
	public function hasError(){
		$monError=new ErrorController();
		//ECHO "ERROR VIEW 0";
		if ($monError->getExisteError()) {
			$monMessageManager= new MessageManager();
			$this->leMessage=$monMessageManager->getByNumber($monError->getNumberError());
			$this->laRaison=$monError->getRaisonError();
			$monError->deleteError();
			return true;
		}
	}
	
	
	public function show(){

		ob_start(); 
		//echo"<br /><pre> charge le Message 1";print_r($this->leMessage);echo"</pre>";
		?>
		<script type="text/javascript">
			$(document).ready(function(e){
				$('#modal1').css({visibility: 'visible',display:'inline-block'});
				setTimeout(function(){
				  $('#modal1').css({visibility: 'hidden',display:'none'});;
				}, 4000);
			});
			
	
		</script>

		<div id="modal1" class="modal card-panel hoverable">
			<div class="modal-content ">
				<h5><i class="material-icons">info</i>  <?php echo ($this->laRaison) ?></h5>
				<div class="divider"></div>
				<p><?php echo ($this->leMessage->getTexte()) ?></p>
			</div>
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
		</div>
			

		<?php
		$errorView=ob_get_clean();
		return $errorView;
	}
	

}
