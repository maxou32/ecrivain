<?php
namespace web_max\ecrivain\controler;

class ErrorController extends mainController	{

	
public function __construct(){
		
	}
 
	
	/**
     * Enregistrement de l'erreur dans les variables de SESSION
     * @params  array $erreur contient l'erreur à traiter, son origine et ses paramêtres
     *      
     */
    
    public	function setError($error) {   
		$_SESSION['error']=$error;
	}
	
	
	public	function getOrigineError() {   
		if(isset($_SESSION['error']["origine"])){
			return $_SESSION['error']["origine"];
		}else{
			return Null;
		}
	}
	
	public	function getIdError() {   
		if(isset($_SESSION['error']["idMessage"])){
			return $_SESSION['error']["idMessage"];
		}else{
			return Null;
		}
	}
	
	public	function getExisteError() {   
		//echo"<PRE> ERROR COntroller : ";print_r($_SESSION);echo"</PRE>";
		return ['error'] ? true : false;
	}
	
}