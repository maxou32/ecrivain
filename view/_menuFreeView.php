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
		
			<nav class="barre_menu  navbar-fixed">
				<div id="menu" class="nav-wrapper blue darken-1" >
					
					<a href="#" data-activates="menuMobile" id="menuReduit" class="button-collapse">
						<i class="material-icons">menu</i>
					</a>	
					<ul id="menuGeneral" class="left hide-on-med-and-down">
						<li><a href="index.php" ><i class="material-icons left">home</i>Accueil</a></li>
						<li><a href="index.php?_TheNextBookView/chap/0" >Lisez mon livre</a></li>
						<li><a href="index.php?askSendMail">Contactez moi</a></li>
						<li><a href="index.php?askRegistration"> Inscrivez-vous.</a></li>
						<li class="divider"></li>
						<li><a href="index.php?reservedAccess" >Pour préparer le livre</a></li>
					
					</ul>
					<ul id="menuMobile" class="side-nav" >
						<li><a href="index.php" ><i class="material-icons left">home</i>Accueil</a></li>
						<li><a href="index.php?_TheNextBookView/chap/0" >Lisez mon livre</a></li>
						<li><a href="index.php?askSendMail" >Contactez moi</a></li>
						<li><a href="index.php?askRegistration"> Inscrivez-vous.</a></li>
						<li class="divider"></li>
						<li><a href="index.php?reservedAccess">Pour préparer le livre</a></li>
					</ul>
					<a href="index.php" id= "logo" class="right  brand-logo">	
						<img src="public/media/wm.png"	alt="web-max"  class="logo">		
					</a> 
				</div>
			</nav>
				
		
			
		<?php 
		$menuView=ob_get_clean(); 
		return $menuView;  
		
	}
}
