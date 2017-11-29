<?php
	//namespace web_max\ecrivain;
?>	
<!-- controler pour actions User connecté
call of classes 
		Chapters
		Comments
		Users
		
addOneChapter 	(title, resume, content)						//Ajout UN chapitre
		//verification user =admin
		instance classe chapitre
		ajout UN chapitre (title, resume, content, now())
		retour monChapitre
		appel oneChapterView (monChapitre)
		appel vue information et message résultat

updateOneChapter (title, resume, content)						//Modification UN chapitre
		//verification user =admin
		instance classe chapitre
		modification UN chapitre(title, resume, content, now())
		retour monChapitre
		appel vue oneChapterView (monChapitre)
		appel vue information et message résultat

deleteOneChapter (id)						//Modification UN chapitre
		//verification user =admin
		instance classe chapitre
		suppression UN chapitre(id)
		retour resultat
		appel vue oneChapterView (null)
		appel vue information et message résultat
		
validateComment(id) 						//Validation Un Commentaire
		//verification user =admin
		instance classe commentaire
		modification UN commentaire(id)
		appel vue information et message résultat


addComment(chapter.id, id, comment.content)	//Ajout commentaire
		//verification user connecté
		instance classe commentaires
		ajout UN commentaire(chapter.id, id, comment.content)
		retour monCommentaire
		appel vue UN chapitre (chapter.id)
		appel vue information et message résultat
		
updateComment(chapter.id, id, comment.content)	//Modification Un commentaire
		//verification user = auteur
		instance classe commentaires
		modif le commentaire(chapter.id, id, comment.content)
		retour LE commentaire
		appel vue UN chapitre
		appel vue information et message résultat

deleteComment(id)							//Suppression UN commentaire
		//verification user = auteur
		instance classe commentaires
		delete le commentaire (id)
		appel vue information et message résultat
		
validateuser(id)							//Validation compte Un utilisateur 
		//verification user = admin
		instance classe utilisateur
		modif  l'Utilisateur (id, validation)
		appel vue information et message résultat
		
deleteUser(id)								//Annulation compte Un utilisateur
		//verification user = admin
		instance classe utilisateur
		modif  l'Utilisateur (id, annulation)
		appel vue information et message résultat
		
updateUser (id, name, email)				//Modification compte Un utilisateur
		//verification user = utilisateur
		instance classe utilisateur
		modif  l'Utilisateur (id, update, name, email)
		appel vue information et message résultat
		
errorProcessing(error)						//traitement des erreurs
		appel vue information et message résultat (error)
-->
<?php	

class PrivateFrontEnd{
	public function __construct(){
			
	}
	function abortAccess(){
		// On le vide intégralement
		$_SESSION = array();
		// Destruction de la session
		session_destroy();
		// Destruction du tableau de session
		unset($_SESSION);
		
		$monControlerMenu= MenuControler::getInstance();
		$menuView=$monControlerMenu->sendMenu();
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_asideView.php');
		//require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuView.php');	
		$chapterManager= new ChaptersManager();
		$chapters=$chapterManager->getList();
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\listChaptersView.php');	
		
	}
	function askAddOneChapter(){

		$monControlerMenu= MenuControler::getInstance();
		$menuView=$monControlerMenu->sendMenu();
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_asideView.php');
		//require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuView.php');

		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_addChapterView.php');
	
	}
	function addOneChapter(){

		//$chapterManager=new  web_max\ecrivain\model\ChaptersManager();
		
		$donnees=array('Title' => $_POST['title'],'Resume' => $_POST['resume'], 'Content'=> $_POST['content'], 'date_fr'=>'', 'Users_IdUsers'=>1, 'Status_IdStatus'=>1);
		$newChapter = new Chapter($donnees);
		
		$chapterManager= new ChaptersManager();
		$chapters=$chapterManager->add($newChapter); 
		
		$monControlerMenu= MenuControler::getInstance();
		$menuView=$monControlerMenu->sendMenu();
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_asideView.php');
		//require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuView.php');
		$chapters=$chapterManager->getList(); 
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\listChaptersView.php');
	
	}
	function deleteChapter($idChapter){

		//$chapterManager=new  web_max\ecrivain\model\ChaptersManager();
		$chapterManager= new ChaptersManager();
		$chapterManager->delete($idChapter); 
		
		$captionMessage ="Chapitre bien supprimé.";
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
		$this->listChapter();
	}

	function askUpdateChapter($idChapter){
		$monFreeFrontEnd= new FreeFrontEnd;
		$monFreeFrontEnd->oneChapter($idChapter);
		//$chapterManager=new  web_max\ecrivain\model\ChaptersManager();
		$captionMessage ="";
		$menuView="";
		$asideView="";
		$chapterManager= new ChaptersManager();
		$chapter=$chapterManager->get($idChapter); 
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_updateChapterView.php');
	}
	
	function updateChapter($Idchapters){
		
		$donnees=array('idchapters'=>$_GET['Idchapters'], 'Title' => $_POST['title'],'Resume' => $_POST['resume'], 'Content'=> $_POST['content'], 'date_fr'=>'', 'Users_IdUsers'=>$_POST['author'], 'Status_IdStatus'=>1);
		$newChapter = new Chapter($donnees);

		$chapterManager= new ChaptersManager();
		$chapters=$chapterManager->update($newChapter); 

		$monFreeFrontEnd= new FreeFrontEnd;
		$monFreeFrontEnd->oneChapter($_GET['Idchapters']);
		//$chapterManager=new  web_max\ecrivain\model\ChaptersManager();
		$captionMessage ="";
		$message="";
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
	}	
	
}