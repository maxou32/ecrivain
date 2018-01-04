<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\UserManager;
use web_max\ecrivain\model\User;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\model\Chapter;
use web_max\ecrivain\view\_readOneChapterView;
use web_max\ecrivain\view\_askSendMailView;
use web_max\ecrivain\model\TypeMessageManager;
use web_max\ecrivain\model\Message;
use web_max\ecrivain\model\MessageManager;
use web_max\ecrivain\model\StatusManager;
use web_max\ecrivain\model\GradeManager;
use web_max\ecrivain\model\Comment;
use web_max\ecrivain\model\CommentManager;
use web_max\ecrivain\controler\messageController;
use web_max\ecrivain\controler\commentController;
	/*

use web_max\ecrivain\view\_AdminChaptersView;
use web_max\ecrivain\view\_messageView;
use web_max\ecrivain\view\_ListChaptersView;
use web_max\ecrivain\view\_TheBookView;
use web_max\ecrivain\view\_updateOneChapterView;
use web_max\ecrivain\view\_createOneChapterView;
use web_max\ecrivain\view\_FieldsUserView;
use web_max\ecrivain\view\_CRUDMessage;
use web_max\ecrivain\view\_askReservedAccess;
*/
class Controller{
	private $myRoad;
	private $myConfig;
	private $myAction;
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
     * mise à jour des éléments de session
     * @param object User $user user à stoker
     */
    private function updateSession(User $user){
		$_SESSION['user']=$user->getName();
		$_SESSION['userId']=$user->getIdusers();
		$_SESSION['userPwd']=$user->getPassword();
		$_SESSION['autorizedAccess']=$user->getGrade_IdGrade();
		$_SESSION['email']=$user->getEmail();
		$_SESSION['Grade_IdGrade']=$user->getGrade_IdGrade();
		$_SESSION['Status_IdStatus']=$user->getStatus_IdStatus();
	}	
	
    /**
     * Récupération du profil de l'utilisateur dans la session
     * @return array contenant les données de l'utilisateur
     */
    private function askUpdateProfil(){
		$monUserManager= new UserManager();
		$monUserManager->get($_SESSION['user']);
		$array["userName"]=$_SESSION['user'];
		$array["email"]=$_SESSION['email'];
		$array["action"]="update";
		return $array;
	}
	
    /**
     * Vérification des données de l'utilisateur
     * @param  array $params contient les infos de l'utilisateur à vérifier
     * @return array contenant le résultat et un libellé éventuel d'erreur
     */
    private function validAccessReserved($params){
		//echo"<PRE> COntroller : debut validAccessReserved";print_r($params);echo"</PRE>";
			
		if(isset($params['userName']) && isset($params['userPwd'])) {
			//echo "<br />COntroller : name : ".$params['userName']." pwd ".$params['userPwd'];
			$monUserManager=new UserManager;
			
			$user=$monUserManager->get($params['userName']);
			if(!$user){
				throw new Exception ('Vous n\'êtes pas habilité à administrer ce roman.');			
			}elseif(hash('sha256',$params['userPwd'])==$user->getPassword()){
				//echo COntroller :"ça marche";
				$this->updateSession($user);
				//header('Location: index.php');
				return array("result"=>true);
			}else{
				return array("result"=>false, "message"=>'Mot de passe incorrect.');	
			}
		}else{
			return array("result"=>false, "message"=>'Vous devez saisir un nom et mot de passe correct..');
		}	
	}
	
	/**
     * Enregistrement des données des l'utilisateur
     * @params  array $params contient les infos de l'utilisateur à stocker
     *      sousAction : Add ou update
     *      infos des users
     */
    
    private	function registration($params) {   
		//echo 'action : '. $action;
		$monAccessControl= new AccessControl();
		$userPassword=$monAccessControl->hashPassword( $params['userPwd']);	
		if( $params['sousAction']=="add"){
			$donnees=array('name' => $params['userName'],'password' => $userPassword, 'email'=> $params['mail'], 'Grade_IdGrade'=>2, 'Status_IdStatus'=>1);
			$newUser = new User($donnees);	
					
			$userManager= new UserManager();
			$users=$userManager->add($newUser);	
			
		}else	{
			$donnees=array('idusers'=> $_SESSION['userId'],'name' =>$params['userName'],'password' => $userPassword, 'email'=> $params['mail'],'grade_idgrade'=>$_SESSION['Grade_IdGrade'], 'status_idstatus'=>$_SESSION['Status_IdStatus']);
			
			$newUser = new User($donnees);			
			$userManager= new UserManager();
			$users=$userManager->update($newUser);	
			$this->updateSession($newUser);
		}
	}
	
