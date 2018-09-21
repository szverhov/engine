<?php

namespace Engine\Service\Database;

use Engine\Service\AbstractProvider;
use Engine\Core\Database\Connection;

class Provider extends AbstractProvider
{
	public $_serviceName = 'db';

	public function init()
	{
		$db = new Connection();
		$this->_di->set($this->_serviceName, $db);
	}
}
?>