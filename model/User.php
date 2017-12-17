<?php
namespace web_max\ecrivain\model;
    
class User {
	private $_idusers;
	private $_name;
	private $_password;
	private $_email;
	private $_status_idstatus;
	private $_grade_idgrade;
	
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
	public function getIdusers()  { return $this->_idusers;}  
	public function getName()  {return $this->_name;}  
	public function getPassword()  {return $this->_password; }  
	public function getEmail()  {  return $this->_email;  }  
	public function getStatus_IdStatus() { return $this->_status_idstatus;}
	public function getGrade_IdGrade(){ return $this->_grade_idgrade;}
	
	// Liste des setters

	public function setIdusers($idusers){
		// On convertit l'argument en nombre entier.
		$idusers = (int) $idusers;
		// On vérifie ensuite si ce nombre est bien strictement positif.
		if ($idusers > 0){
		  // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
		  $this->_idusers = $idusers;
		}
	}
  
	public function setName($name){
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($name))    {
			$this->_name= $name;
		}
	}
 
	public function setPassword($password){
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($password))    {
			$this->_password= $password;
		}
	}

	public function setEmail($email){
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($email))    {
			$this->_email= $email;
		}
	}

	public function setStatus_IdStatus($status_idstatus){
		$status_idstatus=(int) $status_idstatus;
		if ($status_idstatus >0){
			$this->_status_idstatus= $status_idstatus;
		}
	}

	public function setGrade_IdGrade($grade_idgrade){
		$grade_idgrade=(int) $grade_idgrade;
		if ($grade_idgrade >0){
			$this->_grade_idgrade= $grade_idgrade;
		}
	}
}