<?php

namespace web_max\ecrivain\lib;
use web_max\ecrivain\lib\router;
use web_max\ecrivain\controler\accesControl;
 
// show errors if not in php.ini
ini_set('display_errors','on');
error_reporting(E_ALL);


class Config{
	
	private $_data;
	
	public function __construct()   {
		//echo "debut construct <br />";
		$filename='lib/config.yaml';
		$handle =fopen($filename,"r");
		if ($handle) {
			while (!feof($handle)) 				
			{
				$ligne=fgets($handle); 
				if (!preg_match('#^\*#',$ligne)){
					if (preg_match('#  #',$ligne)){
						$variable=preg_split("/:/",$ligne,2);
						$variable[0]=preg_replace('#  #','',$variable[0]);
						$this->_data["Param"][$savRubrique][$variable[0]]=$variable[1];
					}elseif (preg_match('# #',$ligne)){
						$ligne=preg_replace('#-#','',$ligne);
						$ligne=preg_replace('#\s#','',$ligne);
						$variable=preg_split("/:/",$ligne,2);
						if(isset($variable[1])){
							$this->_data[$cle][$variable[0]]=$variable[1];
							$savRubrique=$variable[0];
						}else{
							$this->_data[$cle][$variable[0]]="";
						}
					}else{
						$ligne=preg_replace('#:#','',$ligne);
						$ligne=preg_replace('#\s#','',$ligne);	
						$cle=$ligne;
					}
				}
			} 
			fclose($handle); 
			//echo"<PRE>fin construct";print_r($this->_data);
			//echo"<br />";print_r($_REQUEST);echo"</PRE>";
		}else{
			echo 'merde';
		}
	}
	
	public function getParam($value){
		try{
			//echo 'getParam($value)=='.$value;
			return $this->_data["Param"][$value];	
		}catch (Exception $e) {
			return false;
		}
		}
		
		public function getReservedFunction ($function){
			try{
				return $this->_data["ReservedAccess"][$function];
			}catch (Exception $e) {
				return false;
		}
	}

	public function getNbArticles(){
		return $this->_data["rules"]["nbArticles"];
	}
	
	public function getNbCaracters(){
		return $this->_data["rules"]["nbCaracters"];
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
	
	public function getBackground(){
		//echo "recherche background".$this->_data["media"]["background"];
		return $this->_data["media"]["background"];
	}
/*	public function getUrl(){
		return $this->_data["way"]["url"];
	}
	public function getDirChemin(){
		return $this->_data["way"]["dir_ecrivain"];
	}
	public function getDirView(){
		return $this->_data["way"]["dir_view"];
	}
	public function getLevelAdmin(){
		return $this->_data["rules"]["admin"];
	}
	public function getLevelContributor(){
		return $this->_data["rules"]["contributor"];
	}
*/
	public function getRoad($theRoad){
		try{
			if(null !==$this->_data["simpleRoads"][$theRoad]){
				return $this->_data["simpleRoads"][$theRoad];
			}
		}catch(Exception $e){
			return false;
		}
	}

    public static function start()
    {
        /*
		
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';  // 127.0.0.1:8080
		$root =  $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/';
       
        $clase="";
        // constant
        define("HOST", $host.'' );
        define("ROOT", $root );
		//define("HOST", $host.'/edsa-ecrivain/' );
		//define("ROOT", $root.'/edsa-ecrivain/' );

        define("CONTROLER", ROOT."controler/");
        define("VIEW", ROOT."view/");
        //define("CLASSE", ROOT."classes/");
        define("CLASSE", ROOT);
        define("MODEL", ROOT."model/");
		//define("ASSETS", HOST."assets/");
		
		if (isset($classe) && $chemin[$classe]!==Null){
			require ($maConfig->getDirChemin().$chemin[$classe]);
		}else{
			//echo "la classe est vide = " .$classe . " et " . $chemin[$classe];
		}
		*/
    }
}			