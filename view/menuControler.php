<?php
	namespace web_max\ecrivain;
	//session_start();
	//use web_max\ecrivain\view;

class MenuControler{
	protected static $instance;
	
	protected function __construct()   {
		  
		} 
	protected function __clone(){
		
	}
	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance=new self;
		}
		return self::$instance;
	}
	
	public function sendMenu(){
		
		if(isset($_SESSION['user'])){
			require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuPrivateView.php');
		}else{
			
			require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_menuFreeView.php');
		}
		return 	$menuView;
		
	}
}