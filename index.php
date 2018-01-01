<?php
	namespace web_max\ecrivain\lib;
	session_start();
	use web_max\ecrivain\lib\Router;


	require_once("lib\SplClassLoader.php");
	
	$Loader = new \SplClassLoader('web_max\ecrivain\lib', 'lib');
	$Loader->register();

	
	$monRouter = new Router($_REQUEST);
	$monRouter->Router();
