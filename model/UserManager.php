<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;


class UserManager extends Manager{


	public function __construct(){
    
	}

	public function add(user $user)  {
		$q = $this->dbConnect()->prepare('INSERT INTO users(name, password, email, status_idstatus,grade_idgrade) VALUES(:name, :password, :email, :status_idstatus, :grade_idgrade)');

		$q->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
		$q->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
		$q->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
		$q->bindValue(':status_idstatus', $user->getStatus_IdStatus(), \PDO::PARAM_INT);
		$q->bindValue(':grade_idgrade', $user->getGrade_IdGrade(), \PDO::PARAM_INT);

		$q->execute();
	}

	public function delete($idusers)  {
		$idusers = (int) $idusers;
		$this->dbConnect()->exec('DELETE FROM users WHERE idcusers = '.$idusers);
	}

	public function get($userName)  {
		//echo " <br />User manager ".$userName."<br />";
		$q = $this->dbConnect()->query('SELECT * FROM users WHERE name = "'.$userName.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		//echo " <br /><PRE>User manager ".print_r($donnees)."<PRE><br />";
		
		if($donnees) {
			return new User($donnees);
		}else{
			return false;
		}
	}

	public function getList()  {
		$chapters = [];
		$q = $this->dbConnect()->query('SELECT idusers, name, email, status_idstatus, status_idstatus FROM users WHERE status_idstatus = 99 ORDER BY name ASC');
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$users[] = new User($donnees);
		}
		return $users;
	}
	
	public function getListAll()  {
		$chapters = [];
		$q = $this->dbConnect()->query('SELECT * FROM users ORDER BY name ASC');
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$users[] = new User($donnees);
		}
		return $users;
	}
	
	public function updateUser(User $user)  {
		try {
			$q = $this->dbConnect()->prepare("UPDATE users SET status_idstatus  = :status_idstatus, grade_idgrade  = :grade_idgrade WHERE idusers = :idusers");
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
		
		$q = $this->dbConnect()->prepare('UPDATE users SET name = :name, password = :password, email = :email, status_idstatus = :status_idstatus,grade_idgrade = :grade_idgrade WHERE idusers = :idusers');
	
		$q->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
		$q->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
		$q->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
		$q->bindValue(':status_idstatus', $user->getStatus_IdStatus(), \PDO::PARAM_INT);
		$q->bindValue(':grade_idgrade', $user->getGrade_IdGrade(), \PDO::PARAM_INT);
		$q->bindValue(':idusers', $user->getIdusers(), \PDO::PARAM_INT);
		echo"<PRE>";print_r($user);
		$q->execute();
	}
}