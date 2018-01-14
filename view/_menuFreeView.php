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
		<script>
			 $(document).ready(function(e){
				$(".button-collapse").sideNav();
			});
		</script>
		<div class="barre_menu  navbar-fixed">
			<nav>
				<div id="menu" class="nav-wrapper blue darken-1" >
					<a href="index.php" id= "logo" class="brand-logo">	
						<img src="public/media/wm.png"	alt="web-max"  class="logo">		
					</a> 
					<a href="#" data-activates="menuMobile" id="menuReduit" class="button-collapse">
						<i class="material-icons">menu</i>
					</a>	
					<ul id="menuGeneral" class="right hide-on-med-and-down">
						<li><a href="index.php" >Accueil</a></li>
						<li><a href="index.php?_TheBookView/chap/1" >Mon livre</a></li>
						<li><a href="index.php?askSendMail">Contact</a></li>
						<li><a href="index.php?reservedAccess" >Accès réservé</a></li>
						<li><a href="index.php?askRegistration"> Inscrivez-vous.</a></li>
					</ul>
					<ul id="menuMobile" class="side-nav" >
						<li><a href="index.php" >Accueil</a></li>
						<li><a href="index.php?_TheBookView/chap/1" >Mon livre</a></li>
						<li><a href="index.php?askSendMail" >Contact</a></li>
						<li><a href="index.php?reservedAccess">Accès réservé</a></li>
						<li><a href="index.php?askRegistration"> Inscrivez-vous.</a></li>
					</ul>
				</div>
			</nav>
				
		</div>
			
		<?php 
		$menuView=ob_get_clean(); 
		return $menuView;  
		
	}
}
