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
			<nav id="menu">
				<div id= "logo" class="brand-logo">	
					<img src="public/media/wm.png"	alt="web-max">		
				</div>
				<div class="nav-wrapper">
					<ul id="menuGeneral" class="right hide-on-med-and-down">
						<li><a href="index.php" class="item_menu">Accueil</a></li>
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
