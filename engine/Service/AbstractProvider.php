<?php

namespace Engine\Service;
use Engine\DI\DI;

abstract class AbstractProvider
{
	protected $_di;

	public function __construct(DI $di)
	{
		$this->_di = $di;
	}

	abstract function init();
}
