<?php
	//namespace web_max\ecrivain;
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


// Adresse du serveur de base de données
	define('DB_SERVEUR', 'localhost');

	// Login
	define('DB_LOGIN','root');

	// Mot de passe
	define('DB_PASSWORD','');

	// Nom de la base de données
	define('DB_NOM','ecrivain');

	// Nom de la table du livre d'or
	define('DB_GUESTBOOK_TABLE','guestbook');

	// Driver correspondant à la BDD utilisée
	define('DB_DSN','mysql:host='. DB_SERVEUR .';dbname='. DB_NOM);

	// Nombre de messages à afficher par page
	define('MAX_MESSAGES_PAR_PAGE', 5);

	// URL du livre d'or
	define('URL_GUESTBOOK', 'http:\\127.0.0.1:8000\edsa-test_php\TP_XX\ecrivain');

	// chemin absolu
	define('DIR_ECRIVAIN', 'D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain');
/*
 function chargerClasse($classe)
{
  require $classe . '.php';
  //require(__DIR__ . "\" . $classe . ".php");
}
*/
require(DIR_ECRIVAIN . '\controler\FreeFrontEnd.php');
//require('..\controler\privateFrontEnd.php');

//spl_autoload_register('chargerClasse');

//$db = new \PDO('mysql:host=localhost;dbname=ecrivain;charset=utf8', 'root', '');
function PDOConnect($sDbDsn, $sDbLogin, $sDbPassword) 
{
  try
  {
    $db = new PDO($sDbDsn, $sDbLogin, $sDbPassword);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
  return $db;
  }
  catch (PDOException $e)
  {
    die('Une erreur interne est survenue');
  }
 
  
}

/** ----
 * Initialisation de la connexion avec la base de données
 **/
$db = PDOConnect(DB_DSN, DB_LOGIN, DB_PASSWORD);

try{
	
	$monControler=new FreeFrontEnd();
	if(isset($_GET['action'])){
		
		if ($_GET['action']=='listValidChapter') {
			//$monControler=new web_max\ecrivain\controler\FreeFrontEnd();
			$monControler->listChapter($db);		
		}else{
			throw new Exception (' choix non assumé !!! Héhééé',1);
		}
	}else{
		
		$monControler->hello();
		//throw new Exception (' Aucune action demandée !!! Héhééé',2);
	}
}
catch (Exception $e){
	//echo 'erreur : ' . $e;				//en attendant mieux
	printError($e->getmessage());
}
	