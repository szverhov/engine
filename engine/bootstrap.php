<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Engine\Application;
use Engine\DI\DI;

try {
	//Dependency injection
	$di = new DI;
	//Getting all names of all included services classes
	$services = require __DIR__ . '/Config/Service.php';
	//Creating all services objects and initing them
	//When object inits, he add him self to di_container
	//which stores services name as $key and its object as $value
	foreach ($services as $service)
	{
		$provider = new $service($di);
		$provider->init();
	}
	$app = new Application($di);
	$app->run();
} catch(\ErrorException $e){
	echo $e->getMessage();
}