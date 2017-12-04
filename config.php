<?php

namespace web_max\ecrivain;


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
					$variable=preg_split("/:/",$ligne,2);
					if(isset($variable[1])){
						$this->_data[$cle][$variable[0]]=$variable[1];
					}else{
						$this->_data[$cle][$variable[0]]="";
					}
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
	public function getDirView(){
		return $this->_data["way"]["dir_view"];
	}
	public function getLevelAdmin(){
		return $this->_data["rules"]["admin"];
	}
	public function getLevelContributor(){
		return $this->_data["rules"]["contributor"];
	}
	
}			