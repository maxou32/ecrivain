<?php
namespace web_max\ecrivain\lib;
use web_max\ecrivain\controler\Controller;
use web_max\ecrivain\controler\AccesControl;
use web_max\ecrivain\lib\Config;

class Router{
	private $myRoad='';
	protected $request;
	protected $myParam;
	
	/**
	 * [[Construct]]
	 * @private
	 * @param [[Type]] $request [paramètres reçus du navigateur]
	 */
	public function __construct($request){

		$this->request = $request;
		$Loader = new \SplClassLoader('web_max\ecrivain\controler', 'controler');
		$Loader->register();
		$Loader1 = new \SplClassLoader('web_max\ecrivain\view', 'view');
		$Loader1->register();	
		$Loader2 = new \SplClassLoader('web_max\ecrivain\model', 'model');
		$Loader2->register();
		$Loader3 = new \SplClassLoader('web_max\ecrivain\lib', 'lib');
		$Loader3->register();

	}

	/**
	 * mise sous tableau des paramètres recus
	 * @param  array   $request    infos transmises par le navigateur          
	 * @param  boolean $cheminSeul Reçit un chemin sans autres paramètres
	 * @return array   qui présente les paramètres reçus
	 */
	private function getAction($request,$cheminSeul){
        $element = explode('/', key($request));
			if($cheminSeul){
			return $element['0'];
		}else{
			unset($element[0]);
			for($i = 1; $i < count($element); $i++)
			{
				$this->myParam[$element[$i]] = $element[$i+1];
				$i++;
			}
			return	$this->myParam;		
		}
    }

    /**
     * transforme des parametres reçus en un tableau
     * @param  string $request chaine recue du navigateur
     * @return array  tableau de parametres
     */
    private function getParams($request){
        $requestTested="";
		$toTransform=false;
		if(count($request)<1){
			foreach ($request as $key =>$value){
				empty($value) ? $requestTested=$key : true  ;
				$toTransform=true;
			}
		}
		
		
		if($toTransform){
				
			foreach ($request as $key => $value)
			{
				empty($value) ? null : $this->myParam[$key] = $value;
			}	
		}else{
			$this->myParam=$request;
		}
		return $this->myParam;
		// --------------------------------------------------------
		
    }
	
	/**
	 * Vérifie que l'utilisateur est autorisé à accéder à la vue demandée
	 * @return boolean Vrai si autorisé ou non
	 */
	private function autorizedAccess(){
		if($this->myRoad["security"]["niveauRequis"]>0){
			$monAccessControl=new $this->myRoad["security"]["className"];
			return $monAccessControl->verifAccessRight($this->myRoad["security"]["niveauRequis"]);
			
		}else{
			return true;
		}
	}
    /**
     * Cherche la route à suivre en fonction des informations transmises par le navigateur
     * la route est cherchée parmi toutes les routes contenues dans la classe Config
     */
    public function Router(){

		$Idchapters;
		try{   
			//on réceptionne  quelquechose
			$myConfig= new Config; 	
			if(isset($_GET)){
				$varAction="";
				$varAction=$this->getAction($_GET, true);
				$varParam=$this->getAction($_GET, false);
				$varPost=$this->getParams($_POST);
				if (isset($this->getParams($_GET)["cible"])){
					$varAction=$this->getParams($_GET)["cible"];
				}
				empty($varAction) ? $varAction="_messageView": false ;
				
				$this->myRoad=$myConfig->getRoad($varAction);
				
				if (isset($this->myRoad)){
					if( $this->autorizedAccess()){
						$monController=new Controller($this->myRoad,$varAction);
						$monController->prepareAction($varParam, $varPost);
					}else{
						$monError=new ErrorController();
						$monError->setError(array("origine"=> "web_max\ecrivain\lib\router\router", "raison"=>"utilisateur inconnu", "idMessage"=>12));
					
					}
				}
				
			}else{
				$varAction="_messageView"	;
				$myRoad=$myConfig->getRoad("_messageView");	
			}
			
		}
		catch (Exception $e){
			$monController->printError($e->getmessage());
		}
	}
}