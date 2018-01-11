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

			<nav id="menu" class="navbar  navbar-fixed-top">
				<div class="navbar-header">   
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					</button>
				</div>
				<div id= "logo" class="navbar-brand brand-logo">	
					<img src="public/media/wm.png"	alt="web-max"  class="logo">		
				</div> 
				<div class="collapse navbar-collapse">
					<ul id="menuGeneral" class="nav navbar-nav navbar-right">
						<li><a href="index.php" class="active item_menu">Accueil</a></li>
						
						<li><a href="index.php?_listChaptersView" class="item_menu">Les chapitres</a></li>
						<li><a href="index.php?askAddOneChapter" class="item_menu">Ajouter un chapitre</a></li>
						<li class="dropdown">
							<a  data-toggle="dropdown"  href="#">Administration<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="index.php?adminChapter" class="item_menu">Chapitres</a></li>
								<li><a href="index.php?adminComment" class="item_menu">Commentaires</a></li>
								<li><a href="index.php?adminUser" class="item_menu">Utilisateurs</a></li>
								<li class="divider"></li>
								<li><a href="index.php?askCRUDMessage/sousAction/Information/cible/askCRUDMessage" class="item_menu">Messages d'information</a></li>
								<li><a href="index.php?askCRUDMessage/sousAction/Erreur/cible/askCRUDMessage" class="item_menu">Messages d'erreur</a></li>
							</ul>
						</li>			
						<li class="dropdown">
							<a  data-toggle="dropdown"  href="#">Bonjour, <?= $params ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="index.php?askUpdateProfil" class="item_menu">Mon profil</a></li>
								<li class="divider"></li>
								<li><a href="index.php?abortAccess" class="item_menu">Me déconnecter</a></li>
							</ul>
						</li>			
						
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
