<?php
	namespace web_max\ecrivain;
	//session_start();
	//use web_max\ecrivain\model;

require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\Manager.php');
require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\User.php');


class UserManager extends Manager{


	public function __construct(){
    
	}

	public function add(user $user)  {
		$q = $this->dbConnect()->prepare('INSERT INTO users(name, password, email, status_idstatus,grade_idgrade) VALUES(:name, :password, :email, :status_idstatus, :grade_idgrade)');

		$q->bindValue(':name', $user->getName(), \PDO::PARAM_INT);
		$q->bindValue(':password', $user->getPassword(), \PDO::PARAM_INT);
		$q->bindValue(':email', $user->getEmail(), \PDO::PARAM_INT);
		$q->bindValue(':status_idstatus', $user->getStatus_IdStatus(), \PDO::PARAM_INT);
		$q->bindValue(':grade_idgrade', $user->getGrade_IdGrade(), \PDO::PARAM_INT);

		$q->execute();
	}

	public function delete(user $user)  {
		$this->dbConnect()->exec('DELETE FROM users WHERE idusers = '.$user->idusers());
	}

	public function get($userName)  {
		
		$q = $this->dbConnect()->query('SELECT idusers, name, password, email, status_idstatus, grade_idgrade FROM users WHERE name = "'.$userName.'"');
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		if($donnees) {
			return new User($donnees);
		}else{
			return false;
		}
	}


	public function getList()  {
		$chapters = [];

		$q = $this->dbConnect()->query('SELECT idusers, name, email, status_idstatus, status_idstatus FROM users ORDER BY name ASC');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$users[] = new User($donnees);
		}

		return $users;
	}

	public function update(user $user)  {
		$q = $this->dbConnect()->prepare('UPDATE users SET name = :name, password = :password, email = :email, status_idstatus = :status_idstatus,grade_idgrade = :grade_idgrade WHERE idusers = :idusers');

		$q->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
		$q->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
		$q->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
		$q->bindValue(':status_idstatus', $user->getStatus_IdStatus(), \PDO::PARAM_INT);
		$q->bindValue(':grade_idgrade', $user->getGrade_IdGrade(), \PDO::PARAM_INT);
		$q->bindValue(':idusers', $user->getIdUsers(), \PDO::PARAM_INT);

		$q->execute();
	}
}