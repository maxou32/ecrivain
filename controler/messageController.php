<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\TypeMessageManager;
use web_max\ecrivain\model\Message;
use web_max\ecrivain\model\MessageManager;

class messageController	extends mainController	{
	
	public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
		//echo"<br /><pre> CONTROLLER CONSTRUCT ";print_r($this->myAction);echo"</pre>";
	}
	
	/**
     * recherche les messages d'un type particulier
     * @param  array    $params infos reçues
     *        sousAction permettant de trouver le type de message                 
     * @return object Message
     */
    public function prepareMessage($params){
		//echo"CONTROLLEUR : 0 prepareMessage<br /> <PRE>";print_r($params);echo"</PRE>";
		$monTypeMessageManager= new TypeMessageManager;
		$monTypemessage=$monTypeMessageManager->get($params['sousAction']);
		$monMessageManager= new MessageManager;
		$messages=$monMessageManager->getListByType($monTypemessage->getIdtypemessage());
		//echo"CONTROLLEUR : 0.5 prepareMessage<br /> <PRE>";print_r($messages);echo"</PRE>";
		return $messages;
	}
	
	/**
     * recherche les différents types de messages 
     * @param  array    $params infos reçues
     *        sousAction permettant de trouver le type de message                 
     * @return object typeMessage
     */
    public function prepareTypeMessage($params){
		//echo"CONTROLLEUR : 0 prepareMessage<br /> <PRE>";print_r($params);echo"</PRE>";
		$monMessageManager= new MessageManager;
		$message=$monMessageManager->get($params['cible']);
		return $message->getTexte();
		
	}
	
	/**
     * Crée, modifie et supprime els emssages en fonction du choix de l'utilsiateur.
     * recharge la page
     * @param  array    $params infos reçues
     *        sousAction Mettre à jour, Supprimer ou Ajouter                 
     * 
     */
    public	function CRUDMessage($params){
		$monMessage= new MessageManager;
		//echo "<br /> View CRUDMessage id=<PRE>";print_r($params);echo "</PRE>";
		switch ($params['sousAction']){
			case "Mettre à jour":
				$donnees=array('id'=> $params['id'],'texte' =>$params['texte'],'contexte' => $params['contexte']);
				$newMessage = new Message($donnees);	
				$messageManager= new MessageManager();
				$message=$messageManager->update($newMessage);		
				break;
			case "Supprimer":
				$messageManager= new MessageManager();
				//echo '<br /> id à détruire = '. $params['id'].'<br />';
				$messageManager->delete($params['id']); 
				break;
			case "Ajouter":
				$donnees=array('texte' => $params['texte'],'contexte' => $params['contexte'], 'message_idtypemessage'=> $params['idtypemessage']);
				$newMessage = new Message($donnees);	
				$messageManager= new MessageManager();
				$message=$messageManager->add($newMessage);	
				break;
		}
		$monTypeMessageManager= new TypeMessageManager;
		$monTypemessage=$monTypeMessageManager->getFromId($params['idtypemessage']);
		$libelle=$monTypemessage->getText();
		header('Location: index.php?askCRUDMessage/sousAction/'.$libelle);
	}
}