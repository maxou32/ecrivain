<?php
	namespace web_max\ecrivain;
	//session_start();
	//use web_max\ecrivain\model;

	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\UserManager.php');
class AccessControl {
	public function __construct(){
    
	}
	public function getAutorized($userName, $userPwd){
		$monUserManager=new UserManager;
		$user=$monUserManager->get($userName);
		echo 'mon user = ' . $userName;
		if(!$user){
			return array("result"=>false, "message"=>'Vous n\'êtes pas habilité à administrer ce roman.');			
		}else{
			if(hash('sha256',$userPwd)==$user->getPassword()){
				$_SESSION['user']=$user->getName();
				//$_SESSION['userPwd']=$User->getPassword();
				$_SESSION['autorizedAccess']=$user->getGrade_IdGrade();
				return array("result"=>true);
			}else{
				return array("result"=>false, "message"=>'Mot de passe incorrect.');	
			}	
		}
	}
	public function isUnknown($userName){
		$monUserManager=new UserManager;
		$user=$monUserManager->get($userName);
		if(!$user){
			echo 'existe pas ';
			return array("result"=>true);						
		}else{
			echo 'existe oui ';
			return array("result"=>false, "message"=>'Vous êtes déjà inscrit.');			
		}
	}
	
	public function verifPassword($password){
		$longueur=strlen($password);
		if ($longueur<5) {
			return array("result"=>false, "message"=>'La taille de votre mot de passe est trop faible.');				
		}elseif(preg_match('#^(?=.[a-z])(?=.[A-Z])(?=.[0-9])#',$password)){
			return array("result"=>true);
		}else{
			return array("result"=>false, "message"=>'Votre mot de passe contient des caractères interdits.');				
		}	
	}
	
	public function hashPassword($password){
		$password=hash('sha256',$password);
		return $password;
	}
	
	public function verifAccessRight($requiredLevel){
		//echo "niveau requis : " . $requiredLevel . " niveau utilisateur = " .$_SESSION['autorizedAccess'];
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