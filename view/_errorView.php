<?php 
namespace web_max\ecrivain\view;
use web_max\ecrivain\View\MaskErrorView;
use web_max\ecrivain\controler\ErrorController;
use web_max\ecrivain\model\MessageManager;
use web_max\ecrivain\model\Message;
	
class _ErrorView {	
	private $leMessage;
	
	public function __construct(){
	}
	
	public function hasError(){
		$monError=new ErrorController();
		//ECHO "ERROR VIEW 0";
		if ($monError->getExisteError()) {
			$monMessageManager= new MessageManager();
			$this->leMessage=$monMessageManager->getByNumber($monError->getIdError());
			$monError->deleteError();
			//$this->show();
			return true;
		}
	}
	
	
	public function show(){

		ob_start(); 
		//echo"<br /><pre> charge le Message 1";print_r($this->leMessage);echo"</pre>";
		?>
		<script type="text/javascript">
			bootbox.alert('<?php echo ($this->leMessage->getTexte()) ?>'	);
		</script>
		
			

		<?php
		//echo"<br /><pre> charge le Message 2 ";print_r($this->leMessage);echo"</pre>";
		$errorView=ob_get_clean();
		return $errorView;
	}
	

}
