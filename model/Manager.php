<?php

namespace web_max\ecrivain\model;


// class manager : able to connect to the database 




class Manager{
	private $host='';
    protected function dbConnect()
    {
        //$db = new \PDO('mysql:host='. $this->$host . ';dbname=ecrivain;charset=utf8', 'root', '');
        $db = new \PDO('mysql:host=localhost;dbname=ecrivain;charset=utf8', 'root', '');
        return $db;
    }
	public function setHost($host)
	{
		if (is_string($host))
		{
		  $this->host = $host;
		}

	}
}