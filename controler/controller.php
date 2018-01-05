<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\model\Chapter;
use web_max\ecrivain\model\UserManager;
use web_max\ecrivain\model\User;


class Controller{
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
	

	/**
     * Exécution des actions pilotées apr la route chargée
     * @param array $params données reçues par $_GET
     * @param array $post   données reçues par $_POST
     */
    public function prepareAction($params, $post){
		$param=[];
		$data= [];
		$globalParams=[];
		$return=[];
		
		//echo"<PRE><br />CONTROLLER 1: dat ";print_r($post);echo"</PRE>";
		//echo"<PRE><br>CONTROLLER 1.1: nbPram = ";print_r($params);echo"</PRE>"."<br />";
		//echo "<br /><pre>CONTROLLER 1.30 maxou: element = ";print_r($this->myRoad);echo"</pre>";
		
		/** *****************************************************************
        * déclanchement de la fonction a exécuter avant lectures des données
        */
		if(null!==($this->myRoad["appelFonctionAvantData"]["nombrefonction"])){
			//echo "<br /><pre>CONTROLLER 1.30 maxou: element = ";print_r($this->myRoad["appelFonctionAvantData"]);echo"</pre>";
            $return=[];
            if(!empty($this->myRoad["appelFonctionAvantData"]["className"])){
                $maClasse=new $this->myRoad["appelFonctionAvantData"]["className"]($this->myRoad, $this->myAction);		
				if($this->myRoad["appelFonctionAvantData"]["avecParam"]=="oui"){
					if(isset($this->myRoad["appelFonctionAvantData"]["nom"])){
						$function=$this->myRoad["appelFonctionAvantData"]["nom"];
						if($this->myRoad["appelFonctionAvantData"]["origine"]=="params"){
							//echo"<PRE><br />CONTROLLER 1.31: dat ";print_r($params);echo"</PRE>";
							$return=$maClasse->$function($params);
						}else{
							$return=$maClasse->$function($post);
						}						
					}
				}else{
                    if(isset($this->myRoad["appelFonctionAvantData"]["nom"])) {
                        $fonction=$this->myRoad["appelFonctionAvantData"]["nom"];
                        $return= $maClasse->$fonction($post);
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
                            $return= $this->$fonction($params);
                        }else{
                            //echo "<br /><pre>CONTROLLER 1.42: element = ";print_r($post);echo"</pre>";
                            $return= $this->$fonction($post);
                        }
                    }
                }else{
                    if(isset($this->myRoad["appelFonctionAvantData"]["nom"])) {
                        $fonction=$this->myRoad["appelFonctionAvantData"]["nom"];
                        $return= $this->$fonction($post);
                    }
                }
                //echo "<br /><pre>CONTROLLER 1.5: Return valide access = ";print_r($return);echo"</pre>";
            }
		}
        
