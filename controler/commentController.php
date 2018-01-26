<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\model\Chapter;
use web_max\ecrivain\model\Comment;
use web_max\ecrivain\model\CommentManager;

class CommentController	extends MainController	{
	    
	public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
	}

    /**
     * Enregistre un commentaire .
     * @param  params    contient les informations du recues de l'écran
     */
	public function addComment($post){
		//echo"<PRE>CONTROLLER COMMENT  : chargeComment 1 ";print_r($post);echo"</PRE>";
		if( $post['sousAction']!=="fermer"){
			$donnees=array('name' => $post['name'], 'Content'=> $post['content'], 'date_fr'=>'', 'Users_IdUsers'=>Null, 'Status_IdStatus'=>2,'Chapter_IdChapter'=>$post['chapter'], 'email'=>$post['email']);
			$newComment = new Comment($donnees);
			$monCommentManager= new CommentManager;
			$resultat=$monCommentManager->add($newComment);
			$monChapter= new ChaptersManager();
			$leChapitre=$monChapter->get($newComment->getChapter_IdChapter());
			
			if ($resultat){
				$monError=new ErrorController();
				$monError->setError(array("origine"=> "web_max\ecrivain\controler\commentController", "raison"=>"Proposition de commentaire", "numberMessage"=>46));
			}
			return $chapitre['chap']=$leChapitre->getNumber();
		}
	}

    /**
     * Enregistre un commentaire .
     * @param  params    contient les informations du recues de l'écran
     */
	public function chargeComment($params, $operation){
		//echo"<PRE>CONTROLLER COMMENT  : chargeComment 1 ";print_r($operation);echo"</PRE>";
		
		$commentManager= new CommentManager();
		if(isset($params["chap"])){
			if($operation=="next"){
				$params["chap"]++;	
			}elseif($operation=="prev"){
				$params["chap"]--;
			}
			$chapterManager= new ChaptersManager;
			$monChapter= $chapterManager->getByNumber($params["chap"]);
			if (isset($monChapter['data'])){
				$comment=$commentManager->getListValidFromChapter($monChapter['data']->getIdchapters());	
			}else{
				$monError=new ErrorController();
				$monError->setError(array("origine"=> "web_max\ecrivain\lib\router\router", "raison"=>"Lecture chapitre", "numberMessage"=>60));
			}
		}else{
			$comment=$commentManager->getListValidFromChapter($params["idchapter"]);
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
		//echo"<PRE>CONTROLLER : validParamComments 1 ";print_r($params);echo"</PRE>";
		$resultat["result"]=false;		
		$commentManager= new CommentManager();

		foreach ($params['actionAFaire'] as $key => $value){	
			if (isset($params["D".$value])){
				$resultat["result"]=$commentManager->delete($value);
			}elseif(($params[$value])==! Null){
				$resultat["result"]=$commentManager->updateStatus($value, $params[$value]);
			}
		}
		if ($resultat["result"]){
			$monError=new ErrorController();
			$monError->setError(array("origine"=> "web_max\ecrivain\controler\commentController", "raison"=>"Mise à jour des commentaires", "numberMessage"=>23));
		}		
		return $resultat["result"];
	}		
	
	/**
     * modifie le status d'un commentaire pour le passer à l'état signalé ou inverse
     * 
     * @param  array $params le'id du commenatire signalé
     * @return l'id du chapitre concerné pour pouvoir le réafficher.
     */
	 public function signal($params){	
		//echo"<PRE>CONTROLLER : signal 1 ";print_r($params);echo"</PRE>";
		$resultat=false;		
		$commentManager= new CommentManager();
		$resultat=$commentManager->updateSignaled($params["comment"],true);
		$monComment=$commentManager->get($params["comment"]);
		
		$monChapter= new ChaptersManager();
		$leChapitre=$monChapter->get($monComment->getChapter_IdChapter());
		
		if ($resultat){
			$monError=new ErrorController();
			$monError->setError(array("origine"=> "web_max\ecrivain\controler\commentController", "raison"=>"Signalement de commentaire", "numberMessage"=>45));
		}

		return $chapitre['chap']=$leChapitre->getNumber();
	}		
}