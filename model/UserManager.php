<?php

//namespace web_max\ecrivain\model;

require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\Manager.php');


class UserManager extends Manager{


	public function __construct(){
    
	}

	public function add(user $user)  {
		$q = $this->dbConnect()->prepare('INSERT INTO users(name, password, email, status_idstatus,grade_idgrade) VALUES(:name, :password, :email, :status_idstatus, :grade_idgrade)');

		$q->bindValue(':name', $user->name(), PDO::PARAM_INT);
		$q->bindValue(':password', $user->password(), PDO::PARAM_INT);
		$q->bindValue(':email', $user->email(), PDO::PARAM_INT);
		$q->bindValue(':status_idstatus', $user->status_idstatus(), PDO::PARAM_INT);
		$q->bindValue(':grade_idgrade', $user->grade_idgrade(), PDO::PARAM_INT);

		$q->execute();
	}

	public function delete(user $user)  {
		$this->dbConnect()->exec('DELETE FROM users WHERE idusers = '.$user->idusers());
	}

	public function get($userName)  {
		
		$q = $this->dbConnect()->query('SELECT idusers, name, password, email, status_idstatus, grade_idgrade FROM users WHERE name = "'.$userName.'"');
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		if($donnees) {
			return new User($donnees);
		}else{
			return false;
		}
	}


	public function getList()  {
		$chapters = [];

		$q = $this->dbConnect()->query('SELECT idusers, name, email, status_idstatus, status_idstatus FROM users ORDER BY name ASC');
		
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$users[] = new User($donnees);
		}

		return $users;
	}

	public function update(user $user)  {
		$q = $this->dbConnect()->prepare('UPDATE users SET name = :name, password = :password, email = :email, status_idstatus = :status_idstatus,grade_idgrade = :grade_idgrade WHERE idusers = :idusers');

		$q->bindValue(':name', $user->name(), PDO::PARAM_STR);
		$q->bindValue(':password', $user->password(), PDO::PARAM_STR);
		$q->bindValue(':email', $user->email(), PDO::PARAM_STR);
		$q->bindValue(':status_idstatus', $user->status_idstatus(), PDO::PARAM_INT);
		$q->bindValue(':grade_idgrade', $user->grade_idgrade(), PDO::PARAM_INT);
		$q->bindValue(':idusers', $user->idusers(), PDO::PARAM_INT);

		$q->execute();
	}
}