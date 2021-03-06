<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;

class MessageManager extends Manager{


	public function __construct(){
    
	}

	public function add(message $message)  {
		try{
			$q = $this->dbConnect()->prepare('INSERT INTO '.$this->prefix.'message(texte, number, contexte, message_idtypemessage) VALUES(:texte, :number, :contexte, :message_idtypemessage)');
			$q->bindValue(':number', $message->getNumber(), \PDO::PARAM_INT);
			$q->bindValue(':texte', $message->getTexte(), \PDO::PARAM_STR);
			$q->bindValue(':contexte', $message->getContexte(), \PDO::PARAM_STR);
			$q->bindValue(':message_idtypemessage', $message->getMessage_idtypemessage(), \PDO::PARAM_INT);
			
			$q->execute() ;
			return true;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	

		
	}

	public function delete($id)  {
		try{
			$id = (int) $id;
			$this->dbConnect()->exec('DELETE FROM  '.$this->prefix.'message WHERE id = '.$id);
			return true;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}

	public function get($contexte)  {
		try{
			//echo " <br />message manager ".$contexte."<br />";
			$q = $this->dbConnect()->query('SELECT * FROM  '.$this->prefix.'message WHERE contexte = "'.$contexte.'" ORDER BY number ASC');
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
			
			if($donnees) {
				return new Message($donnees);
			}else{
				return false;
			}
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
	
	public function getByNumber($number)  {
		try{
			//echo " <br />message manager ".$id."<br />";
			$q = $this->dbConnect()->query('SELECT * FROM  '.$this->prefix.'message WHERE number = "'.$number.'"');
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
			
			if($donnees) {
				return new Message($donnees);
			}else{
				return false;
			}
			return true;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
	
	public function getList()  {
		try{
			$donnees = [];
			$q = $this->dbConnect()->query('SELECT * FROM  '.$this->prefix.'message ORDER BY number ASC');
			while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
			{
				$message[] = new Message($donnees);
			}
			return $message;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}

	public function getListByType($message_idtypemessage)  {
		try{
			$donnees = [];
			$messages=[];
			//echo "getListByType : Mon type message retour : ".$message_idtypemessage."<br />";
			
			$q = $this->dbConnect()->prepare('SELECT * FROM  '.$this->prefix.'message WHERE message_idtypemessage = :message_idtypemessage ORDER BY number ASC');	
			$q->bindValue(':message_idtypemessage', $message_idtypemessage, \PDO::PARAM_INT);
			$q->execute();
			
			while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
			{
				$messages[] = new Message($donnees);
			}
			//echo "<PRE> getListByType : Mon type message retour : ";print_r($messages);echo"</PRE><br />";
			return $messages;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
	
	public function update(message $message)  {
		
		try{
			$q = $this->dbConnect()->prepare('UPDATE  '.$this->prefix.'message SET texte = :texte, number = :number, contexte = :contexte WHERE id = :id');
	
			$q->bindValue(':id', $message->getId(), \PDO::PARAM_INT);
			$q->bindValue(':number', $message->getNumber(), \PDO::PARAM_INT);
			$q->bindValue(':texte', $message->getTexte(), \PDO::PARAM_STR);
			$q->bindValue(':contexte', $message->getContexte(), \PDO::PARAM_STR);
			
			//echo"<PRE>";print_r($message);
			$q->execute();
			return true;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
}