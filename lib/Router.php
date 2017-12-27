<?php
namespace web_max\ecrivain\lib;
use web_max\ecrivain\controler\Controller;
use web_max\ecrivain\controler\AccesControl;
use web_max\ecrivain\lib\Config;

class Router{
	protected $request;
	protected $myParam;
	
	public function __construct($request){

		$this->request = $request;
		$Loader = new \SplClassLoader('web_max\ecrivain\controler', 'D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\controler');
		$Loader->register();
		$Loader1 = new \SplClassLoader('web_max\ecrivain\view', 'D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view');
		$Loader1->register();	
		$Loader2 = new \SplClassLoader('web_max\ecrivain\model', 'D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model');
		$Loader2->register();
		$Loader3 = new \SplClassLoader('web_max\ecrivain\lib', 'D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\lib');
		$Loader3->register();

	}

	private function getAction($request,$cheminSeul)
    {
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

    private function getParams($request)
    {
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
	
	private function theRoad($road){
		$theRoad=$variable=preg_split("/_/",$road);
		return $theRoad;
	}
	
	public function Router(){

		$Idchapters;
		$myRoad='';
		try{   
			//echo "ROUTER : _POST ? <pre> ";print_r($_POST);echo"</pre>";
			//echo "ROUTER : _GET ? <pre> ";print_r($_GET);echo"</pre>";
			
			//on réceptionne  quelquechose
			$myConfig= new Config; 	
			//echo "retour config OK";
			if(isset($_GET)){
				//une action est demandée
				//echo "<br />ROUTER :action demandée OK <br />";
				$varAction=$this->getAction($_GET, true);
				$varParam=$this->getAction($_GET, false);
				$varPost=$this->getParams($_POST);
				//echo"<PRE><br />ROUTER verif POST et GET ";print_r($varAction);print_r($varParam);print_r($varPost);echo"<br /> fin construct </PRE>";
								
				$myRoad=$myConfig->getRoad($varAction);
				//echo"<PRE><br />ROUTER retour route from config ";print_r($myRoad);echo"<br /> fin construct </PRE>";
				
				if (isset($myRoad)){
					//echo "<br />ROUTER : appel controller avec myRoad <br />";
					$monController=new Controller($myRoad);
					//echo"<PRE><br />ROUTER parametre avant appel PrepareAction ";print_r($varPost);echo"<br /> fin construct </PRE>";
					$monController->prepareAction($varParam, $varPost);
				}else{
					//echo" erreur 404";
				}
				
			}else{
				//echo "<br /> Router : direction bienvenue...";
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