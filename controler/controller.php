<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\model\Chapter;
use web_max\ecrivain\model\UserManager;
use web_max\ecrivain\model\User;


class Controller{
		//$param=[];
	private	$data= [];
	private	$globalParams=[];
	private	$return=[];
	
	
	
	/**
	 * constructeur
	 * @private
	 * @param array $myRoad route à suivre avec ses caractéristiques
	 */
	public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
		//echo"<br /><pre> CONTROLLER CONSTRUCT ";print_r($this->myAction);echo"</pre>";
	}
	
	private function avantDonnees($params, $post){
			
		/** *****************************************************************
        * déclanchement de la fonction a exécuter avant lectures des données
        */
		
		//echo "<br /><pre>CONTROLLER 1.30 maxou: element = ";print_r($this->myRoad["appelFonctionAvantData"]);echo"</pre>";
		
		if(!empty($this->myRoad["appelFonctionAvantData"]["className"])){
			$maClasse=new $this->myRoad["appelFonctionAvantData"]["className"]($this->myRoad, $this->myAction);		
			if($this->myRoad["appelFonctionAvantData"]["avecParam"]=="oui"){
				if(isset($this->myRoad["appelFonctionAvantData"]["nom"])){
					$function=$this->myRoad["appelFonctionAvantData"]["nom"];
					if($this->myRoad["appelFonctionAvantData"]["origine"]=="params"){
						echo"<PRE><br />CONTROLLER 1.31: dat PARAm";print_r($params);echo"</PRE>";
						echo"<PRE><br />CONTROLLER 1.31: dat POST";print_r($post);echo"</PRE>";
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
			//echo "<br />CONTROLLER 1.5: Return valide access = ";print_r($return);echo"</pre>";
		}else{
			//echo "<br /><pre>CONTROLLER 1.32: element = ";print_r($this->myRoad["appelFonctionAvantData"]);echo"</pre>";
			if($this->myRoad["appelFonctionAvantData"]["avecParam"]=="oui"){
				if(isset($this->myRoad["appelFonctionAvantData"]["nom"])) {
					$fonction=$this->myRoad["appelFonctionAvantData"]["nom"];
					if ($this->myRoad["appelFonctionAvantData"]["origine"]=="params"){
						echo "<br /><pre>CONTROLLER 1.41: element = ";print_r($this->myRoad["appelFonctionAvantData"]);echo"</pre>";
						$this->return= $this->$fonction($params);
					}else{
						//echo "<br /><pre>CONTROLLER 1.42: element = ";print_r($post);echo"</pre>";
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
			//echo"<PRE> controller manager 2: data ";print_r($element);echo"</PRE>";
			//echo"<PRE> controller manager 3: data ";print_r($element["nom"]);echo"</PRE>";
			if(!empty($element["nom"])){
				//echo " <br />déclenchement lecture manager";
				$monManager= new $element["nom"];	
				$action=$element["action"];
				$paramManager="";
				
				if($element["utiliseResultatFunctionAvant"]=="oui"){
					$paramManager=$this->return;
				}else{
					if($element["avecParam"]="oui"){
						//echo"<PRE> controller manager 3.3: data ";print_r($element["lesParams"]);echo"</PRE>";
						
						foreach($element["lesParams"] as $elementParam){
							//echo"<PRE> controller manager 3,5: data ";print_r($elementParam);echo"</PRE>";
							if($elementParam["origine"]=="post"){
								$paramManager=$post;
							}elseif($elementParam["origine"]=="get"){
								//echo"<PRE> controller manager 3,6: data ";print_r($params);echo"</PRE>";
								$paramManager=$params[$elementParam["nomParam"]]; // pour thebook, oneChapter,delete
								//echo"<PRE> controller manager 3,7: data =";print_r($paramManager);echo"</PRE>";
							}elseif($element["utiliseResultatFunctionAvant"]!=="oui"){
								$paramManager=$elementParam["nomParam"];
								
							}
						}
					}
				}
				//echo"<PRE> controller manager 3,9: data ".$action." param =";print_r($this->return);echo"</PRE>";
				$this->data=$this->return;
				if($element["excluResultatManager"]=="non"){
					if(gettype($monManager->$action($paramManager))=="class"){
						if(get_class($this->return)!=="Message"){
							//echo"<PRE> controller manager 3,951: data ".$action." param =";print_r($paramManager);echo"</PRE>";
							$this->data=$monManager->$action($paramManager);	
						}
					}else{
						//echo"<PRE> controller manager 3,952: data ".$action." param =";print_r($paramManager);echo"</PRE>";
						$this->data=$monManager->$action($paramManager);		
					}
				}
			}
		}
		//echo"<br />CONTROLLER<PRE> controller manager 5: data ";print_r($data);echo"</PRE>";
	}
		
	private function apresDonnees($params, $post){
		 /** *****************************************************************
        * déclanchement de la fonction a exécuter après lectures des données
        */
		//echo "<br />CONTROLLER post generique 8.2 <PRE>";print_r($post);echo "</PRE>";
		//echo "<br />CONTROLLER params generique 8.2 <PRE>";print_r($params);echo "</PRE>";
		foreach($this->myRoad["appelFonctionApresData"] as $element){
			//echo"<PRE><br />CONTROLLER 8.21: dat ";print_r($element);echo"</PRE>";
			
			if(isset($element["className"])){
				$maClasse=new $element["className"]($this->myRoad, $this->myAction);
				if(isset($element["tableau"])){ 
					if(isset($element["nom"])){ 
						$function=$element["nom"];
						if($element["lesParams"]["origine"]=="post"){
							//echo "<br /><pre>CONTROLLER 8.22: Return $this->globalParams = ";print_r($element["nom"]);echo"</pre>";
							$this->globalParams [$element["tableau"]]=$maClasse->$function($post);
						}else{
							//echo "<br /><pre>CONTROLLER 8.22: Return globalParams = ";print_r($element["nom"]);echo"</pre>";
							$this->globalParams [$element["tableau"]]=$maClasse->$function($params);
							//echo "<br /><pre>CONTROLLER 8.22: Return globalParams = ";print_r($globalParams);echo"</pre>";
						}
					}
				}else{
					if(isset($element["nom"])){ 
						$function=$element["nom"];
						if($element["lesParams"]["origine"]=="post"){
							//echo "<br /><pre>CONTROLLER 8.23: Return globalParams = ";print_r($element["nom"]);echo"</pre>";
							$this->globalParams =$maClasse->$function($post);
						}else{
							//echo "<br /><pre>CONTROLLER 8.24: Return globalParams = ";print_r($element["nom"]);echo"</pre>";
							$this->globalParams =$maClasse->$function($params);
						}
					}
				}
			}else{
				//echo"<PRE><br />CONTROLLER 8.3: dat sans classe";print_r($element["nom"]);echo"</PRE>";
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
							//echo "<br /><pre>CONTROLLER 8.4: Return globalParams = ";print_r($element["nom"]);echo"</pre>";
							$this->globalParams["init"] =$this->$element["nom"]($post);
							//echo "<br /><pre>CONTROLLER 8.4: avec post = ";print_r($globalParams["init"]);echo"</pre>";
						}else{
							$this->globalParams["init"] =$this->$element["nom"]($element);
							//echo "<br /><pre>CONTROLLER 8.4: sans post = ";print_r($globalParams["init"]);echo"</pre>";
						}
					}
				}
				//echo "<br /><pre>CONTROLLER 8.5: Return globalParams = ";print_r($globalParams);echo"</pre>";
			}
			$nomParam=$element["lesParams"]["nomParam"];
			//echo "<br /><pre>CONTROLLER 8.6: Return valide access = ";print_r($globalParams);echo"</pre>";
		}
	}
	
	
	private function chargeVue($params, $post){
		/** *****************************************************************
        * déclanchement de la fonction a exécuter pour charger la vue
        */
		foreach($this->myRoad["view"] as $element){
			//echo " <br />déclenchement vue";
			if($element["nom"]!==Null){
				//echo"<PRE> controle déclenchement vue 9: data ";print_r( $element);echo"</PRE>";
				if($element["nombreParam"]>0){
					//echo "<br /><pre>CONTROLLER 9.3: Return globalParams = ";print_r($this->globalParams);echo"</pre>";
					foreach ($element["lesParams"] as $elementParam){
						
						if($elementParam["origine"]!=="dur"){
							$action="get".$elementParam["nomParam"];
							$this->globalParams[$elementParam["nomParam"]]=$this->myConfig->$action();
							//echo"<PRE> controle déclenchement vue 9.4: data ";print_r($this->globalParams);echo"</PRE>";
						}else{
							$this->globalParams[$elementParam["nomParam"]]=$elementParam["value"];
							//echo"<PRE> controle déclenchement vue 9.5: data ";print_r($this->globalParams);echo"</PRE>";
				
						}
					}
					$this->globalParams["updateDeleteAreAutorized"]=false;
					if($element["levelUpdate"]>0){
						$monAccessControl=new $this->myRoad["security"]["className"];
						$this->globalParams["updateDeleteAreAutorized"]= $monAccessControl->verifAccessRight($element["levelUpdate"]);
					}
				}
				$this->globalParams["params"]= $params;
				//echo"<PRE> controle déclenchement vue 10: globalParams ";print_r($this->globalParams);echo"</PRE>";
				//cho"<PRE> controle déclenchement vue 10: data ";print_r($this->data);echo"</PRE>";
				//echo"<PRE> controle déclenchement vue 11: globalParams ";print_r($element["nom"]);echo"</PRE>";
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
		//echo '<br />header = '.$this->myRoad["wantHeaderLocation"]["target"];
		//echo"<PRE> controle déclenchement vue 12: data ";print_r($post);echo"</PRE>";
		if($this->myRoad["wantHeaderLocation"]["action"]=="oui"){
			if( $this->myRoad["wantHeaderLocation"]["action"]=="oui"){
				if($this->myRoad["wantHeaderLocation"]["origine"]=="post"){
					$critere=$this->myRoad["wantHeaderLocation"]["nom"].'/'.$post[$this->myRoad["wantHeaderLocation"]["nom"]];
				}else{
					$critere=$this->myRoad["wantHeaderLocation"]["nom"].'/'.$params[$this->myRoad["wantHeaderLocation"]["nom"]];
				}
			}else{
				$critere="";
			}
			//cho"<PRE> controle déclenchement vue 13: data ";print_r($critere);echo"</PRE>";
			//echo '<br />header = '.$this->myRoad["wantHeaderLocation"]["target"].$critere;
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
		if(null!==($this->myRoad["appelFonctionAvantData"]["nombrefonction"])){
			$this->avantDonnees($params, $post);
		}
		
         //echo "<br /><pre>CONTROLLER 1.5: Return valide access = ";print_r($return);echo"</pre>";
		
		if(isset($this->myRoad["manager"])){
			$this->lireDonnees($params, $post); 
		}
		
        if(null!==($this->myRoad["appelFonctionApresData"]["nombrefonction"])){
			$this->apresDonnees($params, $post);
        }
		
		if(isset($this->myRoad["view"])){
			$this->chargeVue($params, $post);
		}
		
		if(isset($this->myRoad["wantHeaderLocation"]["action"])){ 
			$this->lanceRelocation($params, $post);
        }
		
	}
	
    /**
     * affichage des erreurs
     * @param [[Type]] $error [[Description]]
     */
    function printError($error){
		if (!isset($error)) {
			$message ="error undefined";	
		}else{
			$message ="message d'erreur	: ". $error;
		}
		
		$monFooter= new _footerView(NULL);
		$monFooter->getMessage($message);
		$footerView=$monFooter->show(NULL, NULL);
		
		$monTemplate= new template("",NULL,$footerView,NULL);
		$monTemplate->show(NULL, NULL);
		
	}
	
}