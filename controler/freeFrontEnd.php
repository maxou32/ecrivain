<?php
	//namespace web_max\ecrivain;
	//session_start();
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
	
	//require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\ChaptersManager.php');
	//require_once ('model/Comments.php');
	//require_once ('model/UsersManager.php');
	
class FreeFrontEnd{
	
	public function __construct(){
		
	}
	
	public  function  hello(){
		//require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuView.php');
		$monControlerMenu= MenuControler::getInstance();
		$menuView=$monControlerMenu->sendMenu();
		
		$captionMessage ="";
		$message="";
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
		$contentView="";
		$asideView="";
		require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php');
	
	}
	

	function listChapter(){

		//$chapterManager=new  web_max\ecrivain\model\ChaptersManager();
		$chapterManager= new ChaptersManager();
		$chapters=$chapterManager->getList(); 
		
		$monControlerMenu= MenuControler::getInstance();
		$menuView=$monControlerMenu->sendMenu();
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_asideView.php');
		//require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuView.php');
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\listChaptersView.php');
	
	}
	function oneChapter($idChapter){

		//$chapterManager=new  web_max\ecrivain\model\ChaptersManager();
		$chapterManager= new ChaptersManager();
		$chapter=$chapterManager->get($idChapter); 

		$monControlerMenu= MenuControler::getInstance();
		$menuView=$monControlerMenu->sendMenu();
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_asideView.php');
		
		$monAccessControl= new AccessControl();
		if ($monAccessControl->verifAccessRight(99)){
			$styleBtn="<div style='display:block;'>";
		}else{
			$styleBtn="<div style='display:none;'>";
		}
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\oneChapterView.php');
	
	}
		
	function askReservedAccess(){
		$monControlerMenu= MenuControler::getInstance();
		$menuView=$monControlerMenu->sendMenu();
		//require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuView.php');
		$asideView="";
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_reservedAccess.php');
		
	}
	function validAccessReserved(){

		$_SESSION['user']=$_POST['userName'];
	
		$monControlerMenu= MenuControler::getInstance();
		$menuView=$monControlerMenu->sendMenu();
		$asideView="";
		
		//$chapterManager=new  web_max\ecrivain\model\ChaptersManager();
		$chapterManager= new ChaptersManager();
		$chapters=$chapterManager->getList();
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\listChaptersView.php');		
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