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
		echo"<PRE>CONTROLLER : validStatusChapters 1 ";print_r($params);echo"</PRE>";

		$chapterManager= new ChaptersManager();
		foreach ($params['actionAFaire'] as $key => $value){	
			//echo"<PRE>CONTROLLER : validParamComments 2 ".$value." status ".$key."</PRE>";

			if (isset($params["D".$value])){
				$resultat["result"]=$chapterManager->delete($value);
			}else {
				if(is_null($params["number".$value])){
					$params["number".$value]=999;
				}
				if(($params[$value])==! Null){
					$donnees=array('Idchapters'=>$value,'Status_IdStatus'=>$params[$value],'number'=>$params["number".$value]);
					$newChapter = new Chapter($donnees);
					$resultat["result"]=$chapterManager->updateStatus($newChapter);		
				}
			}
		}
		if ($resultat["result"]){
			$monError=new ErrorController();
			$monError->setError(array("origine"=> "web_max\ecrivain\controler\chapterController", "raison"=>"Mise à jour des chapitres", "numberMessage"=>23));
		}		
		return $resultat["result"];
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
		foreach ($params['actionAFaire'] as $key => $value){	
			if (isset($params["D".$value])){
				$resultat["result"]=$userManager->delete($value);
			}else{
				$donnees=array('Idusers'=>$value,'Status_IdStatus'=>$params["S".$value], 'Grade_IdGrade'=>$params["G".$value]);
				$newUser = new User($donnees);
				$resultat["result"]=$userManager->updateUser($newUser);
			}
		}
		if ($resultat["result"]){
			$monError=new ErrorController();
			$monError->setError(array("origine"=> "web_max\ecrivain\controler\chapterController", "raison"=>"Mise à jour de la liste d'utilisateur", "numberMessage"=>23));
		}		
		return $resultat["result"];		
	}	
		
}