<?php
	namespace web_max\ecrivain\lib;
	session_start();
	use web_max\ecrivain\lib\Router;
	echo "coucou";

	require_once("lib/SplClassLoader.php");
	echo "coucou 1";
	
	$Loader = new \SplClassLoader('web_max\ecrivain\lib', 'lib');
	$Loader->register();
	echo "coucou 2";

	
	$monRouter = new Router($_REQUEST);
	$monRouter->Router();
