<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;


class ChaptersManager extends Manager{
	private $nbArticles;
	private $nbArticlesLus;

	public function __construct(){
		
	}

	public function add(Chapter $chapter)  {
		$q = $this->dbConnect()->prepare('INSERT INTO chapters(title, content,chapter_date,users_idusers, status_idstatus, number) VALUES(:title, :content, NOW(),:users_idusers, 2, :number)');

		$q->bindValue(':title', $chapter->getTitle(), \PDO::PARAM_STR);
		$q->bindValue(':number', $chapter->getNumber(), \PDO::PARAM_INT);
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
		$q = $this->dbConnect()->query('SELECT idchapters, title,  content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, number FROM chapters WHERE idchapters = '.$idchapter);
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		if($donnees) {
			return new Chapter($donnees);
		}else{
			return false;
		}
	}

	public function getListValid()  {
		$chapters = [];
		$q = $this->dbConnect()->query('SELECT idchapters, title, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, status_idstatus, number FROM chapters WHERE status_idstatus=1 ORDER BY number ASC');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
			$chapters[] = new Chapter($donnees);
		}

		return $chapters;
	}
	
	public function getListValidDesc()  {
		$chapters = [];
		$q = $this->dbConnect()->query('SELECT idchapters, title, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, status_idstatus, number FROM chapters WHERE status_idstatus=1 ORDER BY date_fr DESC');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
			$chapters[] = new Chapter($donnees);
		}

		return $chapters;
	}

		public function getListAll()  {
		$chapters = [];
		$q = $this->dbConnect()->query('SELECT idchapters, title, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, status_idstatus, number FROM chapters ORDER BY date_fr ASC ');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
			$chapters[] = new Chapter($donnees);
		}
		return $chapters;
	}

	public function getByNumber($number)  {
		$number = (int) $number;
		$q = $this->dbConnect()->query('SELECT idchapters, title,  content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, number FROM chapters WHERE number = '.$number);
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		if($donnees) {
			return new Chapter($donnees);
		}else{
			return false;
		}
	}
	
	public function update(Chapter $chapter)  {
		$q = $this->dbConnect()->prepare('UPDATE chapters SET title = :title, content = :content,  users_idusers= :users_idusers, number = :number WHERE idchapters = :idchapters');

		$q->bindValue(':idchapters', $chapter->getIdchapters(), \PDO::PARAM_INT);
		$q->bindValue(':title', $chapter->getTitle(), \PDO::PARAM_STR);
		$q->bindValue(':number', $chapter->getNumber(), \PDO::PARAM_INT);
		$q->bindValue(':content', $chapter->getContent(), \PDO::PARAM_STR);
		$q->bindValue(':users_idusers', $chapter->getUser_IdUsers(), \PDO::PARAM_INT);
		
		$q->execute();
	}
	
	public function updateStatus(Chapter $chapter)  {
		try {
			$q = $this->dbConnect()->prepare("UPDATE chapters SET status_idstatus  = :status_idstatus WHERE idchapters = :idchapters");
			$q->bindValue(':idchapters', $chapter->getIdchapters(), \PDO::PARAM_INT);
			echo  "chapite  ".$chapter->getIdchapters();
			echo  "status   ".$chapter->getStatus_IdStatus();
			$q->bindValue(':status_idstatus', $chapter->getStatus_IdStatus(), \PDO::PARAM_INT);
			
			$q->execute();
			return true;
			
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
	
	public function updateNumber(Chapter $chapter)  {
		try {
			$q = $this->dbConnect()->prepare("UPDATE chapters SET number  = :number WHERE idchapters = :idchapters");
			$q->bindValue(':idchapters', $chapter->getIdchapters(), \PDO::PARAM_INT);
			echo  "chapite  ".$chapter->getIdchapters();
			echo  "number   ".$chapter->getNumber();
			$q->bindValue(':number', $chapter->getNumber(), \PDO::PARAM_INT);
			
			$q->execute();
			return true;
			
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
}