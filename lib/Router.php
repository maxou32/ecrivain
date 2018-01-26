<?php
namespace web_max\ecrivain\lib;
use web_max\ecrivain\controler\Controller;
use web_max\ecrivain\controler\ErrorController;
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
		//echo "ROUTER CONSTRUCT <br/>".$request;
		$this->request = $request;
		$Loader = new \SplClassLoader('web_max\ecrivain\controler', 'controler');
		$Loader->register();
		$Loader1 = new \SplClassLoader('web_max\ecrivain\view', 'view');
		$Loader1->register();	
		$Loader2 = new \SplClassLoader('web_max\ecrivain\model', 'model');
		$Loader2->register();
		$Loader3 = new \SplClassLoader('web_max/ecrivain/lib', 'lib');
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
	private function autorizedAccess($varPost){

		$monAccessControl = new  \web_max\ecrivain\controler\AccessControl();
		//echo "<pre> Autorized Access";print_r($varPost);echo"</pre>";

		if($this->myRoad["seConnecte"]=== "oui"){
			return $monAccessControl->validAccessReserved($varPost);
		}else{
			if($this->myRoad["security"]["niveauRequis"]>0){
				return $monAccessControl->verifAccessRight($this->myRoad["security"]["niveauRequis"]);
			}else{
				return true;
			}
		}
	}
    /**
     * Cherche la route à suivre en fonction des informations transmises par le navigateur
     * la route est cherchée parmi toutes les routes contenues dans la classe Config
     */
    public function Router(){
		//echo "ROUTER router<br/>";
		try{   
			//on réceptionne  quelquechose
			//echo "ROUTER router -1<br/>";
			//echo "ROUTER router 0 = <pre>";print_r($_GET);echo "</pre><br />";
			$myConfig= new Config(); 
			
			//echo "ROUTER router 1<br/>";
			$varAction="";
			$varAction=$this->getAction($_GET, true);
			$varParam=$this->getAction($_GET, false);
			$varPost=$this->getParams($_POST);
			if (isset($this->getParams($_GET)["cible"])){
				$varAction=$this->getParams($_GET)["cible"];
			}
			//echo "ROUTER router 2<br/>";
			empty($varAction) ? $varAction="index": false ;
			//echo "ROUTER router 2.5 = <pre>";print_r($varAction);echo "</pre><br />";
			$this->myRoad=$myConfig->getRoad($varAction);
			
			if (isset($this->myRoad)){
				//echo "ROUTER router 3<br/>";
				if( $this->autorizedAccess($varPost)){
					//echo "ROUTER router 4<br/>";
					$monController=new Controller($this->myRoad,$varAction);
					$monController->prepareAction($varParam, $varPost);
				}else{
					//echo "ROUTER router 5<br/>";
					$monController=new Controller($myConfig->getRoad("index"),"_messageView");
					$monController->prepareAction(null, null);
				}
			}else{
				//echo "ROUTER router 6<br/>";
				$monError=new ErrorController();
				$monError->setError(array("origine"=> "web_max\ecrivain\lib\router\router", "raison"=>"URL inconnue", "numberMessage"=>404));	
				$monController=new Controller($myConfig->getRoad("index"),"_messageView");
				$monController->prepareAction(null, null);
			}
		
		}
		catch (Exception $e){
			$monError=new ErrorController();
			$monError->setError(array("origine"=> "web_max\ecrivain\lib\router\router", "raison"=>"Erreur inconnue", "numberMessage"=>30));	
		}
	}
}