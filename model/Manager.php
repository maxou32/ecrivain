<?php

//namespace web_max\ecrivain\model;


// class manager : able to connect to the database 

require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\config.php');


class Manager{
	
    protected function dbConnect()
    {
		try
		{
			
			$db = new PDO(DB_DSN, DB_LOGIN, DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		}
		catch (PDOException $e)
		{
			die('Une erreur interne est survenue');
		}
    }
	
}