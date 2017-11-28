<?php

// Adresse du serveur de base de données
	define('DB_SERVEUR', 'localhost');

	// Login
	define('DB_LOGIN','root');

	// Mot de passe
	define('DB_PASSWORD','');

	// Nom de la base de données
	define('DB_NOM','ecrivain');

	// Nom de la table du livre d'or
	define('DB_GUESTBOOK_TABLE','guestbook');

	// Driver correspondant à la BDD utilisée
	define('DB_DSN','mysql:host='. DB_SERVEUR .';dbname='. DB_NOM);

	// Nombre de messages à afficher par page
	define('MAX_MESSAGES_PAR_PAGE', 5);

	// URL du livre d'or
	define('URL_GUESTBOOK', 'http:\\127.0.0.1:8000\edsa-test_php\TP_XX\ecrivain');

	// chemin absolu
	define('DIR_ECRIVAIN', 'D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain');
	
	