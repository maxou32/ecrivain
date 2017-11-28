<?php
//namespace web_max\ecrivain\model;

class Chapter{
	private $_idchapters;
	private $_title;
	private $_resume;
	private $_content;
	private $_date_fr;
	private $_users_idusers;
	private $_status_idstatus;
	
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
	public function getUser_IdUsers() { return $this->_users_idusers;}
	public function getStatus_IdStatus(){ return $this->_status_idstatus;}

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
    
    if ($date_fr >= 0 )
    {
      $this->_date_fr= $date_fr;
    }
  }
  public function setUsers_IdUsers($users_idusers){
    // On convertit l'argument en nombre entier.
    $users_idusers = (int) $users_idusers;
    // On vérifie ensuite si ce nombre est bien strictement positif.
    if ($users_idusers > 0){
      // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
      $this->_users_idusers = $users_idusers;
    }
  }
    public function setStatus_IdStatus($status_idstatus){
    // On convertit l'argument en nombre entier.
    $status_idstatus = (int) $status_idstatus;
    // On vérifie ensuite si ce nombre est bien strictement positif.
    if ($status_idstatus > 0){
      // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
      $this->_status_idstatus = $status_idstatus;
    }
  }
}