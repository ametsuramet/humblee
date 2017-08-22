<?php

$dir_config = __DIR__.'/../config/';


$getConfig = [];
foreach (scandir(realpath($dir_config)) as $file) {
	if ($file != ".." && $file != ".") {
		$key = str_replace(".php", "", $file);
		$getConfig[$key] = include $dir_config.$file;
	}
}
$GLOBALS['config'] = $getConfig;
