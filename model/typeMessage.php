<?php
namespace web_max\ecrivain\model;
    
class TypeMessage {
	private $_idtypemessage;
	private $_text;
	
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
	public function getIdtypemessage()  { return $this->_idtypemessage;}  
	public function getText()  {return $this->_text;}  
	
	// Liste des setters

	public function setIdtypemessage($idtypemessage){
		// On convertit l'argument en nombre entier.
		$idtypemessage = (int) $idtypemessage;
		// On vérifie ensuite si ce nombre est bien strictement positif.
		if ($idtypemessage > 0){
		  // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
		  $this->_idtypemessage = $idtypemessage;
		}
	}
  
	public function setText($text){
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($text))    {
			$this->_text= $text;
		}
	}
}