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
						<li><a href="index.php" class="item_menu">Accueil</a></li>
						
						<li><a href="index.php?_listChaptersView" class="item_menu">Les chapitres</a></li>
						<li><a href="index.php?askAddOneChapter" class="item_menu">Enregistrement d'un chapitre</a></li>
						<li><a class="dropdown-button" class="item_menu" href="!#"  data-activates="admin">Administration<i class="material-icons  right">arrow_drop_down</i></a>
							<ul id="admin" class="dropdown-content">
								<li><a href="index.php?adminChapter" class="item_menu">Chapitres</a></li>
								<li><a href="index.php?adminComment" class="item_menu">Commentaires</a></li>
								<li><a href="index.php?adminUser" class="item_menu">Utilisateurs</a></li>
							</ul>
						</li>
						<li><a class="dropdown-button" href="#!" data-activates="admin">Gestion<i class="material-icons  right">arrow_drop_down</i></a>
							<!-- <li class="dropdown-button">administration  -->
							<ul id="gestion" class="dropdown-content">
								<li><a href="index.php?askCRUDMessage/sousAction/Information" class="item_menu">Messages d'information</a></li>
								<li><a href="index.php?askCRUDMessage/sousAction/Erreur" class="item_menu">Messages d'erreur</a></li>
								<li><a href="index.php?adminUser" class="item_menu">Gestion des users</a></li>
							</ul>
						</li>
					
						<li class="demiHauteur"><a href="index.php?askUpdateProfil"> Bonjour, <?= $params ?></a><a href="index.php?abortAccess" class="item_menu">Deconnexion</a></li>
						
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
