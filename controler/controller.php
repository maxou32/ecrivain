<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\model\ChaptersManager;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\StatusManager;
use web_max\ecrivain\view\_AdminChaptersView;
use web_max\ecrivain\model\MessageManager;
use web_max\ecrivain\view\_messageView;
use web_max\ecrivain\view\_ListChaptersView;
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
	
	public function __construct(){
		
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
	
	function _BienvenueView(){
		$monMessage= new MessageManager;
		$donnees=$monMessage->get("_MessageView");	
		//echo "<br /> View readOneChapter id=<PRE>";print_r($donnees->getTexte());echo "</PRE>";
		$array["message"]=$donnees->getTexte();
		$monMessageView = new _messageView('template.php');
		$monMessageView->show($array,NULL);		
	}
	
	
	/*
		$array["message"]=$donnees->getTexte();
		$monMessageView = new _alertView();
		$monMessageView->show($array);		
	*/
	
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
		//---------------------------------- */
		$monMessage= new MessageManager;
		$donnees=$monMessage->get("askCRUDMessage");	
		$array["message"]=$donnees->getTexte();
		
		$monTypemessage=$monTypeMessageManager->get($params['sousAction']);
		$monMessageManager= new MessageManager;
		$messages=$monMessageManager->getListByType($monTypemessage->getIdtypemessage());
		$monMessageView = new _CRUDMessage('template.php');
		$monMessageView->show($array,$messages);
	}
	
	function CRUDMessage($params){
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
	function askRegistration(){
		//$maView = new _askRegistration('template.php');
		//$maView->show(NULL,NULL);
	
		$array["userName"]="";	
		$array["email"]="";
		$array["action"]="add";
		$monFieldsUserView = new _FieldsUserView(false);
		$monFieldsUserView->show($array, NULL);
	}
	
	function registration($params) {   
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
		header('Location: index.php');
	}
	
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
	
	function _validStatusChapters($params){	
		foreach($params as $key=> $value){
			if($value>0){
				$donnees=[];
				$donnees=array('Idchapters'=>$key,'Status_IdStatus'=>$value);
				
				$newChapter = new Chapter($donnees);
				
				$chapterManager= new ChaptersManager();
				$return=$chapterManager->updateStatus($newChapter); 
			}
		}
		header('Location: index.php');
	}
	
	

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
	
	function validAccessReserved($params){
		//echo"<PRE> debut validAccessReserved";print_r($params);echo"</PRE>";
			
		if(isset($params['userName']) && isset($params['userPwd'])) {
			//echo "<br /> name : ".$params['userName']." pwd ".$params['userPwd'];
			$monUserManager=new UserManager;
			
			$user=$monUserManager->get($params['userName']);
			if(!$user){
				throw new Exception ('Vous n\'êtes pas habilité à administrer ce roman.');			
			}elseif(hash('sha256',$params['userPwd'])==$user->getPassword()){
				//echo "ça marche";
				$this->updateSession($user);
				header('Location: index.php');
				return array("result"=>true);
			}else{
				return array("result"=>false, "message"=>'Mot de passe incorrect.');	
			}
		}else{
			throw new Exception ('Vous devez saisir un nom et mot de passe correct.');
		}
		
		
	}
	function abortAccess(){
		$monControlAcces= new AccessControl();
		$monControlAcces->Disconnect();
		header('Location: index.php');
	}
	
	function askUpdateProfil(){
		$monUserManager= new UserManager();
		$monUserManager->get($_SESSION['user']);
		$array["userName"]=$_SESSION['user'];
		
		$array["email"]=$_SESSION['email'];
		$array["action"]="update";
		$monFieldsUserView = new _FieldsUserView(false);
		$monFieldsUserView->show($array, NULL);
	}
	
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
	
	function updateDeleteOneChapter($params){
		if ($params['sousAction']=='Supprimer'){
			//echo"<PRE> debut updateDeleteOneChapter  ";print_r($params);echo"</PRE>";
			
			$chapterManager= new ChaptersManager();
			//echo '<br /> id à détruire = '. $params['Idchapters'].'<br />';
			$chapterManager->delete($params['Idchapters']); 
			
			$captionMessage ="Chapitre bien supprimé.";
			$message="suppression du chapitre confirmée";
			
			
		}elseif ($params['sousAction']=='Mettre à jour'){
			
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
 
	function UpdateOneChapter($params){
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