<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\model\Chapter;

class AsideController extends MainController	{

	public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
		//echo"<br /><pre> CONTROLLER CONSTRUCT ";print_r($this->myAction);echo"</pre>";
	}
	 
	private function executeFunction($data, $fonction){
		return $data->$fonction(); 
	}
	
    /**
     * Recherche l'objet à afficher dans la barre aside
     * et charge les parametres avec
     * @objet  array    contenu à afficher par asideView
     */
    public function chargeAside($post){
		
		$donnees=[];
		$aside=[];
		$monManager="";
		$asideParam=$this->myConfig->getAsideParam($this->myAction);
		//echo"<br /><pre> charge ASIDE ";print_r($asideParam);echo"</pre>";
		
		foreach($this->myRoad["appelFonctionApresData"] as $element){
			if(is_array($element)){
				if($element["nom"]=="chargeAside"){
					$monAction= $element["lesParams"]["origine"];
					$monManager = new $element["lesParams"]["nomParam"];
					$donnees=$monManager->$monAction();
					$aside["title"]=$asideParam["title"];
					for($i=0;$i<count($donnees);$i++){
						$aside["value"][$i]["ref1"]= $this->executeFunction($donnees[$i],$asideParam["ref1"]);     
						$aside["value"][$i]["content"]= $this->executeFunction($donnees[$i],$asideParam["content"]);
						$aside["value"][$i]["ref2"]= $this->executeFunction($donnees[$i],$asideParam["ref2"]);
						$aside["value"][$i]["detail1"]= $this->executeFunction($donnees[$i],$asideParam["detail"]);
					}
				}
			}
		}
		//echo"<br /><pre> charge ASIDE ";print_r($aside);echo"</pre>";
		return $aside;
	}
	
}