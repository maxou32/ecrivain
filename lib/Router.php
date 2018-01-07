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
		//echo"<br />ROUTER : getAction <PRE>= ";print_r($element['0']);echo"</PRE>"."fin getaction de ROUTER";
		
		//echo"<PRE><br />ROUTER : get Params AVEC /  <br />";print_r( $element );echo"</PRE>"."<br />";
		if($cheminSeul){
			return $element['0'];
		}else{
			unset($element[0]);
			for($i = 1; $i < count($element); $i++)
			{
				//echo "elt ".$element[$i]."<br />";
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
		//echo"<PRE><br />ROUTER : debut getParam avec ou sans / <br />";print_r( $request);echo"</PRE>"."debut getParam";
		if(count($request)<1){
			foreach ($request as $key =>$value){
				empty($value) ? $requestTested=$key : true  ;
				$toTransform=true;
			}
		}
		
        //echo"<PRE><br />ROUTER : debut getParam 2 <br />";print_r( $requestTested);echo"</PRE>";
		
		
		if($toTransform){
	
			//echo"<PRE><br />ROUTER : get Params SANS /   <br />";print_r( $request );echo"</PRE>";
			
			foreach ($request as $key => $value)
			{
				//echo "<br /> Request : ".$key;
				empty($value) ? null : $this->myParam[$key] = $value;
			}	
		}else{
			$this->myParam=$request;
		}
		
		//echo"<PRE><br />ROUTER :fin  elements param  <br />";print_r( $this->myParam );echo"</PRE>"."fin getParam";
        
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
			//echo "ROUTER : _POST ? <pre> ";print_r($_POST);echo"</pre>";
			//echo "ROUTER : _GET ? <pre> ";print_r($_GET);echo"</pre>";
			
			//on réceptionne  quelquechose
			$myConfig= new Config; 	
			//echo "retour config OK";
			if(isset($_GET)){
				//echo "<br />ROUTER :action demandée OK <br />";
				
				$varAction="";
				$varAction=$this->getAction($_GET, true);
				//echo"<PRE><br />ROUTER verif vAR ACTION 0 ";print_r($this->getParams($_GET));echo"<br /> fin construct </PRE>";
				$varParam=$this->getAction($_GET, false);
				$varPost=$this->getParams($_POST);
				//echo"<PRE><br />ROUTER verif vAR ACTION 1 ";print_r($varPost);echo"<br /> fin construct </PRE>";
				if (isset($this->getParams($_GET)["cible"])){
					$varAction=$this->getParams($_GET)["cible"];
				}
				empty($varAction) ? $varAction="_messageView": false ;
				//echo"<PRE><br />ROUTER verif POST et GET ";print_r($varAction);echo"<br /> fin construct </PRE>";
				
				$this->myRoad=$myConfig->getRoad($varAction);
				//echo"<PRE><br />ROUTER retour route from config ";print_r($this->myRoad);echo"<br /> fin construct </PRE>";
				
				if (isset($this->myRoad)){
					//echo"<PRE><br />ROUTER parametre avant appel PrepareAction ";print_r($this->myRoad);echo"<br /> fin construct </PRE>";
					if( $this->autorizedAccess()){
						//echo"<PRE><br />ROUTER parametre avant appel CONTROLLER ";print_r($varAction);echo"<br /> </PRE>";
						$monController=new Controller($this->myRoad,$varAction);
						$monController->prepareAction($varParam, $varPost);
					}else{
						echo" non habilité";
					}
				}else{
					echo" erreur 404";
				}
				
			}else{
				//echo "<br /> Router : direction bienvenue...";
				$varAction="_messageView"	;
				$myRoad=$myConfig->getRoad("_messageView");	
				//echo"<PRE>ma route est inconnue ";print_r($myRoad);echo"<br /> fin construct </PRE>";
			}
			
		}
		catch (Exception $e){
			//echo 'erreur : '.$e->getmessage();
			$monController->printError($e->getmessage());
		}
	}
}