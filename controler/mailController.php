<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\controler\ErrorController;

class MailController extends MainController	{
	    
	public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
		//echo"<br /><pre> CONTROLLER CONSTRUCT ";print_r($this->myAction);echo"</pre>";
	}

 	/**
     * Crée un mail de contact et l'envoi .
     * @param  params    contient les informations du courriel
     */
	public function senderMail($params){
		$from="From: ".$params["name"]."\r\nReturn-path:".$params["email"];
		$subject="demande de contact émanant de mon livre";$params["subject"];
		$message=$params["name"]. " souhaite me contacter au sujet de : ".$params["subject"]."<br />".
			"Il me laisse le message suivant :<br />".
			$params["message"]."<br />".
			"Je pourrai lui répondre à l'adresse : ".$params["email"] ;
		mail($this->myConfig->getMail(), $subject, $message, $from);

		$monError=new ErrorController();
		$monError->setError(array("origine"=> "web_max\ecrivain\controler\MailController", "raison"=>"Demande de contact", "numberMessage"=>40));

		
		}
		
	
		
}