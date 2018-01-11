<?php
	namespace web_max\ecrivain\model;
    
class Message {
	private $_id;
	private $_texte;
	private $_number;
	private $_contexte;
	private $_message_idtypemessage;
	
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
	public function getId()  { return $this->_id;}  
	public function getTexte()  {return $this->_texte;}  
	public function getNumber()  {return $this->_number;}  
	public function getContexte()  {return $this->_contexte; }  
	public function getMessage_idtypemessage()  {return $this->_message_idtypemessage; }  
	
	// Liste des setters

	public function setId($id){
		// On convertit l'argument en nombre entier.
		$id = (int) $id;
		// On vérifie ensuite si ce nombre est bien strictement positif.
		if ($id > 0){
		  // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
		  $this->_id = $id;
		}
	}
  
	public function setNumber($number){
		// On convertit l'argument en nombre entier.
		$number = (int) $number;
		// On vérifie ensuite si ce nombre est bien strictement positif.
		if ($number > 0){
		  // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
		  $this->_number = $number;
		}
	}

	public function setTexte($texte){
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($texte))    {
			$this->_texte= $texte;
		}
	}
 
	public function setContexte($contexte){
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($contexte))    {
			$this->_contexte= $contexte;
		}
	}
	public function setMessage_idtypemessage($message_idtypemessage){
		// On convertit l'argument en nombre entier.
		$message_idtypemessage = (int) $message_idtypemessage;
		// On vérifie ensuite si ce nombre est bien strictement positif.
		if ($message_idtypemessage > 0){
		  // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
		  $this->_message_idtypemessage = $message_idtypemessage;
		}
	}
}