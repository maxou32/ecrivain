<?php 
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\View;

class _MenuFreeView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){

		ob_start(); 
		?>

		<div id="barre_menu">
			<nav id="menu" class="navbar navbar-inverse  navbar-fixed-top">
				<div class="navbar-header">   
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					</button>
				</div>
				<div id= "logo" class="navbar-brand brand-logo">	
					<img src="public/media/wm.png"	alt="web-max" class="logo">		
				</div>
				<div class="collapse navbar-collapse">
					<ul id="menuGeneral" class="nav navbar-nav navbar-right">
						<li><a href="index.php" class="active item_menu">Accueil</a></li>
						<li><a href="index.php?_TheBookView/chap/1" class="item_menu">Mon livre</a></li>
						<li><a href="index.php?askSendMail" class="item_menu">Contact</a></li>
						<li><a href="#" class="item_menu">Qui suis-je ?</a></li>
						<li><a href="index.php?reservedAccess" class="item_menu">Accès réservé</a></li>
						<li class="demiHauteur"><a href="index.php?askRegistration"> Bonjour,<br />inscrivez-vous.</a></li>
					</ul>
				</div>
			</nav>
															<!-- fin "flottage" du menu -->
		</div>
			
		<?php 
		$menuView=ob_get_clean(); 
		return $menuView;  
		
	}
}
