<?php

namespace web_max\ecrivain\model;
use web_max\ecrivain\lib\Config;
// class manager : able to connect to the database 



class Manager{
	
    protected function dbConnect()
    {
		try
		{
			$maConfig = new Config();
			$db = new \PDO($maConfig->getConnect(), $maConfig->getLogin(), $maConfig->getPassword());
			$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return $db;
		}
		catch (PDOException $e)
		{
			die('Une erreur interne est survenue');
		}
    }
	
}