		/** *****************************************************************
        * déclanchement de la fonction a exécuter pour lire des données
        */	
		if(isset($this->myRoad["manager"])){
			foreach($this->myRoad["manager"] as $element){
				//echo"<PRE> controller manager 2: data ";print_r($element);echo"</PRE>";
				//echo"<PRE> controller manager 3: data ";print_r($element["nom"]);echo"</PRE>";
				if(!empty($element["nom"])){
					//echo " <br />déclenchement lecture manager";
					$monManager= new $element["nom"];	
					$action=$element["action"];
					$paramManager="";
					
					if($element["utiliseResultatFunctionAvant"]=="oui"){
						$paramManager=$return;
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
					//echo"<PRE> controller manager 3,9: data ".$action." param =";print_r($return);echo"</PRE>";
					$data=$return;
					if($element["excluResultatManager"]=="non"){
						if(gettype($monManager->$action($paramManager))=="class"){
							if(get_class($return)!=="Message"){
								//echo"<PRE> controller manager 3,951: data ".$action." param =";print_r($paramManager);echo"</PRE>";
								$data=$monManager->$action($paramManager);	
							}
						}else{
							//echo"<PRE> controller manager 3,952: data ".$action." param =";print_r($paramManager);echo"</PRE>";
							$data=$monManager->$action($paramManager);		
						}
					}
				}
			}
			//echo"<br />CONTROLLER<PRE> controller manager 5: data ";print_r($data);echo"</PRE>";
		}
		        
        /** *****************************************************************
        * déclanchement de la fonction a exécuter après lectures des données
        */
		if(null!==($this->myRoad["appelFonctionApresData"]["nombrefonction"])){
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
								//echo "<br /><pre>CONTROLLER 8.22: Return globalParams = ";print_r($element["nom"]);echo"</pre>";
								$globalParams [$element["tableau"]]=$maClasse->$function($post);
							}else{
								//echo "<br /><pre>CONTROLLER 8.22: Return globalParams = ";print_r($element["nom"]);echo"</pre>";
								$globalParams [$element["tableau"]]=$maClasse->$function($params);
								//echo "<br /><pre>CONTROLLER 8.22: Return globalParams = ";print_r($globalParams);echo"</pre>";
							}
						}
					}else{
						if(isset($element["nom"])){ 
							$function=$element["nom"];
							if($element["lesParams"]["origine"]=="post"){
								//echo "<br /><pre>CONTROLLER 8.23: Return globalParams = ";print_r($element["nom"]);echo"</pre>";
								$globalParams =$maClasse->$function($post);
							}else{
								//echo "<br /><pre>CONTROLLER 8.24: Return globalParams = ";print_r($element["nom"]);echo"</pre>";
								$globalParams =$maClasse->$function($params);
							}
						}
					}
				}else{
					//echo"<PRE><br />CONTROLLER 8.3: dat sans classe";print_r($element["nom"]);echo"</PRE>";
					if(isset($element["tableau"])){ 
						if(isset($element["nom"])){ 
							if($element["lesParams"]["origine"]=="post"){
								$globalParams [$element["tableau"]]=$this->$element["nom"]($post);
							}else{
								$globalParams [$element["tableau"]]=$this->$element["nom"]($element);
							}
						}
					}else{
						if(isset($element["nom"])){ 
							if($element["lesParams"]["origine"]=="post"){
								//echo "<br /><pre>CONTROLLER 8.4: Return globalParams = ";print_r($element["nom"]);echo"</pre>";
								$globalParams["init"] =$this->$element["nom"]($post);
								//echo "<br /><pre>CONTROLLER 8.4: avec post = ";print_r($globalParams["init"]);echo"</pre>";
							}else{
								$globalParams["init"] =$this->$element["nom"]($element);
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

		/** *****************************************************************
        * déclanchement de la fonction a exécuter pour charger la vue
        */
		if(isset($this->myRoad["view"])){
			foreach($this->myRoad["view"] as $element){
				//echo " <br />déclenchement vue";
				if($element["nom"]!==Null){
					//echo"<PRE> controle déclenchement vue 9: data ";print_r( $element);echo"</PRE>";
					if($element["nombreParam"]>0){
						//echo "<br /><pre>CONTROLLER 9.3: Return globalParams = ";print_r($globalParams);echo"</pre>";
						foreach ($element["lesParams"] as $elementParam){
							
							if($elementParam["origine"]!=="dur"){
								$action="get".$elementParam["nomParam"];
								$globalParams[$elementParam["nomParam"]]=$this->myConfig->$action();
								//echo"<PRE> controle déclenchement vue 9.4: data ";print_r($globalParams);echo"</PRE>";
							}else{
								$globalParams[$elementParam["nomParam"]]=$elementParam["value"];
								//echo"<PRE> controle déclenchement vue 9.5: data ";print_r($globalParams);echo"</PRE>";
					
							}
						}
						$globalParams["updateDeleteAreAutorized"]=false;
						if($element["levelUpdate"]>0){
							$monAccessControl=new $this->myRoad["security"]["className"];
							$globalParams["updateDeleteAreAutorized"]= $monAccessControl->verifAccessRight($element["levelUpdate"]);
						}
					}
					$globalParams["params"]= $params;
					//echo"<PRE> controle déclenchement vue 10: globalParams ";print_r($globalParams);echo"</PRE>";
					//cho"<PRE> controle déclenchement vue 10: data ";print_r($data);echo"</PRE>";
					//echo"<PRE> controle déclenchement vue 11: globalParams ";print_r($element["nom"]);echo"</PRE>";
					$monMessageView = new $element["nom"]('template.php');  
					$monMessageView->show($globalParams,$data);
				}else{
					//echo " controle déclenchement vue 12 : vue inconnue";
				} 
			}
		}
        
		/** *****************************************************************
        * déclanchement de la fonction a exécuter pour recharger une vue
        */
		if(isset($this->myRoad["wantHeaderLocation"]["action"])){ 
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