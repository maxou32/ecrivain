<?php
	namespace web_max\ecrivain;
    require_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\model\PersonManager.php');

class User extends PersonManager{

	// Liste des setters

	public function setIdUsers($idusers){
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