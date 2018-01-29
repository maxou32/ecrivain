<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\controler\ChapterController;
use web_max\ecrivain\model\Chapter;
use web_max\ecrivain\model\UserManager;
use web_max\ecrivain\model\User;


class Controller{
		//$param=[];
	private	$data= [];
	private	$globalParams=[];
	private	$return=[];
	private $afficheAccueil;
	
	
	/**
	 * constructeur
	 * @private
	 * @param array $myRoad route à suivre avec ses caractéristiques
	 */
	public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
		$this->afficheAccueil=false;
		}
	
	private function avantDonnees($params, $post){
			
		/** *****************************************************************
        * déclanchement de la fonction a exécuter avant lectures des données
        */
		
		if(!empty($this->myRoad["appelFonctionAvantData"]["className"])){
			$maClasse=new $this->myRoad["appelFonctionAvantData"]["className"]($this->myRoad, $this->myAction);		
			if($this->myRoad["appelFonctionAvantData"]["avecParam"]=="oui"){
				if(isset($this->myRoad["appelFonctionAvantData"]["nom"])){
					$function=$this->myRoad["appelFonctionAvantData"]["nom"];
					if($this->myRoad["appelFonctionAvantData"]["origine"]=="params"){
						$this->return=$maClasse->$function($params);
					}else{
						$this->return=$maClasse->$function($post);
					}						
				}
			}else{
				if(isset($this->myRoad["appelFonctionAvantData"]["nom"])) {
					$fonction=$this->myRoad["appelFonctionAvantData"]["nom"];
					$this->return= $maClasse->$fonction($post);
				}
			}
		}else{
			if($this->myRoad["appelFonctionAvantData"]["avecParam"]=="oui"){
				if(isset($this->myRoad["appelFonctionAvantData"]["nom"])) {
					$fonction=$this->myRoad["appelFonctionAvantData"]["nom"];
					if ($this->myRoad["appelFonctionAvantData"]["origine"]=="params"){
						$this->return= $this->$fonction($params);
					}else{
						$this->return= $this->$fonction($post);
					}
				}
			}else{
				if(isset($this->myRoad["appelFonctionAvantData"]["nom"])) {
					$fonction=$this->myRoad["appelFonctionAvantData"]["nom"];
					$this->return= $this->$fonction($post);
				}
			}
		   
		}	
	}
	
	private function lireDonnees($params, $post){
		/** *****************************************************************
        * déclanchement de la fonction a exécuter pour lire des données
        */	
		foreach($this->myRoad["manager"] as $element){
			if(!empty($element["nom"])){
				$monManager= new $element["nom"];	
				$action=$element["action"];
				$paramManager="";
				
				if($element["utiliseResultatFunctionAvant"]==="oui"){
					$this->data=$this->return;
				}else{
					if($element["avecParam"]==="oui"){
						foreach($element["lesParams"] as $elementParam){
							if($elementParam["origine"]==="post"){
								$paramManager=$post;
							}elseif($elementParam["origine"]==="get"){
								$paramManager=$params[$elementParam["nomParam"]]; 
							}elseif($element["utiliseResultatFunctionAvant"]!=="oui"){
								$paramManager=$elementParam["nomParam"];
							}
						}
					}
				}
				//$this->data=$this->return;
				if($element["excluResultatManager"]=="non"){
					if(gettype($monManager->$action($paramManager))=="class"){
						if(get_class($this->return)!=="Message"){
							$this->data=$monManager->$action($paramManager);	
						}
					}else{
						$this->data=$monManager->$action($paramManager);		
					}
				}
			}
		}
		//echo"<PRE>CONTROLLER : lire data ";print_r($paramManager);echo"</PRE>";
	}
		
	private function apresDonnees($params, $post){
		 /** *****************************************************************
        * déclanchement de la fonction a exécuter après lectures des données
        */
		//echo"<PRE><br />CONTROLLER 1: dat ";print_r($post);echo"</PRE>";
		//echo"<PRE><br>CONTROLLER 1.1: nbPram = ";print_r($params);echo"</PRE>"."<br />";
		//echo "<br /><pre>CONTROLLER 1.30 maxou: element = ";print_r($this->myRoad);echo"</pre>";
		foreach($this->myRoad["appelFonctionApresData"] as $element){
			
			if(isset($element["className"])){
				$maClasse=new $element["className"]($this->myRoad, $this->myAction);
				if(isset($element["lesParams"]["operation"])){
					$operation=$element["lesParams"]["operation"];
				}else{
					$operation=null;
				}
				if(isset($element["tableau"])){ 
					if(isset($element["nom"])){ 
						$function=$element["nom"];
						
						if($element["lesParams"]["origine"]=="post"){
							$this->globalParams [$element["tableau"]]=$maClasse->$function($post,$operation);
						}else{
							$this->globalParams [$element["tableau"]]=$maClasse->$function($params,$operation);
						}
						//echo"<PRE><br />CONTROLLER 2: dat ";print_r($this->globalParams );echo"</PRE>";
					}
				}else{
					if(isset($element["nom"])){ 
						$function=$element["nom"];
						if($element["lesParams"]["origine"]=="post"){
							$this->globalParams =$maClasse->$function($post,$operation);
						}else{
							$this->globalParams =$maClasse->$function($params,$operation);
						}
					}
				}
			}else{
				if(isset($element["tableau"])){ 
					if(isset($element["nom"])){ 
						if($element["lesParams"]["origine"]=="post"){
							$this->globalParams [$element["tableau"]]=$this->$element["nom"]($post);
						}else{
							$this->globalParams [$element["tableau"]]=$this->$element["nom"]($element);
						}
					}
				}else{
					if(isset($element["nom"])){ 
						if($element["lesParams"]["origine"]=="post"){
							$this->globalParams["init"] =$this->$element["nom"]($post);
						}else{
							$this->globalParams["init"] =$this->$element["nom"]($element);
						}
					}
				}
			}
			$nomParam=$element["lesParams"]["nomParam"];
			$nomParam=$this->globalParams;
			//echo"<PRE>CONTROLLER : signal 1 ";print_r($nomParam);echo"</PRE>";
		}
	}
	
	private function chargeVue($params, $post){
		/** *****************************************************************
        * déclanchement de la fonction a exécuter pour charger la vue
        */
		foreach($this->myRoad["view"] as $element){
			if($element["nom"]!==Null){
				if($element["nombreParam"]>0){
					foreach ($element["lesParams"] as $elementParam){
						
						if($elementParam["origine"]!=="dur"){
							$action="get".$elementParam["nomParam"];
							$this->globalParams[$elementParam["nomParam"]]=$this->myConfig->$action();
						}else{
							$this->globalParams[$elementParam["nomParam"]]=$elementParam["value"];
						}
					}
					$this->globalParams["updateDeleteAreAutorized"]=false;
					if($element["levelUpdate"]>0){
						$monAccessControl=new \web_max\ecrivain\controler\AccessControl();
						$this->globalParams["updateDeleteAreAutorized"]= $monAccessControl->verifAccessRight($element["levelUpdate"]);
					}
				}
				$this->globalParams["params"]= $params;
				$monMessageView = new $element["nom"]('template.php');  
				$monMessageView->show($this->globalParams,$this->data);
			}else{
				//echo " controle déclenchement vue 12 : vue inconnue";
			} 
		}
	}
	
	private function lanceRelocation($params, $post){
		/** *****************************************************************
        * déclanchement de la fonction a exécuter pour recharger une vue
        */
		//echo"<PRE><br />CONTROLLER 1: dat ";print_r($this->globalParams);echo"</PRE>";
		if($this->afficheAccueil){
			header('Location: index.php?');			
			
		}else if($this->myRoad["wantHeaderLocation"]["action"]=="oui"){
			if( $this->myRoad["wantHeaderLocation"]["param"]=="oui"){
				if($this->myRoad["wantHeaderLocation"]["origine"]=="post"){
					$critere=$this->myRoad["wantHeaderLocation"]["nom"].'/'.$post[$this->myRoad["wantHeaderLocation"]["nom"]];
				}else{
					$critere=$this->myRoad["wantHeaderLocation"]["nom"].'/'.$this->globalParams[$this->myRoad["wantHeaderLocation"]["nom"]];
				}
			}else{
				$critere="";
			}
			//echo"<PRE><br />CONTROLLER 1: dat ";print_r($this->myRoad["wantHeaderLocation"]["target"].$critere);echo"</PRE>";
			//echo"<PRE><br>CONTROLLER 1.1: critere = ";print_r($critere);echo"</PRE>"."<br />";

			header('Location: '.$this->myRoad["wantHeaderLocation"]["target"].$critere);
		

		}
	}
	
	/**
     * Exécution des actions pilotées apr la route chargée
     * @param array $params données reçues par $_GET
     * @param array $post   données reçues par $_POST
	 * 		en fonction des parametres de la route, effectue les opérations suivantes :
	 *          fonction avant lecture des données
	 *          fonction lire les données
	 *          fonction aprés lecture des données
	 *          fonction prépare vue
	 *          fonction relocation
	 *       
     */
    public function prepareAction($params, $post){
		//echo"<PRE><br />CONTROLLER 1: dat ";print_r($post);echo"</PRE>";
		//echo"<PRE><br>CONTROLLER 1.1: nbPram = ";print_r($params);echo"</PRE>"."<br />";
		//echo "<br /><pre>CONTROLLER 1.30 maxou: element = ";print_r($this->myRoad);echo"</pre>";
		
		if (isset($this->myRoad["appelFonctionAvantData"])){
			if($this->myRoad["appelFonctionAvantData"]["nombrefonction"]>0){
				$this->avantDonnees($params, $post);
			}
		}
		
		if(isset($this->myRoad["manager"])){
			//echo "<br />parame ".$params[$this->myRoad["manager"][0]["lesParams"][0]["nomParam"]]."|";
			
			if ($this->myRoad["manager"][0]["avecParam"]==="oui") {			
				if(iconv_strlen($params[$this->myRoad["manager"][0]["lesParams"][0]["nomParam"]])===0 && ($this->myRoad["manager"][0]["lesParams"][0]["origine"]==="get")){
					//echo "erreur manque parametre<pre>";
					//echo "<br />parame ".$params[$this->myRoad["manager"][0]["lesParams"][0]["nomParam"]];
					$monError=new ErrorController();
					$monError->setError(array("origine"=> "web_max\ecrivain\lib\router\router", "raison"=>"Paramètre manquant", "numberMessage"=>400));	
					$this->afficheAccueil=true;				
				}else{
					$this->lireDonnees($params, $post); 
				}
			}else{
				$this->lireDonnees($params, $post); 
			}
			
			//echo "<br />autorise rien : ".$this->myRoad["manager"][0]["autoriseRetourVide"];
			//echo "<br />nb data : ". count($this->data);
			//echo "<br />data : <pre>";print_r($this->data);echo"</pre> <br />fin data";
			if($this->myRoad["manager"][0]["autoriseRetourVide"] !=="oui" && $this->data===false){
				//echo "<br /> erreur trouvée";
				$monError=new ErrorController();
				$monError->setError(array("origine"=> "web_max\ecrivain\lib\router\router", "raison"=>"Chapitre inconnu", "numberMessage"=>60));	
				$this->afficheAccueil=true;
			}
		}
		
		if (isset($this->myRoad["appelFonctionApresData"]["nombrefonction"]) && !$this->afficheAccueil){
			//echo "<br />charge après";
			if(null!==($this->myRoad["appelFonctionApresData"]["nombrefonction"])){
				$this->apresDonnees($params, $post);
			}
		}
		if(isset($this->myRoad["view"]) && !$this->afficheAccueil){
			//echo "<br />charge vue";
			$this->chargeVue($params, $post);
		}
		
		if (isset($this->myRoad["wantHeaderLocation"]) || $this->afficheAccueil){
			$this->lanceRelocation($params, $post);
        }
		
	}
	
}