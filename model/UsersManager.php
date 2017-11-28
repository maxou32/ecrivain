<?php

//namespace web_max\ecrivain\model;

require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\Manager.php');


class UserManager extends Manager{


	public function __construct(){
    
	}

	public function add(user $user)  {
		$q = $this->dbConnect()->prepare('INSERT INTO users(name, email, status_idstatus,grade_idgrade) VALUES(:name, :email, :status_idstatus, :grade_idgrade)');

		$q->bindValue(':name', $user->name());
		$q->bindValue(':email', $user->email(), PDO::PARAM_INT);
		$q->bindValue(':status_idstatus', $user->status_idstatus(), PDO::PARAM_INT);
		$q->bindValue(':grade_idgrade', $user->grade_idgrade(), PDO::PARAM_INT);

		$q->execute();
	}

	public function delete(user $user)  {
		$this->dbConnect()->exec('DELETE FROM users WHERE idusers = '.$user->idusers());
	}

	private function get($user)  {
		$idchapters = (int) $idchapters;

		$q = $this->dbConnect()->query('SELECT idcusers, name, email, status_idstatus, grade_idgrade FROM chapters WHERE idusers = '.$idusers);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);

		return new user($donnees);
	}


	public function getList()  {
		$chapters = [];

		$q = $this->dbConnect()->query('SELECT idusers, name, email, status_idstatus, status_idstatus FROM users ORDER BY name ASC');
		
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$users[] = new user($donnees);
		}

		return $users;
	}

	public function update(user $user)  {
		$q = $this->dbConnect()->prepare('UPDATE users SET name = :name, email = :email, status_idstatus = :status_idstatus,grade_idgrade = :grade_idgrade WHERE idusers = :idusers');

		$q->bindValue(':name', $user->name(), PDO::PARAM_INT);
		$q->bindValue(':email', $user->email(), PDO::PARAM_INT);
		$q->bindValue(':status_idstatus', $user->status_idstatus(), PDO::PARAM_INT);
		$q->bindValue(':grade_idgrade', $user->grade_idgrade(), PDO::PARAM_INT);
		$q->bindValue(':idusters', $user->idusers(), PDO::PARAM_INT);

		$q->execute();
	}
}