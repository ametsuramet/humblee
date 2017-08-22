<?php

$dir_config = __DIR__.'/../config/';


$getConfig = [];
foreach (scandir(realpath($dir_config)) as $key => $file) {
	if ($file != ".." && $file != ".") {
		$getConfig[rtrim($file,'.php')] = include $dir_config.$file;
	}
}
$GLOBALS['config'] = $getConfig;
