<?php
	//namespace web_max\ecrivain;
	//use web_max\ecrivain\model;



class AuthorsManager extends UserManager{


	public function __construct(){
    
	}

	public function add(user $user)  {
		$q = $this->dbConnect()->prepare('INSERT INTO '.$this->prefix.'users(name, password, email, status_idstatus,grade_idgrade) VALUES(:name, :password, :email, :status_idstatus, :grade_idgrade)');

		$q->bindValue(':name', $user->getName(), \PDO::PARAM_INT);
		$q->bindValue(':password', $user->getPassword(), \PDO::PARAM_INT);
		$q->bindValue(':email', $user->getEmail(), \PDO::PARAM_INT);
		$q->bindValue(':status_idstatus', $user->getStatus_IdStatus(), \PDO::PARAM_INT);
		$q->bindValue(':grade_idgrade', 99, \PDO::PARAM_INT);

		$q->execute();
	}

	public function getList()  {
		$users = [];
		$q = $this->dbConnect()->query('SELECT idusers, name, email, status_idstatus, status_idstatus FROM '.$this->prefix.'users WHERE status_idstatus = 99 ORDER BY name ASC');
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$users[] = new User($donnees);
		}
		return $users;
	}
	
	public function update(user $user)  {
		$q = $this->dbConnect()->prepare('UPDATE '.$this->prefix.'users SET name = :name, password = :password, email = :email, status_idstatus = :status_idstatus,grade_idgrade = :grade_idgrade WHERE idusers = :idusers');

		$q->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
		$q->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
		$q->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
		$q->bindValue(':status_idstatus', $user->getStatus_IdStatus(), \PDO::PARAM_INT);
		$q->bindValue(':grade_idgrade', 99, \PDO::PARAM_INT);
		$q->bindValue(':idusers', $user->getIdUsers(), \PDO::PARAM_INT);

		$q->execute();
	}
}