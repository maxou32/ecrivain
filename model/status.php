<?php
	//namespace web_max\ecrivain;
    
class Status {
	private $_idstatus;
	private $_libelle;
	
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
	public function getIdstatus()  { return $this->_idstatus;}  
	public function getLibelle()  {return $this->_libelle;}  
	
	// Liste des setters

	public function setIdstatus($idstatus){
		$idstatus = (int) $idstatus;
		if ($idstatus > 0){
		  $this->_idstatus = $idstatus;
		}
	}
  
	public function setLibelle($libelle){
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($libelle))    {
			$this->_libelle= $libelle;
		}
	}
}