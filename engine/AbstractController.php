<?php

namespace	Engine;
use			Engine\DI\DI;

abstract class AbstractController
{
	protected $_di;
	protected $_db;

	public function __construct(DI $di)
	{
		$this->_di = $di;
	}
}