<?php
//namespace web_max\ecrivain;

class Router{
	protected $request;
	protected $myParam;
	
	public function __construct($request){
		$this->request = $request;
	}
	

	private function getAction()
    {
        $element = explode('/', $this->request['action']);
		//echo"<PRE>";print_r($element);echo"</PRE>"."fin getaction";
        return $element['0'];
    }

    private function getParams()
    {
        //echo"<PRE>debut getParam / <br />";print_r( $this->request);echo"</PRE>"."debut getParam";
		$elements = explode('/', $this->request['action']);
		//echo"<PRE>debut elements / <br />";print_r( $elements );echo"</PRE>"."debut getParam";
        /*
		unset($elements[0]);
        for($i = 0; $i < count($elements); $i++)
        {
			echo "elt ".$elements[$i]."<br />";
		   $params[$elements[$i]] = $elements[$i+1];
            $i++;
        }
		*/
		return $this->myParam;
		// --------------------------------------------------------
		
    }
	
	private function theRoad($road){
		$theRoad=$variable=preg_split("/_/",$road);
		return $theRoad;
	}
	
	public function Router(){
		
		$Idchapters;
		
		try{   
			define("YAML", true );
			$monController=new Controller();
			
			//echo"<PRE> Début ROUTER ";print_r($this->request);echo"</PRE>";
			if(count($_REQUEST)!==0){
				if(null!==$this->request['action']){
					$myConfig= new Config; 
					if(YAML) {
						//echo"ma fonction : ".$this->getAction()." fin getaction<br/>";
						$myFonction=$myConfig->getRoad($this->getAction());
						//echo"<br /> ma garde valide <br/>".$myFonction."<br />".$myConfig->isBrut($myFonction)."<br />";
						$this->myParam=$this->request;
						//echo"<PRE>parametres BRUTS ou NON ";print_r($this->myParam);echo"</PRE>";
						//echo"ma fonction : ".$myFonction." fin getaction<br/>";
						if($myFonction){
							
							if(null !==$myFonction){
								$myAccessControl = new AccessControl();
								//echo"<PRE>";print_r($theParam);echo"</PRE>";
								//regarde si accès réservé
								extract($isProtected=$myAccessControl->getIsProtected($myFonction));
								//echo "result :" . $result." pour grade = ". $_SESSION['Grade_IdGrade'];
								if($result){										// la zone st protégée
									if ($_SESSION['Grade_IdGrade']>=$result){
										//echo" ??? request ????<PRE>";print_r($this->request);echo"</PRE> fin PRE";
										//$Id=$this->getParams()[Idchapters];
										$monController->$myFonction($this->request);
									}else{
										//echo"<br /> ma garde est invalide <br/>";
										throw new Exception ('Vous n\'êtes pas habilité à utiliser cette fonction.');	
									}
								}else{
									//echo "accès autorisé à tous";
									//echo" ??? request ????<PRE>";print_r($this->getParams());echo"</PRE>";
									$monController->$myFonction( $this->getParams());	
								}
							}
						}
						exit;
					}	
				}
			}
			$monController->_BienvenueView();
			//throw new Exception (' Aucune action demandée !!! Héhééé',2);
		}
		catch (Exception $e){
			//echo 'erreur : '.$e->getmessage();
			$monController->printError($e->getmessage());
		}
	}
}