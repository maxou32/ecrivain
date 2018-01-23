<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;
use web_max\ecrivain\model\Status;


class StatusManager extends Manager{


	public function __construct(){
    
	}

	public function add(status $status)  {
		try{
			$q = $this->dbConnect()->prepare('INSERT INTO '.$this->prefix.'status(libelle) VALUES(:libelle');

			$q->bindValue(':libelle', $message->getLibelle(), \PDO::PARAM_STR);		
			$q->execute();
			return true;
					
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}

	public function delete($idstatus)  {
		try{
			$idstatus = (int) $idstatus;
			$this->dbConnect()->exec('DELETE FROM '.$this->prefix.'status WHERE idstatus = '.$idstatus);
			return true;
					
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}

	public function get($libelle)  {
		try{
			$q = $this->dbConnect()->query('SELECT * FROM '.$this->prefix.'status WHERE libelle = "'.$libelle.'"');
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		
			if($donnees) {
				return new Status($donnees);
			}else{
				return false;
			}
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
	public function getFromId($status_idstatus)  {
		try{
			$q = $this->dbConnect()->query('SELECT * FROM '.$this->prefix.'status WHERE idstatus = "'.$status_idstatus.'"');
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
			
			if($donnees) {
				return new Status($donnees);
			}else{
				return false;
			}
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}

	public function getList()  {
		try{
			$status = [];
			$q = $this->dbConnect()->query('SELECT * FROM '.$this->prefix.'status ORDER BY idstatus ASC');
			
			while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))		{
				$status[] = new Status($donnees);
			}
			//echo"manager <PRE>";print_r($status);echo"</PRE>";
			return $status;
					
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
	
	public function update(status $status)  {
		try{
			$q = $this->dbConnect()->prepare('UPDATE '.$this->prefix.'status SET libelle = :libelle WHERE idstatus = :idstatus');
			$q->bindValue(':idstatus', $status->getIdstatus(), \PDO::PARAM_INT);
			$q->bindValue(':libelle', $status->getLibelle(), \PDO::PARAM_STR);

			$q->execute();
			return true;
					
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
}