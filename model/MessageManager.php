<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;

class MessageManager extends Manager{


	public function __construct(){
    
	}

	public function add(message $message)  {
		$q = $this->dbConnect()->prepare('INSERT INTO message(texte, contexte,message_idtypemessage) VALUES(:texte, :contexte, :message_idtypemessage)');

		$q->bindValue(':texte', $message->getTexte(), \PDO::PARAM_STR);
		$q->bindValue(':contexte', $message->getContexte(), \PDO::PARAM_STR);
		$q->bindValue(':message_idtypemessage', $message->getMessage_idtypemessage(), \PDO::PARAM_INT);
		
		$q->execute() ;

		
	}

	public function delete($id)  {
		$id = (int) $id;
		$this->dbConnect()->exec('DELETE FROM message WHERE id = '.$id);
	}

	public function get($contexte)  {
		//echo " <br />message manager ".$texte."<br />";
		$q = $this->dbConnect()->query('SELECT * FROM message WHERE contexte = "'.$contexte.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		//echo " <br /><PRE>message manager ".print_r($donnees)."<PRE><br />";
		
		if($donnees) {
			return new Message($donnees);
		}else{
			return false;
		}
	}
	
	public function getList()  {
		$donnees = [];
		$q = $this->dbConnect()->query('SELECT * FROM message ORDER BY contexte ASC');
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$message[] = new Message($donnees);
		}
		return $message;
	}

	public function getListByType($message_idtypemessage)  {
		$donnees = [];
		$messages=[];
		//echo "getListByType : Mon type message retour : ".$message_idtypemessage."<br />";
		
		$q = $this->dbConnect()->prepare('SELECT * FROM message WHERE message_idtypemessage = :message_idtypemessage ORDER BY texte ASC');	
		$q->bindValue(':message_idtypemessage', $message_idtypemessage, \PDO::PARAM_INT);
		$q->execute();
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$messages[] = new Message($donnees);
		}
		//echo "<PRE> getListByType : Mon type message retour : ";print_r($messages);echo"</PRE><br />";
		return $messages;
	}
	
	public function update(message $message)  {
		
		$q = $this->dbConnect()->prepare('UPDATE message SET texte = :texte, contexte = :contexte WHERE id = :id');
	
		$q->bindValue(':id', $message->getId(), \PDO::PARAM_INT);
		$q->bindValue(':texte', $message->getTexte(), \PDO::PARAM_STR);
		$q->bindValue(':contexte', $message->getContexte(), \PDO::PARAM_STR);
		
		//echo"<PRE>";print_r($message);
		$q->execute();
	}
}