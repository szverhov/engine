<?php

namespace Engine;
use Engine\DI\DI;
use Engine\Helper\Common;

class Application
{
	/**
	 * @var DI
	 */
	private	$_di;
	public	$_router;

	/**
	 * Cms construct.
	 * @param $di
	 */
	public function __construct(DI $di)
	{
		$this->_di = $di;
		$this->_router = $this->_di->get('router');
	}

	/**
	 * Run App.
	 * @param $di
	 */
	public function run()
	{
		echo "<pre>";
		//adding
		$this->_router->add('index', '/', 'IndexController:index');
		$this->_router->add('product', 'user/12', 'ProductController:index');

		/*trying to get object that conteins inforamtion about Controller and Parametrs from REQUEST_URI*/
		$routerDispatch = $this->_router->dispatch(Common::getRequestMethod(), (Common::getUriPath()));
		list($class, $action) = explode(':', $routerDispatch->getControleller(), 2);
		$controller = "\\Front\\Controller\\{$class}";
		call_user_func_array([new $controller($this->_di), $action],$routerDispatch->getParameters());
		// print_r($class);
		echo "</pre>";
	}
}
