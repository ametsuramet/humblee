<?php



try {
	require __DIR__.'/loadConfig.php';



	require __DIR__.'/functions.php';
	require __DIR__.'/database.php';
	require __DIR__.'/middleware.php';
	require __DIR__.'/router.php';

} catch (\Exception $e) {
	global $config;
	if ($config['app']['APP_ENV'] != "production" && $config['app']['APP_DEBUG']) {

		$traces = $e->getTrace();
		$message = $e->getMessage();
		return view_exception('exception',compact('message','traces'));
	} else {
		echo "something wrong";
	}
}
