<?php 
	//namespace web_max\ecrivain;
	
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
						<li><a href="index.php?action=_messageView" class="item_menu">Accueil</a></li>
						<li><a href="index.php?action=_listChaptersView" class="item_menu">Derniers chapitres</a></li>
						<li><a href="#" class="item_menu">Contact</a></li>
						<li><a href="#" class="item_menu">Qui suis-je ?</a></li>
						<li><a href="index.php?action=reservedAccess" class="item_menu">Accès réservé</a></li>
						<li id="demiHauteur"><a href="index.php?action=askRegistration"> Bonjour,<br />inscrivez-vous.</a></li>
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
