<?php
	namespace web_max\ecrivain\view;
	use web_max\ecrivain\view\MenuControler;
class View
{

    protected $template;
    protected $params;
	protected $userName;
	protected $menuView;
	//protected $asideView;
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
		//$this->asideView="";
		$this->footerView="";
		$monConfig= new Config;
		echo $monConfig->getBackground();
		$this->imageBackGround=$monConfig->getBackground();
    }
	
    protected function renderTop(){
		//$userName=$_SESSION['user'];
		$monControlerMenu= new MenuControler;
		return $monControlerMenu->sendMenu();
	}	
		
	protected function renderBottom(){	
		$monFooterView = new _footerView(NULL);
		return $monFooterView->show(NULL,NULL);
    }
	
	public function show($params,$datas){
		
		$menuView=$this->renderTop();
		$asideView=$this->renderAside();
		$footerView=$this->renderBottom();
		$contentView="";
		$monTemplate= new template($menuView,$asideView,$footerView,$contentView,$this->imageBackGround);
		$monTemplate->show(null,null);
	}
	
}