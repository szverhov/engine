<?php

namespace Engine\Core\Database;
use \PDO;

class Connection
{
	private $_link;

	public function __construct()
	{
		$this->connect();
	}

	private function connect()
	{
		$config = require_once 'DBConfig.php';
		try {
			$this->_link = new PDO(
				"mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}",
				$config['username'],
				$config['password']
			);
			$this->_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		return ($this);
	}

	public function execute($sql, array $vars)
	{
		$prep_pdo = $this->_link->prepare($sql);
		return($prep_pdo->execute($vars));
	}

	public function query($sql, array $vars)
	{
		$prep_pdo = $this->_link->prepare($sql);
		$prep_pdo->execute($vars);
		$result = $prep_pdo->fetchAll(PDO::FETCH_ASSOC);
		return ($result === false ? [] : $result);
	}
}
