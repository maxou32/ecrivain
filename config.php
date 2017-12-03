<?php

namespace web_max\ecrivain;

// Adresse du serveur de base de données
	define('DB_SERVEUR', 'localhost');

	// Login
	define('DB_LOGIN','root');

	// Mot de passe
	define('DB_PASSWORD','');

	// Nom de la base de données
	define('DB_NOM','ecrivain');

	// Nom de la table du livre d'or
	define('DB_GUESTBOOK_TABLE','guestbook');

	// Driver correspondant à la BDD utilisée
	define('DB_DSN','mysql:host='. DB_SERVEUR .';dbname='. DB_NOM);

	// Nombre de messages à afficher par page
	define('MAX_MESSAGES_PAR_PAGE', 5);

	// URL du livre d'or
	define('URL_GUESTBOOK', 'http:\\127.0.0.1:8000\edsa-test_php\TP_XX\ecrivain');

	// chemin absolu
	define('DIR_ECRIVAIN', 'D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain');
	
	// habilitations
	define ('Admin',1);
	define ('Contributeur',2);

class Config{
	
	private $_data;
	
	public function __construct()   {
		$filename='config.yaml';
		$handle =fopen($filename,"r");
		if ($handle) {
			while (!feof($handle)) 				
			{
				$ligne=fgets($handle); 
				if (preg_match('#\t{1,}#',$ligne)){
					$ligne=preg_replace('#-#','',$ligne);
					$ligne=preg_replace('#\s#','',$ligne);
					$variable=preg_split("/:/",$ligne);
					$this->_data[$cle][$variable[0]]=$variable[1];
				}else{
					$ligne=preg_replace('#:#','',$ligne);
					$ligne=preg_replace('#\s#','',$ligne);	
					$cle=$ligne;
				}
			} 
			fclose($handle); 
			
		}else{
			echo 'merde';
		}
	}
	public function getLogin(){
		return $this->_data["data"]["login"];
	}
	public function getPassword(){
		return $this->_data["data"]["password"];
	}
	public function getConnect(){
		$connect='mysql:host='. $this->_data["data"]["serveur"].';dbname='. $this->_data["data"]["nom"];
		return $connect;
	}
	public function getUrl(){
		return $this->_data["way"]["url"];
	}
	public function getDirChemin(){
		return $this->_data["way"]["dir_ecrivain"];
	}
	public function getLevelAdmin(){
		return $this->_data["rules"]["admin"];
	}
	public function getLevelContributor(){
		return $this->_data["rules"]["contributor"];
	}
	
}			