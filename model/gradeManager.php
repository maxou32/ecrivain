<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;
use web_max\ecrivain\model\Grade;


class GradeManager extends Manager{


	public function __construct(){
    
	}

	public function add(grade $grade)  {
		$q = $this->dbConnect()->prepare('INSERT INTO grade(libelle) VALUES(:libelle');

		$q->bindValue(':libelle', $message->getLibelle(), \PDO::PARAM_STR);		
		$q->execute();
	}

	public function delete($idgrade)  {
		$idgrade = (int) $idgrade;
		$this->dbConnect()->exec('DELETE FROM grade WHERE idgrade = '.$idgrade);
	}

	public function get($libelle)  {
		$q = $this->dbConnect()->query('SELECT * FROM grade WHERE libelle = "'.$libelle.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		
		if($donnees) {
			return new Grade($donnees);
		}else{
			return false;
		}
	}
	public function getFromId($grade_idgrade)  {
		$q = $this->dbConnect()->query('SELECT * FROM grade WHERE idgrade = "'.$grade_idgrade.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		
		if($donnees) {
			return new Grade($donnees);
		}else{
			return false;
		}
	}

	public function getList()  {
		$grade = [];
		$q = $this->dbConnect()->query('SELECT * FROM grade ORDER BY idgrade ASC');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))		{
			$grade[] = new Grade($donnees);
		}
		//echo"manager <PRE>";print_r($grade);echo"</PRE>";
		return $grade;
	}
	
	public function update(grade $grade)  {
		
		$q = $this->dbConnect()->prepare('UPDATE grade SET libelle = :libelle WHERE idgrade = :idgrade');
	
		$q->bindValue(':idgrade', $message->getIdgradee(), \PDO::PARAM_INT);
		$q->bindValue(':libellet', $message->getLibelle(), \PDO::PARAM_STR);

		$q->execute();
	}
}