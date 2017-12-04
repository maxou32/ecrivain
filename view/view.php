<?php
	namespace web_max\ecrivain;

class View
{

    protected $template;
    protected $params;
	protected $menuView;
	protected $asideView;
	protected $contentView;
	protected $footerView;
	protected $avecParam;
	protected $captionMessage;
	protected $message;
	
    public function __construct($template){
        $this->template = $template;
		$this->asideView="";
		$this->footerView="";
    }
	
	protected function verifAccess($levelAsk){
		//echo 'verifAccess mère :' .  $levelAsk;
		$monAccessControl= new AccessControl();
		return $monAccessControl->verifAccessRight($levelAsk);
	}
	
    protected function renderOption(){
		if ($this->avecParam){
			foreach ($this->params as $action => $values)
			{
				//$html =$html. $value;//${$name} = $value; //extract($params) array('message' => 'hello world'); => $message = "hello word';
				extract($this->params);
			};
		}
		if($verifAccess){ 
			return $this->verifAccess($neededAccessRight);
		}else{
			return false;
		}	
    }

    protected function renderTop(){
		$monControlerMenu= MenuControler::getInstance();
		$asideView= $this->asideView;
		return $monControlerMenu->sendMenu();
	}	
		
	protected function renderBottom(){	
		if (!isset($captionMessage)){ 
			$this->captionMessage="";
			$this->message="";
			$this->footerView="";
		}
		return $this->footerView;
    }
	
	protected function renderAside(){	
		$this->asideView="";
		return $this->asideView;
	}

	public function show($params,$datas){
		$menuView=$this->renderTop();
		$asideView=$this->renderAside();
		$footerView=$this->renderBottom();
		$contentView="";
		include_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php');
	}
}