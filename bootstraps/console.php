<?php
$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();
try {
	require __DIR__.'/loadConfig.php';
	require __DIR__.'/functions.php';
	require __DIR__.'/database.php';

} catch (\Exception $e) {
	print_r($e->getMessage());
}
