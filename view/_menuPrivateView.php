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

		<script>
			 $(document).ready(function(e){
				$(".dropdown-button").dropdown();
				$(".button-collapse").sideNav();
			});
		</script>
		<div class="navbar-fixed">
			<ul id="menuMobile" class="side-nav active" >
				<li ><a class="no-padding" href="index.php" ><i class="material-icons left">home</i>Accueil</a></li>
				<li ><a class="no-padding" href="index.php?_listChaptersView" >Les chapitres</a></li>
				<li ><a class="no-padding" href="index.php?askAddOneChapter" >Nouveau chapitre</a></li>
				<li >
					<ul class="collapsible collapsible-accordion">
						<li><a class="collapsible-header no-padding" href="#">Mon site<i class="material-icons right">arrow_drop_down</i></a>
							<div class="collapsible-body">
								<ul>
									<li><a href="index.php?adminChapter">Chapitres</a></li>
									<li><a href="index.php?adminComment" >Commentaires</a></li>
									<li><a href="index.php?adminUser" >Utilisateurs</a></li>
									<li class="divider"></li>
									<li><a href="index.php?askCRUDMessage/sousAction/Information/cible/askCRUDMessage" >Messages d'information</a></li>
									<li><a href="index.php?askCRUDMessage/sousAction/Erreur/cible/askCRUDMessage" >Messages d'erreur</a></li>
									<li class="divider"></li>
									<li><a href="index.php?askCRUDstatus">Les statuts</a></li>
								</ul>
							</div>				  
						</li>
					</ul>
				</li>
				<li >
					<ul class="collapsible collapsible-accordion">
						<li><a class="collapsible-header no-padding" href="#">Bonjour, <?= $params ?><i class="material-icons right">arrow_drop_down</i></a>
							<div class="collapsible-body">
								<ul>
									<li><a href="index.php?askUpdateProfil" class="item_menu">Mon profil</a></li>
									<li class="divider"></li>
									<li><a href="index.php?abortAccess" class="item_menu">Me déconnecter</a></li>
								</ul>
							</div>				  
						</li>
					</ul>
				</li>
			</ul>
			<ul  class="dropdown-content active" id="dropdown-1">
				<li><a href="index.php?adminChapter">Chapitres</a></li>
				<li><a href="index.php?adminComment" >Commentaires</a></li>
				<li><a href="index.php?adminUser" >Utilisateurs</a></li>
				<li class="divider"></li>
				<li><a href="index.php?askCRUDMessage/sousAction/Information/cible/askCRUDMessage" >Messages d'information</a></li>
				<li><a href="index.php?askCRUDMessage/sousAction/Erreur/cible/askCRUDMessage" >Messages d'erreur</a></li>
				<li class="divider"></li>
				<li><a href="index.php?askCRUDstatus">Les statuts</a></li>
			</ul>
			<ul  class="dropdown-content active" id="dropdown-2">
				<li><a href="index.php?askUpdateProfil" class="item_menu">Mon profil</a></li>
				<li class="divider"></li>
				<li><a href="index.php?abortAccess" class="item_menu">Me déconnecter</a></li>
			</ul>
			<nav >
				<div id="menu" class="nav-wrapper blue darken-1">
					<a href="index.php" id= "logo" class="brand-logo">	
						<img src="public/media/wm.png"	alt="web-max"  class="logo">		
					</a> 
					<a href="#" data-activates="menuMobile" id="menuReduit" class="button-collapse">
						<i class="material-icons">menu</i>
					</a>	
					<ul id="menuGeneral" class="right hide-on-med-and-down">
						<li><a href="index.php"><i class="material-icons left">home</i>Accueil</a></li>
						<li><a href="index.php?_listChaptersView" >Les chapitres</a></li>
						<li><a href="index.php?askAddOneChapter" >Nouveau chapitre</a></li>
						<li><a data-activates="dropdown-1" class="dropdown-button" href="#">Mon site<i class="material-icons right">arrow_drop_down</i></a></li>
						<li><a data-activates="dropdown-2" class="dropdown-button" href="#">Bonjour, <?= $params ?><i class="material-icons right">arrow_drop_down</i></a></li>
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
