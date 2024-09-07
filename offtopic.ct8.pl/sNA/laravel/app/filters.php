<?php

App::before(function($request)
{
	if (Config::get('app.installed'))
	{
		if (substr($request->header('host'), 0, 4) === 'www.') {
		  $request->headers->set('host', SiteConfig::find(1)->sitedomain);
		  return Redirect::to($request->path());
		}

		$siteconfig = SiteConfig::find(1);

		if ($siteconfig->maintenance != "off" && !in_array($_SERVER['REQUEST_URI'], ['/user/login', '/admin/maintenance/recover'])) {
			if ($siteconfig->maintenance == "maintenance") {
				if (!Auth::check() || !Auth::user()->hasRole('Administrator')) {
					return Response::view('503', array(), 503);
				}
	 		} elseif ($siteconfig->maintenance == "emergency_maintenance") {
	 			return Response::view('503', array(), 503);
	 		}
		}

	    if (Auth::check()) {

			if (Ban::where('user_id', '=', Auth::user()->id)->count() != 0)
			{
				if (!in_array($_SERVER['REQUEST_URI'], ['/user/banned', '/user/reactivate', '/user/logout']))
				{
					return Redirect::to('/user/banned');
				}
			} else {

				if (!in_array($_SERVER['REQUEST_URI'], ['/user/welcome', '/user/logout'])) {
					if (Auth::user()->firstlogin == 1) {
						return Redirect::to('/user/welcome');
					}
				}
		        $user 					= Auth::user();
		        $now 				 	= new DateTime();
		        $user->last_activity 	= $now;
		        $user->save();
		        
	    	}
	    }
	}
});


App::after(function($request, $response)
{
	if (Config::get('app.installed'))
	{
		if (Auth::check())
		{
			Auth::user()->processStipend();
		}

		if (Economy::where('created_at', '=', Carbon::today())->count() != 0)
		{
			if (Economy::where('created_at', '=', Carbon::today())->first()->total != User::sum('currency_1'))
			{
				$economy 					= Economy::where('created_at', '=', Carbon::today())->first();
				$economy->total 			= User::sum('currency_1');
				$economy->save();
			}
		} else {
			$new_economy 				= new Economy;
			$new_economy->type 			= 'daily';
			$new_economy->total 		= User::sum('currency_1');
			$new_economy->created_at 	= Carbon::today();
			$new_economy->save();	
		}
	}
});

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('/user/signin');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/user/dashboard');
});

Route::filter('admin', function()
{
	if (!Auth::user()->hasRole('Administrator')) return App::abort(404);
});

Route::filter('active', function()
{
	if (Auth::user()->activated == 0) return Redirect::to('/user/verify')->with('action_denied', 1);
});

Route::filter('install', function()
{
	if (!Config::get('app.installed') && !in_array($_SERVER['REQUEST_URI'], ['/install'])) return Redirect::to('/install');
});

Route::filter('installed', function()
{
	if (Config::get('app.installed')) return Response::view('404', array(), 404);
});


Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

App::missing(function($exception)
{
    return Response::view('404', array(), 404);
});