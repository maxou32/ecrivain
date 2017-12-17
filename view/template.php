<?php
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\lib\Config;

class template extends view{
	private $title;
	
	public function __construct($menu, $aside, $footer,$content){
		$this->menuView=$menu;
		$this->asideView=$aside;
		$this->footerView=$footer;
		$this->contentView=$content;
		$this->title="";
		
	}
			
	public function show($params,$datas){
		$monConfig= new Config;
		//echo $monConfig->getBackground();
		$this->imageBackGround=$monConfig->getBackground();
	?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8" />
				<!-- Ligne à ajouter si on veut un favicon		-->
				<link rel="icon" type="image/jpeg" href="D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\public\media\icone.png">

				<meta name="description" content="Le récit de mes dernières aventures en Alaska !" />	<!-- description pour les moteurs -->
				<meta name="keywords" content="aventure, Alaska" />										<!-- description des mots clefs -->
				<meta name="robots" content="none"> 													<!-- dire au moteur de passer leur chemin -->
				<meta name="content-language" content="french">											<!-- language du site -->
				<meta name="author" content="Toto le héros">											<!-- nom de l'auteur -->
				<meta name="distribution" content="local"> 												<!-- distribtion locale ou générale -->
				<meta name="rating" content="general">													<!-- public visé tous, averti ou restreint -->
				
				<meta name="robots" content="noindex, nofollow">
				
				<!-- facebook		-->
				<meta property="og:title" content="Alaska, mon périple" />
				<meta property="og:url" content="https://web-max.fr/ecrivain/index.php"/>
				<meta property="og:site_name" content="web-max.fr"/>
				<meta property="og:description" content="Mon périple en Alaska au milieu du PHP entouré de MVC menaçants.">
				<meta property="og:image" content="D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\public\media\icone.png">
				<!-- Twitter  		-->
				<meta name="twitter:card" content="Alaska, mon périple">
				<meta name="twitter:site" content="@Web-max">
				<meta name="twitter:title" content="Web-max">
				<meta name="twitter:description" content="Mon périple en Alaska au milieu du PHP entouré de MVC menaçants.">
				<meta name="twitter:creator" content="@moi_meme">
				<!-- Twitter Summary card images must be at least 120x120px -->
				<meta name="twitter:image" content="D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\public\media\icone.png">
				
				<link href="public/css/style.css" rel="stylesheet" /> 
				<!-- Compiled and minified CSS -->
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
				<!--Import Google Icon Font-->
				<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
				<!--Import materialize.css-->
				<link type="text/css" rel="stylesheet" href="materialize/css/materialize.css"  media="screen,projection"/>

				<!-- Let browser know website is optimized for mobile -->
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<script src="public\js\tinymce\tinymce.min.js"></script>
				<script>tinymce.init({ selector:'textarea' });</script>

			</head>
			<body style="background-image: url('<?= $this->imageBackGround ?>');">	 
				<title><?= $this->title ?></title>
				<?= $this->menuView ?>
				<div id="content" >
					
					<div id="contenuDetail">
						<?= $this->contentView ?>
					</div>
				</div>
				<?= $this->footerView ?>
				
				<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
			    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
			</body>
		</html>
	<?php 
	}
}	