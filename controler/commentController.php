<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\model\CommentManager;
use web_max\ecrivain\model\Comment;
use web_max\ecrivain\model\ChaptersManager;

class CommentController	{
	
	public function __construct(){
		
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
		$chapterManager= new ChaptersManager;
		$monChapter= $chapterManager->getByNumber($params["chap"]);
		//echo"<PRE>CONTROLLER COMMENT  :  2 ";print_r($monChapter);echo"</PRE>";
		
		
		$commentManager= new CommentManager();
		$comment=$commentManager->getListValidFromChapter($monChapter->getIdchapters());
		//echo"<PRE>CONTROLLER COMMENT  : Fin 3 ";print_r($comment);echo"</PRE>";
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