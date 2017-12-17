<?php
	namespace web_max\ecrivain\lib;
	session_start();
	use web_max\ecrivain\lib\Router;

	require_once("SplClassLoader.php");
	
	$OCFramLoader = new \SplClassLoader('web_max\ecrivain\lib', 'D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\lib');
	$OCFramLoader->register();
		
	//Config::start();
	
	$monRouter = new Router($_REQUEST);
	$monRouter->Router();