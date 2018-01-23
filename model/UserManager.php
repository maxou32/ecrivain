<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;


class UserManager extends Manager{


	public function __construct(){
    
	}

	public function add(user $user)  {
		try{
			$q = $this->dbConnect()->prepare('INSERT INTO '.$this->prefix.'users(name, password, email, status_idstatus,grade_idgrade) VALUES(:name, :password, :email, :status_idstatus, :grade_idgrade)');

			$q->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
			$q->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
			$q->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
			$q->bindValue(':status_idstatus', $user->getStatus_IdStatus(), \PDO::PARAM_INT);
			$q->bindValue(':grade_idgrade', $user->getGrade_IdGrade(), \PDO::PARAM_INT);

			$q->execute();
			return true;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
	
	public function delete($idusers)  {
		try{
			$idusers = (int) $idusers;
			$this->dbConnect()->exec('DELETE FROM '.$this->prefix.'users WHERE idusers = '.$idusers);
			return true;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
	
	public function get($userName)  {
		try{
			$q = $this->dbConnect()->query('SELECT * FROM '.$this->prefix.'users WHERE name = "'.$userName.'"');
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
			//echo " <br /><PRE>User manager ".print_r($donnees)."<PRE><br />";
			
			if($donnees) {
				return new User($donnees);
			}else{
				return false;
			}
			
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
	
	public function getList()  {
		try{
			$chapters = [];
			$q = $this->dbConnect()->query('SELECT idusers, name, email, status_idstatus, status_idstatus FROM '.$this->prefix.'users WHERE status_idstatus = 99 ORDER BY name ASC');
			while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
			{
				$users[] = new User($donnees);
			}
			return $users;

		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
	public function getListAll()  {
		$chapters = [];
		$q = $this->dbConnect()->query('SELECT * FROM '.$this->prefix.'users ORDER BY name ASC');
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$users[] = new User($donnees);
		}
		return $users;
	}
	
	public function updateUser(User $user)  {
		try {
			$q = $this->dbConnect()->prepare('UPDATE '.$this->prefix.'users SET status_idstatus  = :status_idstatus, grade_idgrade  = :grade_idgrade WHERE idusers = :idusers');
			$q->bindValue(':idusers', $user->getIdusers(), \PDO::PARAM_INT);
			$q->bindValue(':status_idstatus', $user->getStatus_IdStatus(), \PDO::PARAM_INT);
			$q->bindValue(':grade_idgrade', $user->getGrade_IdGrade(), \PDO::PARAM_INT);
			
			$q->execute();
			return true;
			
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
		
	}
	
	
	public function update(user $user)  {
		try{
			$q = $this->dbConnect()->prepare('UPDATE '.$this->prefix.'users SET name = :name, password = :password, email = :email, status_idstatus = :status_idstatus,grade_idgrade = :grade_idgrade WHERE idusers = :idusers');
		
			$q->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
			$q->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
			$q->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
			$q->bindValue(':status_idstatus', $user->getStatus_IdStatus(), \PDO::PARAM_INT);
			$q->bindValue(':grade_idgrade', $user->getGrade_IdGrade(), \PDO::PARAM_INT);
			$q->bindValue(':idusers', $user->getIdusers(), \PDO::PARAM_INT);
			echo"<PRE>";print_r($user);
			$q->execute();
			
			return true;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
}