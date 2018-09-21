<?php

namespace Front\Controller;

use Engine\AbstractController;
use Engine\DI\DI;

class IndexController extends AbstractController
{
	public function __construct(DI $di)
	{
		parent::__construct($di);
	}

	public function index()
	{
		echo "Index Page";
	}
}