<?php

class BaseController extends Controller {

	public function __construct(){
		if (Config::get('app.installed'))
		{
			$siteconfig 	= SiteConfig::find(1);
			$install_time	= $siteconfig->install_time;
			$sitename 		= $siteconfig->sitename;
			$userstore 		= $siteconfig->userstore;
			$avatarwidth 	= $siteconfig->avatarwidth;
			$avatarheight 	= $siteconfig->avatarheight;
			$sitedomain     = $siteconfig->sitedomain;
			$sitedesc       = $siteconfig->description;
			$sitetheme 		= $siteconfig->themename;
			$profanity		= $siteconfig->profanity;
			$currency_1		= $siteconfig->currency_1;
			$maintenance    = $siteconfig->maintenance;

			View::share('install_time', $install_time);
			View::share('siteconfig', $siteconfig);
			View::share('sitename', $sitename);
			View::share('userstore', $userstore);
			View::share('avatarwidth', $avatarwidth);
			View::share('avatarheight', $avatarheight);
			View::share('sitedomain', $sitedomain);
			View::share('sitedescription', $sitedesc);
			View::share('sitetheme', $sitetheme);
			View::share('profanity', $profanity);
			View::share('currency_1', $currency_1);
			View::share('maintenance', $maintenance);

			// crack!!!
			$invalid_license = false;

			View::share('invalid_license', $invalid_license);
		}
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
