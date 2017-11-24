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
        
		<title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
		     
    <body>
		<?= $menuView ?>
		<?= $contentView ?>
		<?= $footerView ?>
    </body>
</html>