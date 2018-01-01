<?php
namespace web_max\ecrivain\model;
use web_max\ecrivain\model\Manager;


class CommentManager extends Manager{

	public function __construct(){
		
	}

	public function add(Comment $comment)  {
		$q = $this->dbConnect()->prepare('INSERT INTO comments(name, content,comment_date,user_iduser, status_idstatus, chapter_idchapter) VALUES(:name, :content, NOW(),null, :status_idstatus, :chapter_idchapter)');

		$q->bindValue(':name', $comment->getName(), \PDO::PARAM_STR);
		$q->bindValue(':status_idstatus', $comment->getStatus_IdStatus(), \PDO::PARAM_INT);
		$q->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
		$q->bindValue(':chapter_idchapter', $comment->getChapter_idchapter(), \PDO::PARAM_INT);
		$q->execute();
	}

	public function delete($idcomment)  {
		$idcomment = (int) $idcomment;
		$this->dbConnect()->exec('DELETE FROM comments WHERE idcomments = '.$idcomment);
	}

	public function deleteComments($cible)  {
		echo "cible : ".$cible;
		$this->dbConnect()->exec("DELETE FROM comments WHERE idcomments IN ('" .  $cible.  "')");
	}

	public function get($idcomment)  {
		$idcomment = (int) $idcomment;
		$q = $this->dbConnect()->query('SELECT idcomments, name,  content, DATE_FORMAT( comment_date, \'%d/%m/%Y\') as comment_date,user_iduser, chapter_idchapter,status_idstatus FROM comments WHERE idcomments = '.$idcomment);
		$donnees = $q->fetch(\PDO::FETCH_ASSOC);
		if($donnees) {
			return new Comment($donnees);
		}else{
			return false;
		}
	}

	public function getListValid()  {
		$comments = [];
		$q = $this->dbConnect()->query('SELECT idcomments, name,  content, DATE_FORMAT( comment_date, \'%d/%m/%Y\') as comment_date,user_iduser, chapter_idchapter,status_idstatus FROM comments WHERE status_idstatus=1 ORDER BY comment_date ASC ');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
			$comments[] = new Comment($donnees);
		}	
		return $comments;
	}

		public function getListNotValid()  {
		$comments = [];
		$q = $this->dbConnect()->query('SELECT idcomments, name,  content, DATE_FORMAT( comment_date, \'%d/%m/%Y\') as comment_date,user_iduser, chapter_idchapter,status_idstatus FROM comments WHERE status_idstatus <>1 ORDER BY comment_date ASC ');
		
		while ($donnees = $q->fetch(\PDO::FETCH_ASSOC)){
			$comments[] = new Comment($donnees);
		}
		return $comments;
	}
	
	public function update(Comment $comment)  {
		$q = $this->dbConnect()->prepare('UPDATE comments SET name = :name, content = :content WHERE idcomments = :idcomments');

		$q->bindValue(':idcomments', $comment->getIdcomments(), \PDO::PARAM_INT);
		$q->bindValue(':name', $comment->getTitle(), \PDO::PARAM_STR);
		$q->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
		
		$q->execute();
	}
	
	public function updateStatus($action, $cible)  {
		try {
			echo "cible : ".$cible;
			$q = $this->dbConnect()->prepare("UPDATE comments SET status_idstatus  = :status_idstatus WHERE idcomments IN ('" .  $cible.  "')");
			$q->bindValue(':status_idstatus', $action, \PDO::PARAM_INT);
			
			$q->execute();
			return true;
			
		}catch (PDOException  $e){ 
			return 'Erreur : '.$e->getMessage();
		}	;	
	}
}