<?php

namespace Engine\Core\Router;

class Router
{
	/*Paths*/
	private $_routes = [];
	/*Root*/
	private $_host;
	/*UrlDispatcher object*/
	private $_dispatcher;

	/*In construct we saving host name of the current Router*/
	public function __construct($host)
	{
		$this->_host = $host;
	}
	/*Saving new available page name (to array _routes as $key) that represents array of url path to some contorller*/
	public function add($pageName, $uriRoute, $controller, $httpMethod = 'GET')
	{
		$this->_routes[$pageName] = [
			'uriRoute'		=> $uriRoute,
			'controller'	=> $controller,
			'httpMethod'	=> $httpMethod,
		];
	}
	/*In this function we returning result of function dispatch use to UrlDispatcher function*/
	public function dispatch($httpMethod, $uri)
	{
		return ($this->getDispatcher()->dispatch($httpMethod, $uri));
	}
	/*In this function we initiating and returning UrlDispatcher object.
	* Its some kind of singletone but only for current object
	* Whe we create new UrlDispatcher we registering all routes from RouterObj->_routes to UrlDispatcherObj->_routes
	*/
	public function getDispatcher()
	{

		if ($this->_dispatcher == null)
		{
			$this->_dispatcher = new UrlDispatcher();

			foreach ($this->_routes as $route) {
				$this->_dispatcher->register($route['httpMethod'], $route['uriRoute'], $route['controller']);
			}
		}
		return ($this->_dispatcher);
	}
}