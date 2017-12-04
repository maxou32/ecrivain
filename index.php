<?php
	namespace web_max\ecrivain;
	session_start();
	//use web_max\ecrivain;
?>

<!-- general router
call controler
require privateFrontEnd
require freeFrontEnd

capsule try
	
	si existence contenu action est vraie
		--  free router  --
		
		si action = listChapter  
			appel freeFrontEnd
		sinon Si action = showOneChapter
			si id existe et >0 
				appel showOneChapter(id)
			sinon
				déclenchement erreur "chapitre inconnu"
		sinon si action = addUser
			si nomUser n'est pas vide et emailUser non plus
				appel addUser(nomUser, emailUser)
			sinon
				déclenchement erreur "nom et email obligatoires"
			finsi
		finsi

	--  private router  --
		si userConnected non vide 
			choix action
				addOneChapter :
					si userConnected.status = Admin 
						si chapter.content non vide et chapter.resume et chapter.resume non vide
							appel addOneChapter (title, resume, content)
						sinon
							déclenchement erreur "informations manquantes"
						finsi
					sinon	
						// normalement ce cas ne devrait aps se produire
						déclenchement erreur "Vous n'êtes pas habilités à poster des chapitres"
					finsi
					breack;
				updateOneChapter :
					si userConnected.status = Admin 
						si chapter.id  saisi et > 0
							si chapter.content non vide et chapter.resume et chapter.resume non vide
								appel updateOneChapter (title, resume, content)
							sinon
								déclenchement erreur "informations manquantes"
							finsi
						sinon
							déclenchement erreur "chapitre inconnu"
						finsi
					sinon	
						déclenchement erreur "Vous n'êtes pas habilités à modifier des chapitres"
					finsi
					breack;
				deleteOneChapter :
					si userConnected.status = Admin 
						si chapter.id  saisi et > 0
							appel deleteOneChapter (id)
						sinon
							déclenchement erreur "chapitre inconnu"
						finsi
					sinon	
						déclenchement erreur "Vous n'êtes pas habilités à supprimer des chapitres"
					finsi
					breack;
				validateComment :
					si userConnected.status = Admin 
						si comment.id  saisi et > 0
							appel validateAComment (id)
						sinon
							déclenchement erreur "commentaire inconnu"
						finsi
					sinon	
						déclenchement erreur "Vous n'êtes pas habilités à valider les commentaires"
					finsi
					breack;
				addComment :
					si userConnected.status non vide
						si comment.content n'est pas vide
							appel addComment (chapter.id, id, comment.content)
						sinon
							déclenchement erreur "commentaire inconnu"
						finsi
					sinon	
						déclenchement erreur "Connectez-vous pour poster des commentaires"
					finsi
					breack;
				updateComment :
					si userConnected.name = comment.author
						si comment.content n'est pas vide et comment.id  saisi et > 0
							appel updateComment (chapter.id, id, comment.content)
						sinon
							déclenchement erreur "commentaire inconnu"
						finsi
					sinon	
						déclenchement erreur "Vous ne pouvez modifier que vos commentaires"
					finsi
					breack;
				deleteComment :
					si userConnected.name = comment.author
						si comment.id  saisi et > 0
							appel deleteComment ( id)
						sinon
							déclenchement erreur "commentaire inconnu"
						finsi
					sinon	
						déclenchement erreur "Vous ne pouvez supprimer que vos commentaires"
					finsi
					breack;
				validateUser :
					si userConnected.status = Admin 
						si id  saisi et > 0
							appel validateUser (id)
						sinon
							déclenchement erreur "commentaire inconnu"
						finsi
					sinon	
						déclenchement erreur "Vous n'êtes pas habilités à valider les utilisateurs"
					finsi
					breack;
				deleteUser :
					si userConnected.name = Admin
						si id  saisi et > 0
							appel deleteUser ( id)
						sinon
							déclenchement erreur "Utilisateur inconnu"
						finsi
					sinon	
						déclenchement erreur "Vous ne pouvez administrer les comptes utilisateurs"
					finsi
					breack;
				updateUser :
					si userConnected.name = user.name
						si user.email et user.name ne sont pas vides et user.id  saisi et > 0
							appel updateUser (id, name, email)
						sinon
							déclenchement erreur "compte utilisateur inconnu"
						finsi
					sinon	
						déclenchement erreur "Vous ne pouvez administrer les comptes utilisateurs"
					finsi
					breack;
			finChoix		
		finsi -- user connected
	finsi	-- action demandée
		sinon
			déclenchement erreur "aucune action demandée"
		finsi	
capsule catch	
	appel errorProcessing (error)
