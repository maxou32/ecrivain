<?php
	//namespace web_max\ecrivain;
	session_start();
	//use web_max\ecrivain\Config; 
	//use web_max\ecrivain\Router;

	include_once ('Config.php');

	Config::start();
	
	$monRouter = new Router($_REQUEST);
	$monRouter->Router();