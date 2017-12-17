<?php 
	//namespace web_max\ecrivain;
	//require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class _MenuFreeView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){

		ob_start(); 
		?>

		<aside id="barreAside">
			
			<div">
				<ul id="choixAside">
					<li><a href="index.php?action=listValidChapter" class="item_menu">Accueil</a></li>
					<li><a href="#" class="item_menu">Derniers chapitres</a></li>
					<li><a href="#" class="item_menu">Contact</a></li>
					<li><a href="#" class="item_menu">Accès réservé</a></li>
				</ul>
			</div>
													<!-- fin "flottage" du menu -->
		</aside>
			
		<?php

		$asideView=ob_get_clean();
		return $asideView;
	}
}
