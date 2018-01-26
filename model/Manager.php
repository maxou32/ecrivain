<?php

namespace web_max\ecrivain\model;
use web_max\ecrivain\lib\Config;
// class manager : able to connect to the database 



class Manager{
	protected $maConfig;
	protected $prefix;

public function __construct(){
	

}	
	
    protected function dbConnect()
    {
		try
		{
			$this->maConfig = new Config();
			$this->prefix	= $this->maConfig->getPrefixe();
			$db = new \PDO($this->maConfig->getConnect(), $this->maConfig->getLogin(), $this->maConfig->getPassword());
			$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return $db;
		}
		catch (PDOException $e)
		{
			$monError=new ErrorController();
			$monError->setError(array("origine"=> "web_max\ecrivain\lib\router\router", "raison"=>"Accès aux données", "numberMessage"=>60));		
			header('Location: index.php?');	
			exit;
		}
    }
}