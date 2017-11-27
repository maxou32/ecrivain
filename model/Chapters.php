<?php
//namespace web_max\ecrivain;

//require_once ('model/Manager.php');
class Chapter{
	private $_idchapters;
	private $_title;
	private $_resume;
	private $_content;
	private $_date_fr;
	// Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).

	public function __construct(array $donnees)   {
		$this->hydrate($donnees);   
	} 
  
	public function hydrate(array $donnees){
		foreach ($donnees as $key => $value){
			// On récupère le nom du setter correspondant à l'attribut.
			$method = 'set'.ucfirst($key);
				
			// Si le setter correspondant existe.
			if (method_exists($this, $method)){
			  // On appelle le setter.
			  $this->$method($value);
			}
		}
	}
	// Liste des getters  
	public function getIdchapters()  { return $this->_idchapters;}  
	public function getTitle()  {return $this->_title;}  
	public function getResume()  {return $this->_resume; }  
	public function getContent()  {  return $this->_content;  }  
	public function getDateFr()  {    return $this->_date_fr;  }

	// Liste des setters

	public function setIdchapters($idchapters){
    // On convertit l'argument en nombre entier.
    $idchapters = (int) $idchapters;
    // On vérifie ensuite si ce nombre est bien strictement positif.
    if ($idchapters > 0){
      // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
      $this->_idchapters = $idchapters;
    }
  }
  
  public function setTitle($title){
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    if (is_string($title))
    {
      $this->_title= $title;
    }
  }
  
  public function setResume($resume){
   // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    if (is_string($resume))
    {
      $this->_resume= $resume;
    }
  }
  
  public function setContent($content){
	// On vérifie qu'il s'agit bien d'une chaîne de caractères.
    if (is_string($content))
    {
      $this->_content= $content;
    }
  }
  
  public function setDate_fr($date_fr)
  {
    $date_fr = ($date_fr) ;
    
    if ($date_fr >= 0 )
    {
      $this->_date_fr= $date_fr;
    }
  }
}

/*
class ChaptersManager extends Manager{
*/
	/*
	public function listChapters($status){
		$this->setHost('localhost');
		
		$db= $this->dbConnect();
		$listChapters= $db->prepare('SELECT idchapters, title, resume, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr FROM chapters ORDER BY chapter_date ASC');
		$listChapters->execute(array());
		
		return $listChapters;
	}*/
	/*$db= $this->dbConnect();
	$listChapters = $db->query('SELECT idchapters, title, resume, content, DATE_FORMAT( chapter_date, \'%d/%m/%Y\') as date_fr FROM chapters ORDER BY chapter_date ASC');

	while ($data = $listChapters->fetch(PDO::FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array.
	{
		// On passe les données (stockées dans un tableau) concernant le personnage au constructeur de la classe.
		// On admet que le constructeur de la classe appelle chaque setter pour assigner les valeurs qu'on lui a données aux attributs correspondants.
		$chapter = new Chapter($data);
			
		//echo $perso->nom(), ' a ', $perso->forcePerso(), ' de force, ', $perso->degats(), ' de dégâts, ', $perso->experience(), ' d\'expérience et est au niveau ', $perso->niveau();
	}
	*/	
