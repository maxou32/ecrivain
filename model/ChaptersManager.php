<?php
namespace web_max\ecrivain\model;
?>

<!--  cas chapters processing 

inscription dans le namespace

transfert hostName

chargement classe Manager

extension de la classe manager
	fonction publique lsitChapers
		connexion base de donnees
		preparation requete
		exécution dans tableau
		retour tableau
	fin
	...
-->
<?php


require_once ('model/Manager.php');


class ChaptersManager extends Manager{
	
	public function listChapters($status){
		$this->setHost('localhost');
		
		$db= $this->dbConnect();
		$listChapters= $db->prepare('SELECT idchapters, title, resume, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr FROM chapters ORDER BY chapter_date ASC');
		$listChapters->execute(array());
		
		return $listChapters;
	}
}	
