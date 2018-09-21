<?php

namespace Engine\Core\Router;
/*Object that contains information about current controller and its parames that we nead to use*/
class DispatchedRoute
{
	private $_controller;
	private $_parameters;

	public function __construct($controller, $parametrs = [])
	{
		// echo "<br>";
		// print_r($controller);
		// echo "</br>";
		$this->_controller = $controller;
		$this->_parameters = $parametrs;
	}

	public function getControleller()
	{
		return ($this->_controller);
	}

	public function getParameters()
	{
		return ($this->_parameters);
	}
}