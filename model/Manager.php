<?php

//namespace web_max\ecrivain;

// class manager : able to connect to the database 

//require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\config.php');


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