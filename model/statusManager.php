<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;
use web_max\ecrivain\model\Status;


class StatusManager extends Manager{


	public function __construct(){
    
	}

	public function add(status $status)  {
		$q = $this->dbConnect()->prepare('INSERT INTO status(libelle) VALUES(:libelle');

		$q->bindValue(':libelle', $message->getLibelle(), \PDO::PARAM_STR);		
		$q->execute();
	}

	public function delete($idstatus)  {
		$idstatus = (int) $idstatus;
		$this->dbConnect()->exec('DELETE FROM status WHERE idstatus = '.$idstatus);
	}

	public function get($libelle)  {
		$q = $this->dbConnect()->query('SELECT * FROM status WHERE libelle = "'.$libelle.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		
		if($donnees) {
			return new Status($donnees);
		}else{
			return false;
		}
	}
	public function getFromId($status_idstatus)  {
		$q = $this->dbConnect()->query('SELECT * FROM status WHERE idstatus = "'.$status_idstatus.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		
		if($donnees) {
			return new Status($donnees);
		}else{
			return false;
		}
	}

	public function getList()  {
		$status = [];
		$q = $this->dbConnect()->query('SELECT * FROM status ORDER BY idstatus ASC');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))		{
			$status[] = new Status($donnees);
		}
		//echo"manager <PRE>";print_r($status);echo"</PRE>";
		return $status;
	}
	
	public function update(status $status)  {
		
		$q = $this->dbConnect()->prepare('UPDATE status SET libelle = :libelle WHERE idstatus = :idstatus');
	
		$q->bindValue(':idstatus', $message->getIdstatuse(), \PDO::PARAM_INT);
		$q->bindValue(':libellet', $message->getLibelle(), \PDO::PARAM_STR);

		$q->execute();
	}
}