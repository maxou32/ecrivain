<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\StatusManager;
use web_max\ecrivain\view\_AdminChaptersView;
use web_max\ecrivain\model\MessageManager;
use web_max\ecrivain\view\_messageView;
use web_max\ecrivain\view\_ListChaptersView;
use web_max\ecrivain\view\_TheBookView;
use web_max\ecrivain\view\_readOneChapterView;
use web_max\ecrivain\view\_updateOneChapterView;
use web_max\ecrivain\model\Chapter;
use web_max\ecrivain\view\_createOneChapterView;
use web_max\ecrivain\model\UserManager;
use web_max\ecrivain\view\_FieldsUserView;
use web_max\ecrivain\model\User;
use web_max\ecrivain\model\TypeMessageManager;
use web_max\ecrivain\model\Message;
use web_max\ecrivain\view\_CRUDMessage;
use web_max\ecrivain\view\_askReservedAccess;

class Controller{
	private $myRoad;
	private $myConfig;
	public function __construct($myRoad){
		$this->myRoad=$myRoad;
		$this->myConfig= new Config;
		//echo"<PRE> COntroller : construct ";print_r($myRoad);echo"</PRE>";
	}
	
	private function updateSession(User $user){
		$_SESSION['user']=$user->getName();
		$_SESSION['userId']=$user->getIdusers();
		$_SESSION['userPwd']=$user->getPassword();
		$_SESSION['autorizedAccess']=$user->getGrade_IdGrade();
		$_SESSION['email']=$user->getEmail();
		$_SESSION['Grade_IdGrade']=$user->getGrade_IdGrade();
		$_SESSION['Status_IdStatus']=$user->getStatus_IdStatus();
	}	
	
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
			//throw new Exception ('Vous devez saisir un nom et mot de passe correct.');
		}	
	}
	
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
		//header('Location: index.php');
	}
	
	private function addOneChapter($post){
		if( $post['sousAction']!=="fermer"){
			$donnees=array('Title' => $post['title'], 'Content'=> $post['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_SESSION['userId'], 'Status_IdStatus'=>1, 'number'=>$post['number']);
			return $newChapter = new Chapter($donnees);
		}
	}
	
	private function updateOneChapter($post){
		//echo "<pre> Controler : update :";print_r($post);echo"</pre>";
		$donnees=array('idchapters'=>$post['idchapters'], 'Title' => $post['title'], 'Content'=> $post['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_SESSION['userId'], 'Status_IdStatus'=>1, 'Number'=> $post['number']);
		return $newChapter = new Chapter($donnees);
	}
	
	private function prepareAdminChapter(){
		$statusManager = new StatusManager();
		$status=$statusManager->getList();
		$datas=[];
		foreach ($status as $key => $value){
			$id=$status[$key]->getIdstatus();
			$datas[$id]=$value->getLibelle();	
		}
		return $datas;
	}

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
		$resultat["followAction"]="noCRUD";
		$resultat["result"]=true;
		return $resultat;
	}
	
	private function prepareMessage($params){
		echo"CONTROLLEUR : 0 prepareMessage<br /> <PRE>";print_r($params);echo"</PRE>";
		$monTypeMessageManager= new TypeMessageManager;
		$monTypemessage=$monTypeMessageManager->get($params['sousAction']);
		$monMessageManager= new MessageManager;
		$messages=$monMessageManager->getListByType($monTypemessage->getIdtypemessage());
		//echo"CONTROLLEUR : 0.5 prepareMessage<br /> <PRE>";print_r($messages);echo"</PRE>";
		return $messages;
	}
	
	private function prepareTypeMessage(){
		//echo"<br />CONTROLLEUR: prepareTypeMEssage";
		$monMessage= new MessageManager;
		$donnees=$monMessage->get("askCRUDMessage");	
		$array["message"]=$donnees->getTexte();
		//echo"<br />CONTROLLEUR : 0 prepareTypeMessage<br /> <PRE>";print_r($array);echo"</PRE>";
		return $array["message"];
	}

	private	function CRUDMessage($params){
		$monMessage= new MessageManager;
		//echo "<br /> View CRUDMessage id=<PRE>";print_r($params);echo "</PRE>";
		switch ($params['sousAction']){
			case "Mettre à jour":
				$donnees=array('id'=> $params['id'],'texte' =>$params['texte'],'contexte' => $params['contexte']);
				$newMessage = new Message($donnees);	
				$messageManager= new MessageManager();
				$message=$messageManager->update($newMessage);		
				break;
			case "Supprimer":
				$messageManager= new MessageManager();
				//echo '<br /> id à détruire = '. $params['id'].'<br />';
				$messageManager->delete($params['id']); 
				break;
			case "Ajouter":
				$donnees=array('texte' => $params['texte'],'contexte' => $params['contexte'], 'message_idtypemessage'=> $params['idtypemessage']);
				$newMessage = new Message($donnees);	
				$messageManager= new MessageManager();
				$message=$messageManager->add($newMessage);	
				break;
		}
		$monTypeMessageManager= new TypeMessageManager;
		$monTypemessage=$monTypeMessageManager->getFromId($params['idtypemessage']);
		$libErreur=$monTypemessage->getText();
		header('Location: index.php?askCRUDMessage/sousAction/'.$libErreur);
	}
	
	public function prepareAction($params, $post){
		$param=[];
		$data= [];
		$globalParams=[];
		$return=[];
		
		//echo"<PRE><br />CONTROLLER 1: dat ";print_r($post);echo"</PRE>";
		//echo"<PRE><br>CONTROLLER 1.1: nbPram = ";print_r($params);echo"</PRE>"."<br />";
		
		if($this->myRoad["security"]["niveauRequis"]>0){
			$monAccessControl=new $this->myRoad["security"]["className"];
			$CRUDAutorized=$monAccessControl->verifAccessRight($this->myRoad["security"]["niveauRequis"]);
			if($CRUDAutorized){
				$globalParams=array(
					$this->myRoad["security"]["nom"]=>true
				);
				//echo"<br>CONTROLLER 1.2 : dat ";print_r($globalParams);echo"</PRE>";
			
			}else{
				//echo "erreur à traiter niveau insuffisant";
			}
		}
		if(null!==($this->myRoad["appelFonctionAvantData"]["nombrefonction"])){
			//echo "<br /><pre>CONTROLLER 1.30 maxou: element = ";print_r($this->myRoad["appelFonctionAvantData"]);echo"</pre>";
			//foreach($this->myRoad["appelFonctionAvantData"] as $element){
				$return=[];
				if(!empty($this->myRoad["appelFonctionAvantData"]["className"])){
					$maClasse=new $this->myRoad["appelFonctionAvantData"]["className"];					
					if(isset($this->myRoad["appelFonctionAvantData"]["nom"])){
						$function=$this->myRoad["appelFonctionAvantData"]["nom"];
						if($this->myRoad["appelFonctionAvantData"]["avecParam"]="oui"){
							$return=$maClasse->$function($post);
						}else{
							//echo"<PRE><br />CONTROLLER 1.31: dat ";print_r($this->myRoad["appelFonctionAvantData"]);echo"</PRE>";
							$return=$maClasse->$function();
						}						
					}
					//echo "<br />CONTROLLER 1.5: Return valide access = ";print_r($return);echo"</pre>";
				}else{
					//	//echo "<br /><pre>CONTROLLER 1.32: element = ";print_r($this->myRoad["appelFonctionAvantData"]);echo"</pre>";
					if($this->myRoad["appelFonctionAvantData"]["avecParam"]=="oui"){
						if(isset($this->myRoad["appelFonctionAvantData"]["nom"])) {
							$fonction=$this->myRoad["appelFonctionAvantData"]["nom"];
							if ($this->myRoad["appelFonctionAvantData"]["origine"]=="params"){
								//echo "<br /><pre>CONTROLLER 1.41: element = ";print_r($this->myRoad["appelFonctionAvantData"]);echo"</pre>";
								$return= $this->$fonction($params);
							}else{
								//echo "<br /><pre>CONTROLLER 1.42: element = ";print_r($post);echo"</pre>";
								$return= $this->$fonction($post);
							}
						}
					}else{
						isset($this->myRoad["appelFonctionAvantData"]["nom"]) ? $return= $this->$element["nom"]($post) :false;
					}
					//echo "<br /><pre>CONTROLLER 1.5: Return valide access = ";print_r($return);echo"</pre>";
				}
			//}
		}
			
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
		
		if(isset($this->myRoad["params"])){
			foreach($this->myRoad["params"] as $key => $element){
				//echo"<PRE> controller params 1: dat ";print_r($element);echo"</PRE>";
				if($element!==Null){
					$globalParams[$key]= $this->myConfig->$element();	
					//echo"<PRE> controller params 6: dat ";print_r($globalParams);echo"</PRE>";
				}
			}
		}
		if(null!==($this->myRoad["appelFonctionAPresData"]["nombrefonction"])){
			//echo "<br />CONTROLLER params generique 8.2 <PRE>";print_r($this->myRoad["appelFonctionAPresData"]);echo "</PRE>";
			foreach($this->myRoad["appelFonctionAPresData"] as $element){
				$return=[];
				if(!empty($element["className"])){
					$maClasse=new $element["className"];
					//echo"<PRE><br />CONTROLLER 8.3: dat ";print_r($this->myRoad["appelFonctionAPresData"]);echo"</PRE>";
					
					isset($element["nom"]) ? $return=$maClasse->$element["nom"]($post) :false;
					//echo "<br />CONTROLLER 8.5: Return valide access = ";print_r($return);echo"</pre>";
				}else{
					//echo"<PRE><br />CONTROLLER 8.3: dat ";print_r($element["nom"]);echo"</PRE>";
					isset($element["nom"]) ? $return= $this->$element["nom"]($post) :false;
					
					//echo "<br /><pre>CONTROLLER 8.5: Return valide access = ";print_r($return);echo"</pre>";
				}
				$nomParam=$element["lesParams"]["nomParam"];
				//echo "<br />CONTROLLER 8.5: Return valide access = ";print_r($nomParam);echo"</pre>";
				
			}
			if(isset($this->myRoad["appelFonctionAPresData"][0]["nomTableau"])){
				$globalParams[$this->myRoad["appelFonctionAPresData"][0]["nomTableau"]]=$return;
				//echo "<br /><pre>CONTROLLER 8.55: nomTableau= ";print_r($globalParams);echo"</pre>";	
			}
			
		}

		
		if(isset($this->myRoad["view"])){
			foreach($this->myRoad["view"] as $element){
				//echo " <br />déclenchement vue";
				if($element["nom"]!==Null){
					//echo"<PRE> controle déclenchement vue 9: data ";print_r($element);echo"</PRE>";
					if($element["nombreParam"]>0){
						foreach ($element["lesParams"] as $elementParam){
							if($elementParam["origine"]!=="dur"){
								$action="get".$elementParam["nomParam"];
								$globalParams[$elementParam["nomParam"]]=$this->myConfig->$action();
							}else{
								$globalParams[$elementParam["nomParam"]]=$elementParam["value"];
								//echo"<PRE> controle déclenchement vue 9.5: data ";print_r($globalParams);echo"</PRE>";
					
							}
						}
					}
					//echo"<PRE> controle déclenchement vue 10: globalParams ";print_r($globalParams);echo"</PRE>";
					//echo"<PRE> controle déclenchement vue 10: data ";print_r($data);echo"</PRE>";
					//echo"<PRE> controle déclenchement vue 11: globalParams ";print_r($element["nom"]);echo"</PRE>";
					$monMessageView = new $element["nom"]('template.php');  
					$monMessageView->show($globalParams,$data);
				}else{
					//echo " controle déclenchement vue 12 : vue inconnue";
				} 
			}
		}
		
		$monAction=isset($this->myRoad["wantHeaderLocation"]["action"]) ? $this->myRoad["wantHeaderLocation"]["action"] : NULL;
		//echo '<br />header = '.$this->myRoad["wantHeaderLocation"]["target"];
		if($monAction=="oui"){
			if( $this->myRoad["wantHeaderLocation"]["param"]=="oui"){
				if($this->myRoad["wantHeaderLocation"]["origine"]="post"){
					$critere=$this->myRoad["wantHeaderLocation"]["nom"].'/'.$post[$this->myRoad["wantHeaderLocation"]["nom"]];
				}
			}else{
				$critere="";
			}
			//echo '<br />header = '.$this->myRoad["wantHeaderLocation"]["target"].$critere;
			header('Location: '.$this->myRoad["wantHeaderLocation"]["target"].$critere);
		}
	}

	
	function _BienvenueView(){
		/*
		$monMessage= new MessageManager;
		$donnees=$monMessage->get("_MessageView");	
		//echo "<br /> View readOneChapter id=<PRE>";print_r($donnees->getTexte());echo "</PRE>";
		$array["message"]=$donnees->getTexte();
		$monMessageView = new _messageView('template.php');
		$monMessageView->show($array,NULL);	
		*/
	}
	
	/*
		$array["message"]=$donnees->getTexte();
		$monMessageView = new _alertView();
		$monMessageView->show($array);		
	
	
	function askCRUDMessage($params){
		$monTypeMessageManager= new TypeMessageManager;
		//préparation de la litse déroulante
		/* ---------------------------------

			$typeMessage=$monTypeMessageManager->getList();
			$datas=[];
			foreach ($typeMessage as $key => $value){
				//echo "clef : ".$typeMessage[$key]->getIdtypemessage();
				$id=$typeMessage[$key]->getIdtypemessage();
				$datas[$id]=$value->getText();	
			}
			
			$array["listName"]="MessageType";
			$array["listId"]="MessageType";	
			$array["listCaption"]="Type de message";	
			$monMessageView = new _listView('template.php');
			$listView=$monMessageView->show($array,$datas);
			$array["MessageTypeList"]=$listView;
		//---------------------------------- 
		$monMessage= new MessageManager;
		$donnees=$monMessage->get("askCRUDMessage");	
		$array["message"]=$donnees->getTexte();
		
		$monTypemessage=$monTypeMessageManager->get($params['sousAction']);
		$monMessageManager= new MessageManager;
		$messages=$monMessageManager->getListByType($monTypemessage->getIdtypemessage());
		
		$monMessageView = new _CRUDMessage('template.php');
		$monMessageView->show($array,$messages);
	}
	*/
	function OLD_CRUDMessage($params){
		$monMessage= new MessageManager;
		//echo "<br /> View CRUDMessage id=<PRE>";print_r($params);echo "</PRE>";
		switch ($params['sousAction']){
			case "Mettre à jour":
				$donnees=array('id'=> $params['id'],'texte' =>$params['texte'],'contexte' => $params['contexte']);
				$newMessage = new Message($donnees);	
				$messageManager= new MessageManager();
				$message=$messageManager->update($newMessage);		
				break;
			case "Supprimer":
				$messageManager= new MessageManager();
				//echo '<br /> id à détruire = '. $params['id'].'<br />';
				$messageManager->delete($params['id']); 
				break;
			case "Ajouter":
				$donnees=array('texte' => $params['texte'],'contexte' => $params['contexte'], 'message_idtypemessage'=> $params['idtypemessage']);
				$newMessage = new Message($donnees);	
				$messageManager= new MessageManager();
				$message=$messageManager->add($newMessage);	
				break;
		}
		$monTypeMessageManager= new TypeMessageManager;
		$monTypemessage=$monTypeMessageManager->getFromId($params['idtypemessage']);
		$libErreur=$monTypemessage->getText();
		header('Location: index.php?action=askCRUDMessage&sousAction='.$libErreur);
	}
/*	
	function askRegistration(){
		//$maView = new _askRegistration('template.php');
		//$maView->show(NULL,NULL);
	
		$array["userName"]="";	
		$array["email"]="";
		$array["action"]="add";
		$monFieldsUserView = new _FieldsUserView(false);
		$monFieldsUserView->show($array, NULL);
	}
*/	

	
	/*
	function _ListChaptersView(){
		$monConfig= new Config();
		
		$chapterManager = new ChaptersManager();
		$chapters=$chapterManager->getListValid();
		$monConfig=new Config;
		$nbCaracters=$monConfig->getNbCaracters();
		$params=array(
			'nbCaracters'=>$nbCaracters
		);
		$maView = new _ListChaptersView('template.php');
		$maView->show($params,$chapters);
	}

	function _TheBookView($params){
		$chapterManager= new ChaptersManager();
		$chapter=$chapterManager->get($params["chap"]); //$params['Idchapters']
		$params=array(
			'nbChapter'=>5
		);
		$maView = new _TheBookView('template.php');
		$maView->show($params,$chapter);
		//echo "fin the book";
	}
	
	function adminChapter(){
		
		$chapterManager = new ChaptersManager();
		$chapters=$chapterManager->getListALL();
		$monConfig=new Config;
		
		
		$statusManager = new StatusManager();
		$status=$statusManager->getList();
		$datas=[];
		foreach ($status as $key => $value){
			$id=$status[$key]->getIdstatus();
			$datas[$id]=$value->getLibelle();	
		}
		$nbCaracters=$monConfig->getNbCaracters();
		$params=array(
			'nbCaracters'=>$nbCaracters,
			'status'=>$datas
		);
		//echo"<PRE>";print_r($params);echo"</PRE>";

		$maView = new _AdminChaptersView('template.php');
		$maView->show($params,$chapters);
	}
	*/	
	function _validStatusChapters($params){	
		//echo"<PRE>";print_r($params);echo"</PRE>";
		
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
	//	header('Location: index.php');
	}
	
	
/*
	function readOneChapter($params){		
		 $chapterManager= new ChaptersManager();
		 $chapter=$chapterManager->get($params['Idchapters']); 
			$function='updateOneChapter';
			$monAccessControl=new accessControl;
			$updateDeleteAreAutorized=$monAccessControl->verifAccessRight($monAccessControl->getIsProtected($function));
		$params=array(
			'updateDeleteAreAutorized'=>$updateDeleteAreAutorized
		);
		$maView = new _readOneChapterView('template.php');
		$maView->show($params,$chapter);
		
	}
		
	function _askReservedAccess(){
		$maView = new _askReservedAccess('template.php');
		$maView->show(NULL,NULL);
	}

	function abortAccess(){
		$monControlAcces= new AccessControl();
		$monControlAcces->Disconnect();
		header('Location: index.php');
	}
	*/
	function askUpdateProfil(){
		$monUserManager= new UserManager();
		$monUserManager->get($_SESSION['user']);
		$array["userName"]=$_SESSION['user'];
		
		$array["email"]=$_SESSION['email'];
		$array["action"]="update";
		$monFieldsUserView = new _FieldsUserView(false);
		$monFieldsUserView->show($array, NULL);
	}
/*	
	function askAddOneChapter(){
		//echo" debut askAddOneChapter  ";
			
		$maView = new _createOneChapterView('template.php');
		$maView->show(NULL, NULL);
		
		
	}

	function addOneChapter($params){
		if( $params['sousAction']!=="fermer"){
			$donnees=array('Title' => $params['title'], 'Content'=> $params['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_SESSION['userId'], 'Status_IdStatus'=>1, 'number'=>$params['number']);
			$newChapter = new Chapter($donnees);
			$chapterManager= new ChaptersManager();
			$chapters=$chapterManager->add($newChapter); 
		}
		header('Location:index.php?action=_listChaptersView');	

	}
*/		
	function DeleteOneChapter($params){
		if ($params['sousAction']=='Mettre à jour'){
			
			//$monController= new Controller;
			//$monController->_updateOneChapterView($chapter);
			$chapterManager= new ChaptersManager();
			$chapter=$chapterManager->get($params['Idchapters']); 
			
			$params=array(
				'action'=>'update',		
				'neededAccessRight'=>99,
				'verifAccess'=>true
			);
			$maView = new _updateOneChapterView('template.php');
			$maView->show($params,$chapter);
		}
		header('Location:index.php?action=_listChaptersView');
	}
 
	function EnCoursUpdateOneChapter($params){
		//echo"<PRE> debut updateOneChapter  ";print_r($params);echo"</PRE>";
		$donnees=array('idchapters'=>$params['Idchapters'], 'Title' => $params['title'], 'Content'=> $params['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_SESSION['userId'], 'Status_IdStatus'=>1, 'Number'=> $params['number']);
		$newChapter = new Chapter($donnees);
		
		$chapterManager= new ChaptersManager();
		$chapters=$chapterManager->update($newChapter); 

		header('Location:index.php?action=oneChapter&Idchapters='.$params['Idchapters']);	
	}
	

	
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