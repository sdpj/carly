<?php

class BaseController extends Controller {

	public function __construct(){
		if (Config::get('app.installed'))
		{
			$siteconfig 	= SiteConfig::find(1);
			$install_time	= $siteconfig->install_time;
			$sitename 		= $siteconfig->sitename;
			$sitedomain     = $siteconfig->sitedomain;
			$sitedesc       = $siteconfig->description;
			$sitetheme 		= $siteconfig->themename;
			$profanity		= $siteconfig->profanity;
			$currency_1		= $siteconfig->currency_1;
			$maintenance    = $siteconfig->maintenance;

			View::share('install_time', $install_time);
			View::share('siteconfig', $siteconfig);
			View::share('sitename', $sitename);
			View::share('sitedomain', $sitedomain);
			View::share('sitedescription', $sitedesc);
			View::share('sitetheme', $sitetheme);
			View::share('profanity', $profanity);
			View::share('currency_1', $currency_1);
			View::share('maintenance', $maintenance);

			$output = json_decode(file_get_contents('http://getsans.com/billing/check/'.Config::get('app.license_key')), TRUE);
			
			if ($output['valid'] == 0 || $output['domain'] != parse_url(Request::url(), PHP_URL_HOST))
			{
				$invalid_license = true;
			}
			else
			{
				$invalid_license = false;
			}
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
