<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\UserManager;
use web_max\ecrivain\model\User;

class UserController	extends mainController	{

public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
		//echo"<br /><pre> CONTROLLER CONSTRUCT ";print_r($this->myAction);echo"</pre>";
	}
 
	
	/**
     * Enregistrement des données des l'utilisateur
     * @params  array $params contient les infos de l'utilisateur à stocker
     *      sousAction : Add ou update
     *      infos des users
     */
    
    public	function registration($params) {   
		//echo 'action : '. $action;
		$monAccessControl= new AccessControl();
		$userPassword=$monAccessControl->hashPassword( $params['userPwd']);	
		if( $params['sousAction']=="add"){
			$donnees=array('name' => $params['userName'],'password' => $userPassword, 'email'=> $params['mail'], 'Grade_IdGrade'=>2, 'Status_IdStatus'=>1);
			$newUser = new User($donnees);	
					
			$userManager= new UserManager();
			$users=$userManager->add($newUser);	
			
		}else	{
			$donnees=array('idusers'=> $_SESSION['userId'],'name' =>$params['userName'],'password' => $userPassword, 'email'=> $params['mail'],'grade_idgrade'=>$_SESSION['Grade_IdGrade'], 'status_idstatus'=>$_SESSION['Status_IdStatus']);
			
			$newUser = new User($donnees);			
			$userManager= new UserManager();
			$users=$userManager->update($newUser);	
			$monAccessControl->updateSession($newUser);
		}
	}
	
}