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

		<div class="barre_menu  navbar-fixed">
						<nav id="menu" class="nav-extended nav-wrapper blue darken-4">
					<a href="index.php" id= "logo" class="brand-logo">	
						<img src="public/media/wm.png"	alt="web-max"  class="logo">		
					</a> 
					<a href="#" data-activates="dropdown-mobile" id="menuReduit">
						<i class="material-icons">menu</i>
					</a>
					
								
						<ul id="menuGeneral" class="right hide-on-med-and-down">
							<li><a href="index.php" class="active item_menu">Accueil</a></li>
							<li><a href="index.php?_TheBookView/chap/1" class="item_menu">Mon livre</a></li>
							<li><a href="index.php?askSendMail" class="item_menu">Contact</a></li>
							<li><a href="#" class="item_menu">Qui suis-je ?</a></li>
							<li><a href="index.php?reservedAccess" class="item_menu">Accès réservé</a></li>
							<li class="demiHauteur"><a href="index.php?askRegistration"> Inscrivez-vous.</a></li>
						</ul>
				

			</nav>
				
		</div>
			
		<?php 
		$menuView=ob_get_clean(); 
		return $menuView;  
		
	}
}
