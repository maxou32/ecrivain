<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\ChaptersManager;
	
class AccessControl {
	public function __construct(){
    
	}
	
	/*
	 
	public function getIsProtected($function){
		$myConfig= new Config;
		$paramConfig=$myConfig->getReservedFunction($function);
		//echo"<PRE>";print_r($paramConfig);echo"</PRE>";
		return array("result"=>$paramConfig);
	}
	
    */
	/*
	public function getAutorization( $userName, $userPwd){
	
			$monUserManager=new UserManager;
			//echo "<br /> getAutorization nom user :".$userName."<br />";
			$user=$monUserManager->get($userName);
			//echo "<br /> getAutorization apres userManager :".$userName."<br />";
			if(!$user){
				return array("result"=>false, "message"=>'Vous n\'êtes pas habilité à administrer ce roman.');			
			}else{
				//if(hash('sha256',$userPwd)==$user->getPassword()){
					
					return array("result"=>true);
				//}else{
				//	return array("result"=>false, "message"=>'Mot de passe incorrect.');	
				//<}	
			}
		
	}
	*/
    
    /**
     * Vérification de l'incription de l'utilisateur
     * @param  string $userName [nom de l'itulisateur
     * @return array resultat contenant le résultat et un message
     */
    public function isUnknown($userName){
		$monUserManager=new UserManager;
		$user=$monUserManager->get($userName);
		if(!$user){
			//echo 'existe pas ';
			return array("result"=>true, "message"=>'Vous devez vous incrire au préalable.');						
		}else{
			//echo 'existe oui ';
			return array("result"=>false, "message"=>'Vous êtes déjà inscrit.');			
		}
	}
	
    /**
     * Vérification du mot de passe
     * @param  string $password mot de passe saisi
     * @return array resultat contenant le résultat et un message
     */
    public function verifPassword($password){
		$longueur=strlen($password);
		if ($longueur<5) {
			return array("result"=>false, "message"=>'La taille de votre mot de passe est trop faible.');				
		}elseif(preg_match('#^(?=.[a-z])(?=.[A-Z])(?=.[0-9])#',$password)){
			return array("result"=>true,"message"=>"Mot de passe correct");
		}else{
			return array("result"=>false, "message"=>'Votre mot de passe contient des caractères interdits.');				
		}	
	}
	
	
    /**
     * Fonction de hashage
     * @param  string $password mot de passe
     * @return string mot de passe hashé
     */
    public function hashPassword($password){
		$password=hash('sha256',$password);
		return $password;
	}
    
	/**
	 * Vérification des droits d'accès
	 * @param  integer $requiredLevel Niveau requis
	 * @return boolean  indique si le niveau est suffiant ou pas
	 */
	public function verifAccessRight($requiredLevel){		
		$requiredLevel=(INT) $requiredLevel;
		if(!isset($_SESSION['autorizedAccess'])){
			return false;
		}else{
			$userLevel=(INT) $_SESSION['autorizedAccess'];
			$requiredLevel=(INT) $requiredLevel;
			return  $userLevel >= $requiredLevel ;
		}
	}
	
    /**
     * deconnection de l'application
     * @return string deconnexion réalisée
     */
    public function disconnect(){
		//echo "accessCONTROL : disconnect";
		// On le vide intégralement
		$_SESSION = array();
		// Destruction de la session
		session_destroy();
		// Destruction du tableau de session
		unset($_SESSION);
		return "Disconnect OK";
	}
	/*
	public function makeParam ($param){
		$myConfig= new Config;
		$paramConfig=$myConfig->getParam($param);
		return $paramConfig;
	}
	*/
}				