    /**
     * ajoute un chapitre dans la base de données si la sousAction est <> de fermer
     * @param  array $post infos du chapitre
     * @return object chapitre
     */
    private function addOneChapter($post){
		if( $post['sousAction']!=="fermer"){
			$donnees=array('Title' => $post['title'], 'Content'=> $post['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_SESSION['userId'], 'Status_IdStatus'=>1, 'number'=>$post['number']);
			return $newChapter = new Chapter($donnees);
		}
	}
	
    /**
     * modifie un chapitre
     * @param  array $post  infos du chapitre
     * @return object chapitre
     */
    private function updateOneChapter($post){
		//echo "<pre> Controler : update :";print_r($post);echo"</pre>";
		$donnees=array('idchapters'=>$post['idchapter'], 'Title' => $post['title'], 'Content'=> $post['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_SESSION['userId'], 'Status_IdStatus'=>1, 'Number'=> $post['number']);
		return $newChapter = new Chapter($donnees);
	}
	
    /**
     * recherche les différents status d'un chapitre ou d'un utilisateur
     * @return array contenant les id et libelle des status
     */
    private function prepareAdminStatus(){
		$statusManager = new StatusManager();
		$status=$statusManager->getList();
		$datas=[];
		foreach ($status as $key => $value){
			$id=$status[$key]->getIdstatus();
			$datas[$id]=$value->getLibelle();	
		}
		//echo "<pre> Controler : prepareAdminStatus :";print_r($datas);echo"</pre>";
		return $datas;
	}
   /**
     * recherche les différents grade  d'un utilisateur
     * @return array contenant les id et libelle des grades
     */
    private function prepareAdminGrade(){
		$gradeManager = new GradeManager();
		$grade=$gradeManager->getList();
		$datas=[];
		foreach ($grade as $key => $value){
			$id=$grade[$key]->getIdgrade();
			$datas[$id]=$value->getLibelle();	
		}
		//echo "<pre> Controler : prepareAdminGrade :";print_r($datas);echo"</pre>";
		return $datas;
	}
    /**
     * pour chaque triplet (chapitre, status, numéro) modifie les chapitres
     * 
     * @param  array $params couples à modifier
     * @return boolean resultat de la mofication
     */
    private function validStatusChapters($params){	
		//echo"<PRE>CONTROLLER : validStatusChapters 1 ";print_r($params);echo"</PRE>";
		
		$chapterManager= new ChaptersManager();
		foreach($params as $key=> $value){
			if(is_numeric($value)){
				$donnees=[];
				if(is_numeric($key)){
					$donnees=array('Idchapters'=>$key,'Status_IdStatus'=>$value);
					//echo"Statuts <PRE>";print_r($donnees);echo"</PRE>";
					$newChapter = new Chapter($donnees);
					$return=$chapterManager->updateStatus($newChapter);
				}else{
					$donnees=array('Idchapters'=>preg_replace('#number#','',$key),'number'=>$value);
					//echo"NUMBER <PRE>";print_r($donnees);echo"</PRE>";
					$newChapter = new Chapter($donnees);
					$return=$chapterManager->updateNumber($newChapter);
				}
			}
		}
		$resultat["result"]=true;
		return $resultat;
	}
/**
	/**
     * pour chaque triplet (chapitre, status, numéro) modifie les chapitres
     * 
     * @param  array $params couples à modifier
     * @return boolean resultat de la modification
     */
    private function validParamUsers($params){	
		//echo"<PRE>CONTROLLER : validStatusChapters 1 ";print_r($params);echo"</PRE>";
		
		$userManager= new UserManager();
		foreach($params as $key=> $value){
			if(!is_numeric($key)){
				$donnees=[];
				//echo "clef ".$key." initiale ".substr($key,0,1);
				if(substr($key,0,1)=="S"){
					//echo "clef : ".$key." donne ".substr($key,1);
					$donnees=array('Idusers'=>substr($key,1),'Status_IdStatus'=>$value);
					//echo" <PRE>";print_r($donnees);echo"</PRE>";
					$newUser = new User($donnees);
					$return=$userManager->updateStatus($newUser);
				}else{
					//echo "clef : ".$key." donne ".substr($key,1);
					$donnees=array('Idusers'=>substr($key,1),'Grade_IdGrade'=>$value);
					//echo" <PRE>";print_r($donnees);echo"</PRE>";
					$newUser = new User($donnees);
					$return=$userManager->updateGrade($newUser);
				}
			}
		}
		$resultat["result"]=true;
		return $resultat;
	}	

	

	/**
     * Crée un mail de contact et l'envoi .
     * @param  params    contient les informations du courriel
     */
	private function senderMail($params){
		echo "<br /> View senderMail id=<PRE>";print_r($params);echo "</PRE>";
		$from="From: ".$params["name"]."\r\nReturn-path:".$params["email"];
		$subject=$params["message"];
		echo "Mail : ".$this->myConfig->getMail();
		mail($this->myConfig->getMail(), $subject, $message, $from);
		echo "Email transmis !";
	}
		
	
    /**
     * Recherche l'objet à afficher dans la barre aside
     * et charge les parametres avec
     * @objet  array    contenu à afficher par asideView
     */
    private	function chargeAside($post){
		
		$donnees=[];
		$aside=[];
		$monManager="";
		//echo"<br /><pre> charge ASIDE ";print_r($post);echo"</pre>";
		$asideParam=$this->myConfig->getAsideParam($this->myAction);

		//echo"<br /><pre> charge ASIDE PARAM ";print_r($asideParam);echo"</pre>";

		foreach($this->myRoad["appelFonctionApresData"] as $element){
			if(is_array($element)){
				if($element["nom"]=="chargeAside"){
					$monAction= $element["lesParams"]["origine"];
					$monManager = new $element["lesParams"]["nomParam"];
					$donnees=$monManager->$monAction();
					//echo"<br /><pre> charge les params ";print_r($asideParam);echo"</pre>";
					//echo"<br /><pre> présente les données ";print_r($donnees);echo"</pre>";
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
                $maClasse=new $this->myRoad["appelFonctionAvantData"]["className"];		
				if($this->myRoad["appelFonctionAvantData"]["avecParam"]=="oui"){
					if(isset($this->myRoad["appelFonctionAvantData"]["nom"])){
						$function=$this->myRoad["appelFonctionAvantData"]["nom"];
						if($this->myRoad["appelFonctionAvantData"]["origine"]=="params"){
							$return=$maClasse->$function($params);
						}else{
							//echo"<PRE><br />CONTROLLER 1.31: dat ";print_r($this->myRoad["appelFonctionAvantData"]);echo"</PRE>";
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
					$maClasse=new $element["className"];
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
		$monAction=isset($this->myRoad["wantHeaderLocation"]["action"]) ? $this->myRoad["wantHeaderLocation"]["action"] : NULL;
		//echo '<br />header = '.$this->myRoad["wantHeaderLocation"]["target"];
		if($monAction=="oui"){
			if( $this->myRoad["wantHeaderLocation"]["action"]=="oui"){
				if($this->myRoad["wantHeaderLocation"]["origine"]=="post"){
					$critere=$this->myRoad["wantHeaderLocation"]["nom"].'/'.$post[$this->myRoad["wantHeaderLocation"]["nom"]];
				}else{
					$critere=$params[$this->myRoad["wantHeaderLocation"]["nom"]];
				}
			}else{
				$critere="";
			}
			echo"<PRE> controle déclenchement vue 13: data ";print_r($critere);echo"</PRE>";
			//echo '<br />header = '.$this->myRoad["wantHeaderLocation"]["target"].$critere;
			header('Location: '.$this->myRoad["wantHeaderLocation"]["target"].$critere);
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