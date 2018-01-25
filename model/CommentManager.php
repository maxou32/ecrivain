<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;


class CommentManager extends Manager{

	public function __construct(){
		
	}

	public function add(Comment $comment)  {
		try{
			$q = $this->dbConnect()->prepare('INSERT INTO '.$this->prefix.'comments(name, content,comment_date,user_iduser, status_idstatus, chapter_idchapter, signaled) VALUES(:name, :content, NOW(),null, :status_idstatus, :chapter_idchapter, Null)');

			$q->bindValue(':name', $comment->getName(), \PDO::PARAM_STR);
			$q->bindValue(':status_idstatus', $comment->getStatus_IdStatus(), \PDO::PARAM_INT);
			$q->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
			$q->bindValue(':chapter_idchapter', $comment->getChapter_idchapter(), \PDO::PARAM_INT);
			$q->execute();
			return true;
					
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}

	public function delete($idcomment)  {
		try{
			$idcomment = (int) $idcomment;
			$this->dbConnect()->exec('DELETE FROM '.$this->prefix.'comments WHERE idcomments = '.$idcomment);
			return true;
					
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;
	}

	public function deleteComments($cible)  {
		try{
		
		$this->dbConnect()->exec("DELETE FROM '.$this->prefix.'comments WHERE idcomments IN ('" .  $cible.  "')");
		return true;
					
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}

	public function get($idcomment)  {
		try{
			$idcomment = (int) $idcomment;
			$q = $this->dbConnect()->query('SELECT idcomments, name,  content, DATE_FORMAT( comment_date, \'%d/%m/%Y\') as comment_date,user_iduser, chapter_idchapter,status_idstatus, signaled FROM '.$this->prefix.'comments WHERE idcomments = '.$idcomment);
			$donnees = $q->fetch(\PDO::FETCH_ASSOC);
			if($donnees) {
				return new Comment($donnees);
			}					
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}

	public function getListValid()  {
		try{
			$comments = [];
			$q = $this->dbConnect()->query('SELECT idcomments, name,  content, DATE_FORMAT( comment_date, \'%d/%m/%Y\') as comment_date,user_iduser, chapter_idchapter,status_idstatus,signaled FROM '.$this->prefix.'comments WHERE status_idstatus=1 ORDER BY idcomments DESC ');
			
			while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
				$comments[] = new Comment($donnees);
			}	
			return $comments;
						
					
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}

	public function getListNotValid()  {
		try{
			$comments = [];
			$q = $this->dbConnect()->query('SELECT idcomments, name,  content, DATE_FORMAT( comment_date, \'%d/%m/%Y\') as comment_date,user_iduser, chapter_idchapter,status_idstatus,signaled FROM '.$this->prefix.'comments WHERE status_idstatus <>1 ORDER BY comment_date ASC ');
			
			while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
				$comments[] = new Comment($donnees);
			}
			return $comments;
						
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}

	public function getListValidFromChapter($chap)  {
		try{
			$comments = [];
			$q = $this->dbConnect()->query('SELECT idcomments, name,  content, DATE_FORMAT( comment_date, \'%d/%m/%Y\') as comment_date,user_iduser, chapter_idchapter,status_idstatus, signaled FROM '.$this->prefix.'comments WHERE status_idstatus = 1 and chapter_idchapter = "' . $chap . '" ORDER BY idcomments DESC ');
			
			while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
				$comments[] = new Comment($donnees);
			}
			return $comments;
									
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
	
	
		
	public function update(Comment $comment)  {
		try{
			$q = $this->dbConnect()->prepare('UPDATE '.$this->prefix.'comments SET name = :name, content = :content, signaled = :signaled WHERE idcomments = :idcomments');

			$q->bindValue(':idcomments', $comment->getIdcomments(), \PDO::PARAM_INT);
			$q->bindValue(':name', $comment->getTitle(), \PDO::PARAM_STR);
			$q->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
			$q->bndValue(':signaled', $comment->getSignaled(), \PDO::PARAM_BOOL);
			
			$q->execute();
			return true;
					
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
	
	public function updateStatus( $cible,$action)  {
		try {
			//echo "cible : ".$cible;
			$q = $this->dbConnect()->prepare('UPDATE '.$this->prefix.'comments SET status_idstatus  = :status_idstatus,signaled  = 0 WHERE idcomments IN (' .  $cible.  ')');
			$q->bindValue(':status_idstatus', $action, \PDO::PARAM_INT);
			
			$q->execute();
			return true;
			
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
	public function updateSignaled($idcomment, $action)  {
		try {
			$idcomment = (int) $idcomment;
			$q = $this->dbConnect()->prepare('UPDATE '.$this->prefix.'comments SET signaled  = :signaled, status_idstatus  = :status_idstatus WHERE idcomments = :idcomments');
			$q->bindValue(':idcomments', $idcomment, \PDO::PARAM_INT);
			$q->bindValue(':signaled', $action, \PDO::PARAM_BOOL);			
			$q->bindValue(':status_idstatus', $action=="1" ? 2 : 1, \PDO::PARAM_INT);
			$q->execute();
			return true;
			
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
}