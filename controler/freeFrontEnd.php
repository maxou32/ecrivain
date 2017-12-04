<?php
	namespace web_max\ecrivain;
?>	
<!-- controler for free actions

call of classes 
		Chapters
		Comments
		Users

listChapters 										//liste des chapitres
		instance classe chapters
		retour liste des titres de chapitres + résumés
		appel vue listChaptersView	
		
showOneChapter 										//presentation UN chapitre et ses commentaires
		instance classe chapitres
		instance classe commentaires
		retour UN résumé(id)
		retour DES commentaires(chapter.id)
		appel vue oneChapterView
		
addUser (name, email)							//creation compte utilisateur)
		instance classe utilisateur
		addUser (name, email,now(), none)	
		appel userView information et message résultat
		
addOneChapter 	(title, resume, content)						//Ajout UN chapitre
		//verification user =admin
		instance classe chapitre
		ajout UN chapitre (title, resume, content, now())
		retour monChapitre
		appel oneChapterView (monChapitre)
		appel vue information et message résultat
-->

<?php	
	
	
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\MenuControler.php');
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\UserManager.php');
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\controler\AccessControl.php');
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_askRegistration.php');
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\ListChaptersView.php');
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\OneChapterView.php');
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_reservedAccess.php');
	
	
	
class FreeFrontEnd{
	
	public function __construct(){
		
	}
	
	public  function  hello(){
		$maView = new View(false);
		$maView->show(NULL,NULL);
		//$maView->render(NULL);
	}
	
	function askRegistration(){
		$maView = new AskRegistration(false);
		$maView->show(NULL,NULL);
		//$maView->render(NULL);
	}
	
	function registration($userName, $userPassword, $email){
		$monAccessControl= new AccessControl();
		$userPassword=$monAccessControl->hashPassword($userPassword);	
	
		$donnees=array('name' => $userName,'password' => $userPassword, 'email'=> $email, 'Grade_IdGrade'=>2, 'Status_IdStatus'=>1);
		$newUser = new User($donnees);	
				
		$userManager= new UserManager();
		$users=$userManager->add($newUser);	
		
		$maView = new View('template.php');
		$maView->show();
		//$maView->render(NULL,NULL);
	}
	
	function listChapter(){
		$chapterManager = new ChaptersManager();
		$chapters=$chapterManager->getList(); 
		$maView = new ListChaptersView(false);
		$maView->show(NULL,$chapters);
	}
	
	function oneChapter($idChapter){

		$chapterManager= new ChaptersManager();
		$chapter=$chapterManager->get($idChapter); 

		$params=array(
			'neededAccessRight'=>99,
			'verifAccess'=>true,
		);
		
		$maView = new OneChaptersView(true);
		$maView->show($params,$chapter);
		
	}
		
	function askReservedAccess(){
		$maView = new ReservedAccess(false);
		$maView->show(NULL,NULL);
	}
	
	function validAccessReserved(){

		$_SESSION['user']=$_POST['userName'];
		$chapterManager = new ChaptersManager();
		$chapters=$chapterManager->getList(); 
		$maView = new ListChaptersView(false);
		$maView->show(NULL,$chapters);		
	}
	function printError($error){
		$menuView="";
		$monControlerMenu= MenuControler::getInstance();
		$monControlerMenu->sendMenu();
		$asideView ="";
		$message="";
		if (!isset($error)) {
			$captionMessage ="error undefined";	
		}else{
			$captionMessage ="message d'erreur	: ";
		}
		
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
		$contentView="";
		require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php');
				
	}
	
}