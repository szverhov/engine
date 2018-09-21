<?php

namespace Engine\Core\Router;

class UrlDispatcher
{
	private $_methods = [
		'GET',
		'POST'
	];

	private $_routes = [
		'GET' => [],
		'POST' => [],
	];

	private $_patterns = [
		'int' => '[0-9]+',
		'str' => '[a-zA-Z\.\-_%]+',
		'all' => '[a-zA-Z0-9\.\-_%]+',
	];

	/*Save to _routes on httpMethod($key)
	* $uriRoute => $controller
	*/
	public function register($httpMethod, $uriRoute, $controller)
	{
		$this->_routes[strtoupper($httpMethod)][$uriRoute] = $controller;
	}

	public function addPattern($key, $pattern)
	{
		$this->_patterns[$key] = $pattern;
	}

	public function findRoutes($httpMethod)
	{
		return (isset($this->_routes[$httpMethod]) ? $this->_routes[$httpMethod] : []);
	}
	/* */
	public function dispatch($httpMethod, $uriRoute)
	{
		/*All paths that represents array of uri => controller*/
		$routes = $this->findRoutes(strtoupper($httpMethod));
		// print_r($uriRoute);
		// echo "<br>____<br>";
		// print_r($routes);
		/*if $uriRoute from arg exist in array returning new DispatchedRouteObj which saves controller name and its args*/
		if (array_key_exists($uriRoute, $routes))
		{
			// echo "string";
			return (new DispatchedRoute($routes[$uriRoute]));
		}
		/*if $uriRoute from arg exist in array returning new DispatchedRouteObj which saves controller name and its args*/
		return ($this->doDispatch($httpMethod, $uriRoute));
	}

	private function doDispatch($httpMethod, $uriRoute)
	{
		foreach ($this->findRoutes(strtoupper($httpMethod)) as $route => $controller)
		{		
			$pattern = '#' . $route . '$#s';
			if (preg_match($pattern, $uriRoute, $parameters))
			{
				// print_r($route);
				return (new DispatchedRoute($controller, $parameters));
			}
		}
	}
}