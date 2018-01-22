<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\model\Chapter;

class AsideController extends mainController	{

	public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
		//echo"<br /><pre> CONTROLLER CONSTRUCT ";print_r($this->myAction);echo"</pre>";
	}
	    
    /**
     * Recherche l'objet à afficher dans la barre aside
     * et charge les parametres avec
     * @objet  array    contenu à afficher par asideView
     */
    public	function chargeAside($post){
		
		$donnees=[];
		$aside=[];
		$monManager="";
		//echo"<br /><pre> charge ASIDE ";print_r($post);echo"</pre>";
		$asideParam=$this->myConfig->getAsideParam($this->myAction);

		foreach($this->myRoad["appelFonctionApresData"] as $element){
			if(is_array($element)){
				if($element["nom"]=="chargeAside"){
					$monAction= $element["lesParams"]["origine"];
					$monManager = new $element["lesParams"]["nomParam"];
					$donnees=$monManager->$monAction();
					$aside["title"]=$asideParam["title"];
					for($i=0;$i<count($donnees);$i++){
						$aside["value"][$i]["ref1"]=$donnees[$i]->$asideParam["ref1"]();     
						$aside["value"][$i]["content"]=$donnees[$i]->$asideParam["content"]();;
						$aside["value"][$i]["ref2"]=$donnees[$i]->$asideParam["ref2"]();
						$aside["value"][$i]["detail1"]=$donnees[$i]->$asideParam["detail"]();
					}
				}
			}
		}
		//echo"<br /><pre> charge ASIDE ";print_r($aside);echo"</pre>";
		return $aside;
	}
	
}