<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;
use web_max\ecrivain\model\TypeMessage;

class TypeMessageManager extends Manager{


	public function __construct(){
    
	}

	public function add(typemessage $typemessage)  {
		$q = $this->dbConnect()->prepare('INSERT INTO typemessage(text) VALUES(:text');

		$q->bindValue(':text', $message->getTexte(), \PDO::PARAM_STR);		
		$q->execute();
	}

	public function delete($idtypemessage)  {
		$idtypemessage = (int) $idtypemessage;
		$this->dbConnect()->exec('DELETE FROM typemessage WHERE idtypemessage = '.$idtypemessage);
	}

	public function get($text)  {
		//echo " <br />Type message manager ".$texte."<br />";
		$q = $this->dbConnect()->query('SELECT * FROM typemessage WHERE text = "'.$text.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		//echo " <br /><PRE>Type message manager ".print_r($donnees)."<PRE><br />";
		
		if($donnees) {
			return new TypeMessage($donnees);
		}else{
			return false;
		}
	}
	public function getFromId($message_idtypemessage)  {
		//echo " <br />message manager ".$texte."<br />";
		$q = $this->dbConnect()->query('SELECT * FROM typemessage WHERE idtypemessage = "'.$message_idtypemessage.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		//echo " <br /><PRE>message manager ".print_r($donnees)."<PRE><br />";
		
		if($donnees) {
			return new TypeMessage($donnees);
		}else{
			return false;
		}
	}

	public function getList()  {
		$typemessage = [];
		$q = $this->dbConnect()->query('SELECT * FROM typemessage ORDER BY text ASC');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$typemessage[] = new TypeMessage($donnees);
		}
		return $typemessage;
	}
	
	public function update(typemessage $typemessage)  {
		
		$q = $this->dbConnect()->prepare('UPDATE typemessage SET text = :text WHERE idtypemessage = :idtypemessage');
	
		$q->bindValue(':idtypemessage', $message->getIdtypemessage(), \PDO::PARAM_INT);
		$q->bindValue(':text', $message->getTexte(), \PDO::PARAM_STR);
		
		//echo"<PRE>";print_r($message);
		$q->execute();
	}
}