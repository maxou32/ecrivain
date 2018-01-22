<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;


class ChaptersManager extends Manager{
	private $nbArticles;
	private $nbArticlesLus;

	public function __construct(){
		
	}

	public function add(Chapter $chapter)  {
		try{
			$q = $this->dbConnect()->prepare('INSERT INTO chapters(title, content,chapter_date,users_idusers, status_idstatus, number) VALUES(:title, :content, NOW(),:users_idusers, 2, :number)');

			$q->bindValue(':title', $chapter->getTitle(), \PDO::PARAM_STR);
			$q->bindValue(':number', $chapter->getNumber(), \PDO::PARAM_INT);
			$q->bindValue(':content', $chapter->getContent(), \PDO::PARAM_STR);
			$q->bindValue(':users_idusers', $chapter->getUser_IdUsers(), \PDO::PARAM_INT);
			$q->execute();
			return true;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}

	public function delete($idchapter)  {
		try{
			$idchapter = (int) $idchapter;
			$this->dbConnect()->exec('DELETE FROM chapters WHERE idchapters = '.$idchapter);
			return true;			
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}

	public function get($idchapter)  {
		try{
			$idchapter = (int) $idchapter;
			$q = $this->dbConnect()->query('SELECT idchapters, title,  content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, number FROM chapters WHERE idchapters = '.$idchapter);
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
			
			if($donnees) {
				return new Chapter($donnees);
			}else{
				return false;
			}
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}

	public function getListValid()  {
		try{
			$chapters = [];
			$q = $this->dbConnect()->query('SELECT idchapters, title, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, status_idstatus, number FROM chapters WHERE status_idstatus=1 ORDER BY number ASC');
			
			while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
				$chapters[] = new Chapter($donnees);
			}

			return $chapters;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
	
	public function getListValidAsc()  {
		try{
			$chapters = [];
			$q = $this->dbConnect()->query('SELECT idchapters, title, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, status_idstatus, number FROM chapters WHERE status_idstatus=1 ORDER BY number ASC');
			
			while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
				$chapters[] = new Chapter($donnees);
			}

			return $chapters;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}

	public function getListAll()  {
		try{
			$chapters = [];
			$q = $this->dbConnect()->query('SELECT idchapters, title, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, status_idstatus, number FROM chapters ORDER BY date_fr ASC ');
			
			while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
				$chapters[] = new Chapter($donnees);
			}
			return $chapters;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}

	public function getByNumber($number)  {
		try{
			$number = (int) $number;
			$q = $this->dbConnect()->query('SELECT idchapters, title,  content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, number FROM chapters WHERE number = '.$number);
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
			
			$q1 = $this->dbConnect()->query('SELECT min(number) as valeur from chapters WHERE status_idstatus= 1');
			$mini= $q1->fetch(\PDO::FETCH_ASSOC);
			
			$q2 = $this->dbConnect()->query('SELECT max(number) as valeur from chapters WHERE status_idstatus= 1');
			$maxi= $q2->fetch(\PDO::FETCH_ASSOC);
			if($donnees) {
				$result['data']=new Chapter($donnees);
				$result['mini']=$mini;
				$result['maxi']=$maxi;
				return $result;
			}else{
				return false;
			}
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
	
	public function update(Chapter $chapter)  {
		try{
			$q = $this->dbConnect()->prepare('UPDATE chapters SET title = :title, content = :content,  users_idusers= :users_idusers, number = :number WHERE idchapters = :idchapters');

			$q->bindValue(':idchapters', $chapter->getIdchapters(), \PDO::PARAM_INT);
			$q->bindValue(':title', $chapter->getTitle(), \PDO::PARAM_STR);
			$q->bindValue(':number', $chapter->getNumber(), \PDO::PARAM_INT);
			$q->bindValue(':content', $chapter->getContent(), \PDO::PARAM_STR);
			$q->bindValue(':users_idusers', $chapter->getUser_IdUsers(), \PDO::PARAM_INT);
			
			$q->execute();
			return true;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
	
	public function updateStatus(Chapter $chapter)  {
		try {
			$q = $this->dbConnect()->prepare("UPDATE chapters SET status_idstatus  = :status_idstatus, number  = :number WHERE idchapters = :idchapters");
			$q->bindValue(':idchapters', $chapter->getIdchapters(), \PDO::PARAM_INT);
			$q->bindValue(':number', $chapter->getNumber(), \PDO::PARAM_INT);
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
	
	
	public function getNbChapter()  {
		try{
			$chapters = [];
			$q = $this->dbConnect()->query('SELECT  COUNT(*) as nbChapter FROM chapters WHERE status_idstatus=1 ');
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
			
			return $donnees;
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
	
	public function getNextChapter($number)  {
		try{
			$chapters = [];
			$q = $this->dbConnect()->query('SELECT idchapters, title,  content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, status_idstatus, number FROM chapters WHERE status_idstatus= 1 and number > '.$number.' order by number ASC LIMIT 1');
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
			
			$q1 = $this->dbConnect()->query('SELECT min(number) as valeur from chapters WHERE status_idstatus= 1');
			$mini= $q1->fetch(\PDO::FETCH_ASSOC);
			
			$q2 = $this->dbConnect()->query('SELECT max(number) as valeur from chapters WHERE status_idstatus= 1');
			$maxi= $q2->fetch(\PDO::FETCH_ASSOC);
			if($donnees) {
				$result['data']=new Chapter($donnees);
				$result['mini']=$mini;
				$result['maxi']=$maxi;
				return $result;
			}else{
				return false;
			}
			
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
	
	public function getPreviousChapter($number)  {
		try{
			$chapters = [];
			$q = $this->dbConnect()->query('SELECT idchapters, title,  content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr,users_idusers, status_idstatus, number FROM chapters WHERE status_idstatus= 1 and number < '.$number.' ORDER BY number DESC LIMIT 1');
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
			$q1 = $this->dbConnect()->query('SELECT min(number) as valeur from chapters WHERE status_idstatus= 1');
			$mini= $q1->fetch(\PDO::FETCH_ASSOC);
			
			$q2 = $this->dbConnect()->query('SELECT max(number) as valeur from chapters WHERE status_idstatus= 1');
			$maxi= $q2->fetch(\PDO::FETCH_ASSOC);
			if($donnees) {
				$result['data']=new Chapter($donnees);
				$result['mini']=$mini;
				$result['maxi']=$maxi;
				return $result;
			}else{
				return false;
			}
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}
}