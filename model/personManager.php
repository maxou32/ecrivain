<?php
	namespace web_max\ecrivain;

class PersonManager{
	
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
	public function getIdPersons()  { return $this->_idPersons;}  
	public function getName()  {return $this->_name;}  
	public function getPassword()  {return $this->_password;} 
	public function getEmail()  {return $this->_email; }  
	public function getStatus_IdStatus()  {  return $this->_status_idstatus;  }  
	public function getGrade_IdGrade()  {    return $this->_grade_idgrade;  }
	
	// Liste des setters
	public function setIdUsers($idusers){}
	public function setName($name){}
	public function setPassword($password){}
	public function setEmail($email){}
	public function setStatus_IdStatus($status_idstatus){}
	public function setGrade_IdGrade($grade_idgrade){}
}
	