<?php

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

Log::useFiles(storage_path().'/logs/laravel.log');

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

App::down(function()
{
	return Response::view('admin.error', array(), 503);
});

Route::get('/sys/down/{code}', function($code){ if ($code == Config::get('app.key')) { Artisan::call('down'); } });

require app_path().'/filters.php';
