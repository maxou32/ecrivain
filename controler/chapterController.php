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
		if( $post['sousAction']!=="fermer"){
			$donnees=array('Title' => $post['title'], 'Content'=> $post['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_SESSION['userId'], 'Status_IdStatus'=>1, 'number'=>$post['number']);
			return $newChapter = new Chapter($donnees);
		}
	}
	
    /**
     * modifie un chapitre
     * @param  array $post  infos du chapitre
     * @return object chapitre
     */
    public function updateOneChapter($post){
		//echo "<pre> Controler : update :";print_r($post);echo"</pre>";
		$donnees=array('idchapters'=>$post['idchapter'], 'Title' => $post['title'], 'Content'=> $post['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_SESSION['userId'], 'Status_IdStatus'=>1, 'Number'=> $post['number']);
		return $newChapter = new Chapter($donnees);
	}
	
}