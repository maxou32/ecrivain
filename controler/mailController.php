<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;


class MailController	extends mainController	{
	    
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
	PUBLIC function senderMail($params){
		echo "<br /> View senderMail id=<PRE>";print_r($params);echo "</PRE>";
		$from="From: ".$params["name"]."\r\nReturn-path:".$params["email"];
		$subject=$params["message"];
		echo "Mail : ".$this->myConfig->getMail();
		mail($this->myConfig->getMail(), $subject, $message, $from);
		echo "Email transmis !";
	}
		
	
		
}