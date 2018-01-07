<?php 
namespace web_max\ecrivain\view;
	
class MaskErrorView {	
	private $message;
	
	public function __construct($message){
		$this->message=$message;
	
	?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf8_general_ci" />
			</head>
			<body class="red">	 
				
				
				<div id="contentError" >
					
					<div id="contenuDetailError" style="color: 'yellow';">
						coucou <?= $this->message;  ?>
					</div>
				</div>
				
	   		</body>
		</html>
	<?php
	}
}