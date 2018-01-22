<?php

namespace web_max\ecrivain\lib;
use web_max\ecrivain\lib\router;
use web_max\ecrivain\controler\accesControl;
 
// show errors if not in php.ini
ini_set('display_errors','on');
error_reporting(E_ALL);

/**
*  Classe exploitant le fichier de config
*
*/
class Config{
	
	private $_data;
	
	/**
	 * ouverture du fichier de configuration 
	 * @private
	 */
	public function __construct()   {
		require_once "Spyc.php";
		$this->data = \Spyc::YAMLLoad('lib/config.yaml');
		$this->data['secu'] = \Spyc::YAMLLoad('lib/secu.yaml');
		//echo"<br />Config <pre>";print_r($this->data);echo"<br /> fin chargement config</PRE>";
	}
	
	/**
	 * Donne le nombre de chapitre présenté dans le livre
	 * @return integer nombre de chapitre
	 */
	public function getNbChapters(){
		return $this->data['secu']["nbChapters"];
	}
	
    /**
     * Donne le nombre de caractères présentés dasn les résumés
	 * @return integer nombre de caractères
     */
    public function getNbCaracters(){
		return $this->data['secu']["nbCaracters"];
	}
	
    /**
     * Donne le login d'accès à la base de données
     * @return string nom de l'utilisateur
     */
    public function getLogin(){
		return $this->data['secu']["login"];
	}
	
    /**
     * donne le mot de passe d'accès à la base de données
     * @return string mot de passe
     */
    public function getPassword(){
		return $this->data['secu']["password"];
	}

    /**
     * donne la chaîne de connexion
     * @return string connexion à la base de donnees
     */
    public function getConnect(){
		$connect='mysql:host='. $this->data['secu']["serveur"].';dbname='. $this->data['secu']["nom"];
		return $connect;
	}
	
    /**
     * donne l'image de fond d'écran
     * @return string chemin du fichier de fond d'écran
     */
    public function getBackground(){
		return $this->data["media"]["background"];
	}
    
	/**
     * donne l'adresse mail du site
     * @return string adresse mail
     */
    public function getMail(){
		return $this->data['secu']["mail"];
	}
	
	/**
     * donne les parametres d'affichage de la barre droite
     * @return array  donnat les champs à afficher
     */
    public function getAsideParam($view){
		if(isset($this->data["aside"][$view])){
			$param=$this->data["aside"][$view];
		}else{
			$param=$this->data["aside"]["_messageView"];
		}
		return $param;
	}
	
	/**
	 * recherche les éléments de la route demandée
	 * @param  string $theRoad nom de la route recherchée
	 * @return array  tableau avec les caractéristiques de la route
	 */
	public function getRoad($theRoad){
		try{
			if(isset($this->data["simpleRoads"][$theRoad])){
				return $this->data["simpleRoads"][$theRoad];
			}else {
				return $this->data["simpleRoads"]["index"];
			}
		}catch(Exception $e){
			return false;
		}
	}
}			