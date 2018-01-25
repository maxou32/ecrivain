<?php
namespace web_max\ecrivain\controler;
use web_max\ecrivain\lib\Config;
use web_max\ecrivain\model\TypeMessageManager;
use web_max\ecrivain\model\Message;
use web_max\ecrivain\model\MessageManager;

class messageController	extends MainController	{
	
	public function __construct($myRoad, $action){
		$this->myRoad=$myRoad;
		$this->myAction=$action;
		$this->myConfig= new Config;
	}
	
	/**
     * recherche les messages d'un type particulier
     * @param  array    $params infos reçues
     *        sousAction permettant de trouver le type de message                 
     * @return object Message
     */
    public function prepareMessage($params){
		
		$monTypeMessageManager= new TypeMessageManager;
		$monTypemessage=$monTypeMessageManager->get($params['sousAction']);
		$monMessageManager= new MessageManager;
		$messages=$monMessageManager->getListByType($monTypemessage->getIdtypemessage());
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
		if (isset($params['cible'])){
			$message=$monMessageManager->get($params['cible']);
			return $message->getTexte();
		}else{
			return "";
		}
		
		
	}
	
	/**
     * Crée, modifie et supprime les emssages en fonction du choix de l'utilsiateur.
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
				$donnees=array('id'=> $params['id'], 'number' => $params['number'], 'texte' =>$params['texte'],'contexte' => $params['contexte']);
				$newMessage = new Message($donnees);	
				$messageManager= new MessageManager();
				$message=$messageManager->update($newMessage);	
				if($message){
					$monError=new ErrorController();
					$monError->setError(array("origine"=> "web_max\ecrivain\controler\Messagentroller", "raison"=>"Mise à jour des messages", "numberMessage"=>23));
				}
				
				break;
			case "Supprimer":
				$messageManager= new MessageManager();
				//echo '<br /> id à détruire = '. $params['id'].'<br />';
				$message=$messageManager->delete($params['id']); 
				if($message){
					$monError=new ErrorController();
					$monError->setError(array("origine"=> "web_max\ecrivain\controler\Messagentroller", "raison"=>"Mise à jour des messages", "numberMessage"=>24));
				}
				break;
			case "Ajouter":
				$donnees=array('texte' => $params['texte'], 'number' => $params['number'], 'contexte' => $params['contexte'], 'message_idtypemessage'=> $params['idtypemessage']);
				$newMessage = new Message($donnees);	
				$messageManager= new MessageManager();
				$message=$messageManager->add($newMessage);	
				if($message){
					$monError=new ErrorController();
					$monError->setError(array("origine"=> "web_max\ecrivain\controler\Messagentroller", "raison"=>"Mise à jour des messages", "numberMessage"=>21));
				}
				break;
		}
		$monTypeMessageManager= new TypeMessageManager;
		$monTypemessage=$monTypeMessageManager->getFromId($params['idtypemessage']);
		$libelle=$monTypemessage->getText();
		header('Location: index.php?askCRUDMessage/sousAction/'.$libelle);
	}
}