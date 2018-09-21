<?php

namespace Engine\Helper;

class Common
{
	public static function isPost()
	{
		return($_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);
	}

	public static function getRequestMethod()
	{
		return ($_SERVER['REQUEST_METHOD']);
	}

	public static function getUriPath()
	{
		$urlPath = $_SERVER['REQUEST_URI'];

		if ($position = strpos($urlPath, '?'))
		{
			$urlPath = substr($urlPath, 0, $position);
		}
		return ($urlPath);
	}
}