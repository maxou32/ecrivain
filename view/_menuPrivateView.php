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
				$("#dd1").dropdown();
				$("#menuReduit").dropdown();

				$("#dd2").dropdown();
			});
		</script>
		<div class="barre_menu navbar-fixed">
			<ul id="dropdown-mobile" class="side-nav" >
				<li><a href="index.php" class="active item_menu">Accueil</a></li>
				<li><a href="index.php?_listChaptersView" class="item_menu">Les chapitres</a></li>
				<li><a href="index.php?askAddOneChapter" class="item_menu">Ajouter un chapitre</a></li>
			</ul>
			<ul id="dropdown-1" class="dropdown-content">
				<li><a href="index.php?adminChapter" class="item_menu">Chapitres</a></li>
				<li><a href="index.php?adminComment" class="item_menu">Commentaires</a></li>
				<li><a href="index.php?adminUser" class="item_menu">Utilisateurs</a></li>
				<li class="divider"></li>
				<li><a href="index.php?askCRUDMessage/sousAction/Information/cible/askCRUDMessage" class="item_menu">Messages d'information</a></li>
				<li><a href="index.php?askCRUDMessage/sousAction/Erreur/cible/askCRUDMessage" class="item_menu">Messages d'erreur</a></li>
			</ul>
			<ul id="dropdown-2" class="dropdown-content">
				<li><a href="index.php?askUpdateProfil" class="item_menu">Mon profil</a></li>
				<li class="divider"></li>
				<li><a href="index.php?abortAccess" class="item_menu">Me déconnecter</a></li>
			</ul>
			<nav id="menu" class="nav-extended nav-wrapper blue darken-1">
					<a href="index.php" id= "logo" class="brand-logo">	
						<img src="public/media/wm.png"	alt="web-max"  class="logo">		
					</a> 
					<a href="#" data-activates="dropdown-mobile" id="menuReduit">
						<i class="material-icons">menu</i>
					</a>
					
								
						<ul id="menuGeneral" class="right hide-on-med-and-down">
							<li><a href="index.php" class="active item_menu">Accueil</a></li>
							<li><a href="index.php?_listChaptersView" class="item_menu">Les chapitres</a></li>
							<li><a href="index.php?askAddOneChapter" class="item_menu">Ajouter un chapitre</a></li>
							<li><a  id="dd1" data-toggle="dropdown"  data-activates="dropdown-1" class="item-menu dropdown-button"  href="#">Administration<b class="caret"></b><i class="material-icons right">arrow_drop_down</i></a></li>
							<li><a  id="dd2" data-toggle="dropdown"  data-activates="dropdown-2" class="dropdown-button" href="#">Bonjour, <?= $params ?><b class="caret"></b><i class="material-icons right">arrow_drop_down</i></a></li>
						</ul>
				

			</nav>
			
			<p id="souslogoflottant"></p>												<!-- fin "flottage" du menu -->
		</div>
		

		<?php 
		$menuView=ob_get_clean(); 
		return $menuView;  
		
	}
}
