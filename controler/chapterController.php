<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\model\Chapter;

class ChapterController	extends mainController	{
	
	public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
		//echo"<br /><pre> CONTROLLER CONSTRUCT ";print_r($this->myAction);echo"</pre>";
	}
	

    /**
     * ajoute un chapitre dans la base de données si la sousAction est <> de fermer
     * @param  array $post infos du chapitre
     * @return object chapitre
     */
    public function addOneChapter($post){

		$donnees=array('Title' => $post['title'], 'Content'=> $post['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_SESSION['userId'], 'Status_IdStatus'=>1, 'number'=>$post['number']);
		$mesChapters= new ChaptersManager();
		$result=$mesChapters->add( new Chapter($donnees));
		if ($result){
			$monError=new ErrorController();
			$monError->setError(array("origine"=> "web_max\ecrivain\controler\chapterController", "raison"=>"Ajoût d'un nouveau chapitre", "numberMessage"=>21));
		}		
		return $result;

	}
	
    /**
     * modifie un chapitre
     * @param  array $post  infos du chapitre
     * @return object chapitre
     */
    public function updateOneChapter($post){
		//echo "<pre> Controler : update :";print_r($post);echo"</pre>";
		$donnees=array('idchapters'=>$post['idchapter'], 'Title' => $post['title'], 'Content'=> $post['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_SESSION['userId'], 'Status_IdStatus'=>1, 'Number'=> $post['number']);
		$mesChapters= new ChaptersManager();
		$result=$mesChapters->update( new Chapter($donnees));
		if ($result){
			$monError=new ErrorController();
			$monError->setError(array("origine"=> "web_max\ecrivain\controler\chapterController", "raison"=>"Modication de chapitre", "numberMessage"=>23));
		}		
		return $result;
	}
	
	 /**
     * donne le nombre de chapitre valides
     * @param  array $post  infos des chapitres
     * @return nombre de chapitres
     */
    public function getChapterNumber(){
		//echo "<pre> Controler : update :";print_r($post);echo"</pre>";
		$mesChapters= new ChaptersManager();
		$result= $mesChapters->getNbChapter();
				
		return $result;
	}
}