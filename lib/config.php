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
		require_once "Spyc.php";
		$this->data = \Spyc::YAMLLoad('lib/config.yaml');
		//echo"<br />Config <pre>";print_r($this->data);echo"<br /> fin chargement config</PRE>";
	}
	/*
	private function makeParams($handle){
		$ligne=fgets($handle); 
			while (!feof($handle) && $nbSpace<= $sav_NbSpace) 				
			{
				
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
	}
	*/
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
			return $this->data["ReservedAccess"][$function];
		}catch (Exception $e) {
			return false;
		}
	}

	public function getNbChapters(){
		return $this->data["nbChapters"];
	}
	
	public function getNbCaracters(){
		return $this->data["nbCaracters"];
	}
	
	public function getLogin(){
		return $this->data["login"];
	}
	
	public function getPassword(){
		return $this->data["password"];
	}

	public function getConnect(){
		$connect='mysql:host='. $this->data["serveur"].';dbname='. $this->data["nom"];
		return $connect;
	}
	
	public function getBackground(){
		return $this->_data["media"]["background"];
	}

	public function getRoad($theRoad){
		try{
			//echo"<PRE>debut get route = ".$theRoad;print_r($this->data["simpleRoads"][$theRoad]);echo"<br /> fin get </PRE>";
			if(isset($this->data["simpleRoads"][$theRoad])){
				//echo "<br />CONFIG : getRoad -- road trouvée";
				return $this->data["simpleRoads"][$theRoad];
			}else {
				//echo"<PRE><br />CONFIG : fin get route non trouvée = ";print_r($this->data["simpleRoads"]["index"]);echo"<br /> fin get </PRE>";
				return $this->data["simpleRoads"]["index"];
			}
		}catch(Exception $e){
			//echo "pb : ".$e ;
			return false;
		}
	}
}			