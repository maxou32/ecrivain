<?php

	namespace web_max\ecrivain;
	//session_start();
	//use web_max\ecrivain\model;

require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\Manager.php');
require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\Chapter.php');


class ChaptersManager extends Manager{


	public function __construct(){
    
	}

	public function add(Chapter $chapter)  {
		$q = $this->dbConnect()->prepare('INSERT INTO chapters(title, resume, content,chapter_date,users_idusers, status_idstatus) VALUES(:title, :resume, :content, NOW(),:users_idusers, 2)');

		$q->bindValue(':title', $chapter->getTitle(), \PDO::PARAM_STR);
		$q->bindValue(':resume', $chapter->getResume(), \PDO::PARAM_STR);
		$q->bindValue(':content', $chapter->getContent(), \PDO::PARAM_STR);
		$q->bindValue(':users_idusers', $chapter->getUser_IdUsers(), \PDO::PARAM_INT);
		//$q->bindValue(':status_idstatus', $chapter->getStatus_IdStatus(), PDO::PARAM_INT);
		$q->execute();
	}

	public function delete($idchapter)  {
		$idchapter = (int) $idchapter;
		$this->dbConnect()->exec('DELETE FROM chapters WHERE idchapters = '.$idchapter);
	}

	public function get($idchapter)  {
		$idchapter = (int) $idchapter;

		$q = $this->dbConnect()->query('SELECT idchapters, title, resume, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers FROM chapters WHERE idchapters = '.$idchapter);
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		if($donnees) {
			return new Chapter($donnees);
		}else{
			return false;
		}
	
	}


	public function getList()  {
		$chapters = [];

		$q = $this->dbConnect()->query('SELECT idchapters, title, resume, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, status_idstatus FROM chapters ORDER BY chapter_date ASC');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$chapters[] = new Chapter($donnees);
		}

		return $chapters;
	}

	public function update(Chapter $chapter)  {
		$q = $this->dbConnect()->prepare('UPDATE chapters SET title = :title, resume = :resume, content = :content,  users_idusers= :users_idusers WHERE idchapters = :idchapters');

		$q->bindValue(':idchapters', $chapter->getIdchapters(), \PDO::PARAM_INT);
		$q->bindValue(':title', $chapter->getTitle(), \PDO::PARAM_STR);
		$q->bindValue(':resume', $chapter->getResume(), \PDO::PARAM_STR);
		$q->bindValue(':content', $chapter->getContent(), \PDO::PARAM_STR);
		$q->bindValue(':users_idusers', $chapter->getUser_IdUsers(), \PDO::PARAM_INT);
		
		$q->execute();
	}
}