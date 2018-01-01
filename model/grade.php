<?php
	namespace web_max\ecrivain\model;
    
class Grade {
	private $_idgrade;
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
	public function getIdgrade()  { return $this->_idgrade;}  
	public function getLibelle()  {return $this->_libelle;}  
	
	// Liste des setters

	public function setIdgrade($idgrade){
		$idgrade = (int) $idgrade;
		if ($idgrade > 0){
		  $this->_idgrade = $idgrade;
		}
	}
  
	public function setLibelle($libelle){
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($libelle))    {
			$this->_libelle= $libelle;
		}
	}
}