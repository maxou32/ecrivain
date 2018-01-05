<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\model\Chapter;
use web_max\ecrivain\model\Comment;
use web_max\ecrivain\model\CommentManager;

class CommentController	extends mainController	{
	    
public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
		//echo"<br /><pre> CONTROLLER CONSTRUCT ";print_r($this->myAction);echo"</pre>";
	}

    /**
     * Enregistre un commentaire .
     * @param  params    contient les informations du recues de l'écran
     */
	public function addComment($post){
		if( $post['sousAction']!=="fermer"){
			$donnees=array('name' => $post['name'], 'Content'=> $post['content'], 'date_fr'=>'', 'Users_IdUsers'=>Null, 'Status_IdStatus'=>2,'Chapter_IdChapter'=>$post['chapter'], 'email'=>$post['email']);
			$newComment = new Comment($donnees);
			$monCommentManager= new CommentManager;
			$monCommentManager->add($newComment);
		}
	}

    /**
     * Enregistre un commentaire .
     * @param  params    contient les informations du recues de l'écran
     */
	public function chargeComment($params){
		//echo"<PRE>CONTROLLER COMMENT  : chargeComment 1 ";print_r($params);echo"</PRE>";
		$commentManager= new CommentManager();
		if(isset($params["chap"])){
			$chapterManager= new ChaptersManager;
			$monChapter= $chapterManager->getByNumber($params["chap"]);
			//echo"<PRE>CONTROLLER COMMENT  CHAP:  2 ";print_r($monChapter);echo"</PRE>";
			$comment=$commentManager->getListValidFromChapter($monChapter->getIdchapters());
		}else{
			$comment=$commentManager->getListValidFromChapter($params["idchapter"]);
			//echo"<PRE>CONTROLLER COMMENT  IDCHAPTER: Fin 3 ";print_r($params["idchapter"]);echo"</PRE>";
		}
		return $comment;
	}
	
	/**
     * pour chaque couple (Commentaire, status) modifie les commentaires
     * 
     * @param  array $params couples à modifier
     * @return boolean resultat de la modification
     */
    public function validParamComments($params){	
		//echo"<PRE>CONTROLLER : validStatusChapters 1 ";print_r($params);echo"</PRE>";
		$resultat["result"]=false;		
		$commentManager= new CommentManager();

		$tableau= array();
		
		if(is_numeric($params["choix"])){
			$commentManager->updateStatus($params["choix"],implode( "', '", $params["actionAFaire"]));
		}else{
			$commentManager->deleteComments(implode( "', '", $params["actionAFaire"]));
		}
	
		return $resultat;
	}		
	
	public function signal($params){	
		//echo"<PRE>CONTROLLER : validStatusChapters 1 ";print_r($params);echo"</PRE>";
		$resultat["result"]=false;		
		$commentManager= new CommentManager();

		$commentManager->updateSignaled($params["comment"],$params["val"]);

		return $resultat;
	}		
}