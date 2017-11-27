<?php
	//namespace web_max\ecrivain;
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
-->

<?php	
	
	require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\ChaptersManager.php');
	//require_once ('model/Comments.php');
	//require_once ('model/UsersManager.php');
	
class FreeFrontEnd{


	public function __construct(){
		
	}
	
	public  function  hello(){
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuView.php');
		$captionError ="";
		$error="";
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
		$contentView="";
		require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php');
	
	}
	

	function listChapter(){

		$chapterManager=new ChaptersManager();
		$chapters=$chapterManager->getList();
		
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuView.php');
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\listChaptersView.php');

	}
	
	function printError($error){
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuView.php');
		if (!isset($error)) {
			echo 'error undefined';
			$captionError ="";
			$error="";
		}else{
			$captionError ="message d'erreur	: ";
		}
		
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
		$contentView="";
		require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php');
				
	}
}