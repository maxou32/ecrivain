<?php

class AccessControl {
	public function __construct(){
    
	}
	public function getAutorized($userName, $userPwd){
		$monUserManager=new UserManager;
		$user=$monUserManager->get($userName);
		if(!$user){
			return 8;			
		}else{
			if($userPwd==$user->getPassword()){
				$_SESSION['user']=$user->getName();
				//$_SESSION['userPwd']=$User->getPassword();
				$_SESSION['autorizedAccess']=$user->getGrade_IdGrade();
				return true;
			}else{
				return (7);	
			}	
		}
	}
	public function verifAccessRight($requiredLevel){
		echo "niveau requis : " . $requiredLevel . " niveau utilisateur = " .$_SESSION['autorizedAccess'];
		$requiredLevel=(INT) $requiredLevel;
		
		
		if(!isset($_SESSION['autorizedAccess'])){
			return false;
		}else{
			$userLevel=(INT) $_SESSION['autorizedAccess'];
			if ($userLevel>=$requiredLevel){
			return true;
			}else{
				return false;
			}
		}
	}
	
	
	public function disconnect(){
		// On le vide intégralement
		$_SESSION = array();
		// Destruction de la session
		session_destroy();
		// Destruction du tableau de session
		unset($_SESSION);
	}
}				