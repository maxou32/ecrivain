<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;

use web_max\ecrivain\model\StatusManager;
use web_max\ecrivain\model\GradeManager;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\model\Chapter;
use web_max\ecrivain\model\UserManager;
use web_max\ecrivain\model\User;

class AdminController	extends mainController	{
	    
	public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
		//echo"<br /><pre> CONTROLLER CONSTRUCT ";print_r($this->myAction);echo"</pre>";
	}

   /**
     * recherche les différents status d'un chapitre ou d'un utilisateur
     * @return array contenant les id et libelle des status
     */
    public function prepareAdminStatus(){
		$statusManager = new StatusManager();
		$status=$statusManager->getList();
		$datas=[];
		foreach ($status as $key => $value){
			$id=$status[$key]->getIdstatus();
			$datas[$id]=$value->getLibelle();	
		}
		//echo "<pre> Controler : prepareAdminStatus :";print_r($datas);echo"</pre>";
		return $datas;
	}
   /**
     * recherche les différents grade  d'un utilisateur
     * @return array contenant les id et libelle des grades
     */
    public function prepareAdminGrade(){
		$gradeManager = new GradeManager();
		$grade=$gradeManager->getList();
		$datas=[];
		foreach ($grade as $key => $value){
			$id=$grade[$key]->getIdgrade();
			$datas[$id]=$value->getLibelle();	
		}
		//echo "<pre> Controler : prepareAdminGrade :";print_r($datas);echo"</pre>";
		return $datas;
	}
    /**
     * pour chaque triplet (chapitre, status, numéro) modifie les chapitres
     * 
     * @param  array $params couples à modifier
     * @return boolean resultat de la mofication
     */
    public function validStatusChapters($params){	
		//echo"<PRE>CONTROLLER : validStatusChapters 1 ";print_r($params);echo"</PRE>";
		
		$chapterManager= new ChaptersManager();
		foreach($params as $key=> $value){
			if(is_numeric($value)){
				$donnees=[];
				if(is_numeric($key)){
					$donnees=array('Idchapters'=>$key,'Status_IdStatus'=>$value);
					//echo"Statuts <PRE>";print_r($donnees);echo"</PRE>";
					$newChapter = new Chapter($donnees);
					$return=$chapterManager->updateStatus($newChapter);
				}else{
					$donnees=array('Idchapters'=>preg_replace('#number#','',$key),'number'=>$value);
					//echo"NUMBER <PRE>";print_r($donnees);echo"</PRE>";
					$newChapter = new Chapter($donnees);
					$return=$chapterManager->updateNumber($newChapter);
				}
			}
		}
		$resultat["result"]=true;
		return $resultat;
	}

	/**
     * pour chaque triplet (chapitre, status, numéro) modifie les chapitres
     * 
     * @param  array $params couples à modifier
     * @return boolean resultat de la modification
     */
    public function validParamUsers($params){	
		//echo"<PRE>CONTROLLER : validStatusChapters 1 ";print_r($params);echo"</PRE>";
		
		$userManager= new UserManager();
		foreach($params as $key=> $value){
			if(!is_numeric($key)){
				$donnees=[];
				//echo "clef ".$key." initiale ".substr($key,0,1);
				if(substr($key,0,1)=="S"){
					//echo "clef : ".$key." donne ".substr($key,1);
					$donnees=array('Idusers'=>substr($key,1),'Status_IdStatus'=>$value);
					//echo" <PRE>";print_r($donnees);echo"</PRE>";
					$newUser = new User($donnees);
					$return=$userManager->updateStatus($newUser);
				}else{
					//echo "clef : ".$key." donne ".substr($key,1);
					$donnees=array('Idusers'=>substr($key,1),'Grade_IdGrade'=>$value);
					//echo" <PRE>";print_r($donnees);echo"</PRE>";
					$newUser = new User($donnees);
					$return=$userManager->updateGrade($newUser);
				}
			}
		}
		$resultat["result"]=true;
		return $resultat;
	}	
		
}