fin catch
-->
<?php
/*
function chargerClasse($classe)
{
	
	$chemin = array(
		"dirEcrivain"=>'D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain',
		"ChaptersManager" =>'\model\ChaptersManager.php',
		"PrivateFrontEnd"=>'\controler\PrivateFrontEnd.php',
		"Chapter"=>'\model\Chapters.php',
		"MenuControler"=>'\view\menuControler.php',
		"UserManager"=>'\model\UserManager.php',
		"User"=>'\model\User.php',
		"AccessControl"=>'\controler\accessControl.php'
	);
	
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\config.php');
	
	if (isset($classe) && $chemin[$classe]!==Null){
		require ($chemin["dirEcrivain"].$chemin[$classe]);
	}else{
		echo "la classe est vide = " .$classe . " et " . $chemin[$classe];
	}
	
}*/

$Idchapters;

//spl_autoload_register('chargerClasse');

try{   
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\controler\FreeFrontEnd.php');
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\controler\PrivateFrontEnd.php');
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\ChaptersManager.php');
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\view.php');
	
	
	$monFreeControler=new FreeFrontEnd();
	$monPrivateControler=new PrivateFrontEnd();
	
	if(isset($_GET['action'])){
		
		if ($_GET['action']=='listValidChapter') {
			$monFreeControler->listChapter();
		}elseif ($_GET['action']=='askRegistration') {
			$monFreeControler->askRegistration();
		}elseif ($_GET['action']=='registration') {
			if(isset($_POST['userName']) && isset($_POST['userPwd'])) {
				$monAccessControl= new AccessControl();
				extract($monAccessControl->isUnknown($_POST['userName']),EXTR_PREFIX_SAME,"BIS");
				if ($result){
					extract($monAccessControl->verifPassword($_POST['userPwd']),EXTR_PREFIX_SAME,"BIS");
					if($result){
						echo 'appel registration ' . $_POST['userName'];
						$monFreeControler->registration($_POST['userName'],$_POST['userPwd'],$_POST['mail']);
					}else{
						throw new Exception ($message);						
					}
				}else{
					throw new Exception ($message);
				}
			}else{
				throw new Exception ('Données incomplètes.',11);
			}
		}elseif ($_GET['action']=='askUpdateProfil') {
			$monPrivateControler->askUpdateProfil();
		}elseif ($_GET['action']=='reservedAccess') {
			$monFreeControler->askReservedAccess();
		}elseif ($_GET['action']=='validAccessReserved') {
			if(isset($_POST['userName']) && isset($_POST['userPwd'])) {
				$monAccessControl= new AccessControl();
				extract($monAccessControl->getAutorized($_POST['userName'],$_POST['userPwd']),EXTR_PREFIX_SAME,"BIS");
				if($result){
					$monFreeControler->validAccessReserved();
				}else{
					throw new Exception ($message);
				}
			}else{
				throw new Exception ('Vous devez saisir un nom et mot de passe correct.');
			}
		}elseif ($_GET['action']=='abortAccess') {
			$monPrivateControler->abortAccess();
		}elseif ($_GET['action']=='askAddOneChapter') {
			$monPrivateControler->askAddOneChapter();
		}elseif ($_GET['action']=='addOneChapter') {
			$monPrivateControler->addOneChapter();
		}elseif ($_GET['action']=='oneChapter') {
			if(isset($_GET['Idchapters']) && $_GET['Idchapters']>0) {
				$monFreeControler->oneChapter($_GET['Idchapters']);
			}else{
				throw new Exception ('chapitre inconnu.',5);
			}
		}elseif ($_GET['action']=='deleteChapter') {
			if(isset($_GET['Idchapters']) && $_GET['Idchapters']>0) {
				$monPrivateControler->deleteChapter($_GET['Idchapters']);
			}else{
				throw new Exception ('Suppression impossible : chapitre inconnu.',4);
			}
		}elseif ($_GET['action']=='askUpdateChapter') {
			if(isset($_GET['Idchapters']) && $_GET['Idchapters']>0) {
				$Idchapters=$_GET['Idchapters'];
				$monPrivateControler->askUpdateChapter($_GET['Idchapters']);
			}else{
				throw new Exception ('Mise à jour impossible : chapitre inconnu.',3);
			}
		}elseif ($_GET['action']=='updateOneChapter') {
			echo 'arrivée updateOneChapter '; $_GET['Idchapters'];
			$monPrivateControler->updateChapter($_GET['Idchapters']);
		}else{
			throw new Exception (' choix non assumé !!! Héhééé',1);
		}
		
	}else{	
		
		$monFreeControler->hello();
		//throw new Exception (' Aucune action demandée !!! Héhééé',2);
	}
}
catch (Exception $e){
	echo 'erreur : '.$e->getmessage();
	$monFreeControler->printError($e->getmessage());
}
	