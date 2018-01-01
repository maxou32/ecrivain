<?php
namespace web_max\ecrivain\model;

class Comment{
	private $_idcomments;
	private $_name;
	private $_content;
	private $_user_iduser;
	private $_status_idstatus;
	private $_comment_Date;
	private $_chapter_idchapter;
	
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
	public function getIdcomments()  { return $this->_idcomments;}  
	public function getName()  {return $this->_name; }  
	public function getContent()  {  return $this->_content;  }  
	public function getCommentDate()  {    return $this->_comment_Date;  }
	public function getUser_IdUser() { return $this->_user_iduser;}
	public function getStatus_IdStatus(){ return $this->_status_idstatus;}
	public function getChapter_IdChapter() {return $this->_chapter_idchapter;}  
	
	// Liste des setters

	public function setIdcomments($idcomments){
		// On convertit l'argument en nombre entier.
		$idcomments = (int) $idcomments;
		// On vérifie ensuite si ce nombre est bien strictement positif.
		if ($idcomments > 0){
			// Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
			$this->_idcomments = $idcomments;
		}
	}
	  
	public function setName($name){
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($name))
		{
			$this->_name= $name;
		}
	}
	  
	public function setContent($content){
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		if (is_string($content))
		{
			$this->_content= $content;
		}
	}
	
	public function setComment_Date($comment_Date){
		if ($comment_Date >= 0 )
		{
			$this->_comment_Date= $comment_Date;
		}
	}

	public function setUsers_IdUsers($user_iduser){
		// On convertit l'argument en nombre entier.
		$user_iduser = (int) $user_iduser;
		// On vérifie ensuite si ce nombre est bien strictement positif.
		if ($user_iduser > 0){
			// Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
			$this->_user_iduser = $user_iduser;
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
	
	public function setChapter_IdChapter($chapter_idchapter){
			// On convertit l'argument en nombre entier.
			$chapter_idchapter = (int) $chapter_idchapter;
			// On vérifie ensuite si ce nombre est bien strictement positif.
			if ($chapter_idchapter > 0){
			  // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
				$this->_chapter_idchapter = $chapter_idchapter;
			}
	  }
  }