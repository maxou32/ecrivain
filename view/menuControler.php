<?php
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\_MenuPrivateView;
 
class MenuControler{
	
	public function __construct()   {
		 } 
	
	public function sendMenu(){
		
		if(isset($_SESSION['user'])){
			$userName=$_SESSION['user'];
			$menuPrivate= new _MenuPrivateView(NULL);
			return $menuPrivate->show($userName,NULL);
		}else{
			$menuFree= new	_MenuFreeView(NULL);
			return $menuFree->show(NULL,NULL);
		}
	}
}