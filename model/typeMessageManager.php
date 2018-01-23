<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;
use web_max\ecrivain\model\TypeMessage;

class TypeMessageManager extends Manager{


	public function __construct(){
    
	}

	public function add(typemessage $typemessage)  {
		$q = $this->dbConnect()->prepare('INSERT INTO '.$this->prefix.'typemessage(text) VALUES(:text');

		$q->bindValue(':text', $message->getTexte(), \PDO::PARAM_STR);		
		$q->execute();
	}

	public function delete($idtypemessage)  {
		$idtypemessage = (int) $idtypemessage;
		$this->dbConnect()->exec('DELETE FROM '.$this->prefix.'typemessage WHERE idtypemessage = '.$idtypemessage);
	}

	public function get($text)  {
		$q = $this->dbConnect()->query('SELECT * FROM '.$this->prefix.'typemessage WHERE text = "'.$text.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		
		if($donnees) {
			return new TypeMessage($donnees);
		}else{
			return false;
		}
	}
	public function getFromId($message_idtypemessage)  {
		$q = $this->dbConnect()->query('SELECT * FROM '.$this->prefix.'typemessage WHERE idtypemessage = "'.$message_idtypemessage.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		
		if($donnees) {
			return new TypeMessage($donnees);
		}else{
			return false;
		}
	}

	public function getList()  {
		$typemessage = [];
		$q = $this->dbConnect()->query('SELECT * FROM '.$this->prefix.'typemessage ORDER BY text ASC');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$typemessage[] = new TypeMessage($donnees);
		}
		return $typemessage;
	}
	
	public function update(typemessage $typemessage)  {
		
		$q = $this->dbConnect()->prepare('UPDATE '.$this->prefix.'typemessage SET text = :text WHERE idtypemessage = :idtypemessage');
	
		$q->bindValue(':idtypemessage', $message->getIdtypemessage(), \PDO::PARAM_INT);
		$q->bindValue(':text', $message->getTexte(), \PDO::PARAM_STR);
		
		$q->execute();
	}
}