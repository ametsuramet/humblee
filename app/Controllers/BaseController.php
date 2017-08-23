<?php

namespace App\Controllers;

class BaseController {
	function __construct()
	{
		$GLOBALS['executionStartTime'] = microtime(true);
	}	

	function __destruct()
	{
		$GLOBALS['executionEndTime'] = microtime(true);
	}

}