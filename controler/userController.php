<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\UserManager;
use web_max\ecrivain\model\User;

class UserController	extends MainController	{

public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
	}
 
	
	/**
     * Enregistrement des données des l'utilisateur
     * @params  array $params contient les infos de l'utilisateur à stocker
     *      sousAction : Add ou update
     *      infos des users
     */
    
    public	function registration($params) {   
		//echo 'action : '. $params;
		$monAccessControl= new AccessControl();
		$userPassword=$monAccessControl->hashPassword( $params['userPwd']);	
		if( $params['sousAction']=="add"){
			$monUserManager= new UserManager();
			if ($monUserManager->get($params['userName'])){
				$monError=new ErrorController();
				$monError->setError(array("origine"=> "web_max\ecrivain\controler\userControler", "raison"=>"Double inscription", "numberMessage"=>32));
				
			}else{
				$donnees=array('name' => $params['userName'],'password' => $userPassword, 'email'=> $params['mail'], 'Grade_IdGrade'=>2, 'Status_IdStatus'=>2	);
				$newUser = new User($donnees);	
				$users=$monUserManager->add($newUser);	
			}
		}else{
			$donnees=array('idusers'=> $_SESSION['userId'],'name' =>$params['userName'],'password' => $userPassword, 'email'=> $params['mail'],'grade_idgrade'=>$_SESSION['Grade_IdGrade'], 'status_idstatus'=>$_SESSION['Status_IdStatus']);
			
			$newUser = new User($donnees);			
			$userManager= new UserManager();
			$updateOK=$userManager->update($newUser);	
			$monAccessControl->updateSession($newUser);
			$monError=new ErrorController();
			if($updateOK){
				$monError->setError(array("origine"=> "web_max\ecrivain\controler\userControler", "raison"=>"Modification de votre profil", "numberMessage"=>23));
			}else{
				$monError->setError(array("origine"=> "web_max\ecrivain\controler\userControler", "raison"=>"Modification de votre profil", "numberMessage"=>43));
			}
		}
	}
	
}