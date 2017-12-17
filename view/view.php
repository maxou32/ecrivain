<?php
	//namespace web_max\ecrivain;

class View
{

    protected $template;
    protected $params;
	protected $userName;
	protected $menuView;
	protected $asideView;
	protected $contentView;
	protected $footerView;
	protected $avecParam;
	protected $captionMessage;
	protected $message;
	protected $imageBackGround;
	
    public function __construct($template){
        $this->template = $template;
		$this->userName="";
		$this->menuView="";
		$this->asideView="";
		$this->footerView="";
		$monConfig= new Config;
		echo $monConfig->getBackground();
		$this->imageBackGround=$monConfig->getBackground();
    }
	/*
	protected function verifAccess($levelAsk){
		echo 'verifAccess mère :' .  $levelAsk;
		$monAccessControl= new AccessControl();
		return $monAccessControl->verifAccessRight($levelAsk);
	}
	
    protected function renderOption(){
		//if ($this->avecParam){
			foreach ($this->params as $action => $values)
			{
				extract($this->params);
			};
		//}
		if($verifAccess){ 
			return $this->verifAccess($neededAccessRight);
		}else{
			return false;
		}	
    }
	*/
    protected function renderTop(){
		//$userName=$_SESSION['user'];
		$monControlerMenu= new MenuControler;
		return $monControlerMenu->sendMenu();
	}	
		
	protected function renderBottom(){	
		$monFooterView = new _footerView(NULL);
		return $monFooterView->show(NULL,NULL);
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
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView,$this->imageBackGround);
		$monTemplate->show();
	}
	
}