<?php 
namespace web_max\ecrivain\view;
	
class _MenuPrivateView extends View
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
				<div class="nav-wrapper" >
					<ul id="menuGeneral" class="right hide-on-med-and-down">
						<li><a href="index.php?action=_messageView" class="item_menu">Accueil</a></li>
						
						<li><a href="index.php?action=_listChaptersView" class="item_menu">Derniers chapitres</a></li>
						<li><a href="index.php?action=askAddOneChapter" class="item_menu">Enregistrement d'un chapitre</a></li>
						<li><a href="index.php?action=adminChapter" class="item_menu">Adminstrer les chapitres</a></li>
						<li><a class="dropdown-button" href="#!" data-activates="admin">Administration<i class="material-icons  right">arrow_drop_down</i></a>
						<!-- <li class="dropdown-button">administration  -->
							<ul id="admin" class="dropdown-content">
								<li><a href="index.php?action=askUpdateProfil">						Votre profil</a></li>
								<li><a href="index.php?action=askCRUDMessage&amp;sousAction=Information" class="item_menu">Messages d'information</a></li>
								<li><a href="index.php?action=askCRUDMessage&amp;sousAction=Erreur" class="item_menu">Messages d'erreur</a></li>
							</ul>
						</li>
						<li><a href="index.php?action=abortAccess" class="item_menu">Deconnexion</a></li>
						
					</ul>
				</div>
			</nav>
			
			<p id="souslogoflottant"></p>												<!-- fin "flottage" du menu -->
		</div>
			
		<?php 
		$menuView=ob_get_clean(); 
		return $menuView;  
		
	}
}
