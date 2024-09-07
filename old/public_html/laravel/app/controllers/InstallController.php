<?php

class InstallController extends BaseController {

	protected $layout = 'layouts.install';

	public function ShowWelcome()
	{
		$this->layout->title   			= "Welcome";
		$this->layout->content 			= View::make('install.home');
	}

	public function getDomain()
	{
	    $domain = parse_url(Request::url(), PHP_URL_HOST);

	    if (substr($domain, 0, 4) == "www.")
	    {
	        $domain = substr($domain, 4);
	    }

	    return $domain;
	}

	public function DoWelcome()
	{
		$data 		=  Input::except(array('_token'));
		$rule  		=  array(
	        'license-key'			=> 'required|regex:/([A-Za-z0-9]{5})-([A-Za-z0-9]{5})-([A-Za-z0-9]{5})-([A-Za-z0-9]{5})-([A-Za-z0-9]{5})/'
		);
		$messages 	= array(
			'license-key.required'  => 'Something went wrong in Cracking',
	    	'license-key.regex'	    => 'Something went wrong in Cracking'
		);

		$validator 	= Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
	        if (Input::get('license-key') == 'deez')
			{
				return Redirect::to('/install')->with('invalid', 1);
			}
			else
			{
				Config::write("app.license_key", strtoupper(Input::get('license-key')));
				return Redirect::to('/install/step2');
			}
			
		} else {

			//$output = file_get_contents('http://getsans.com/billing/check/'.Input::get('license-key'));
			//$output = json_decode($output, TRUE);

			if (Input::get('license-key') == 'deez')
			{
				return Redirect::to('/install')->with('invalid', 1);
			}
			else
			{
				Config::write("app.license_key", strtoupper(Input::get('license-key')));
				return Redirect::to('/install/step2');
			}
		}
	}

	public function ShowStep2()
	{
		$this->layout->title   			= "Step 2";
		$this->layout->content 			= View::make('install.step2');
	}

	public function DoStep2()
	{
		$data 		=  Input::except(array('_token'));
		$rule  		=  array(
	        'db-host'				=> 'required',
	        'db-user'				=> 'required',
	        'db-pass'				=> '',
	        'db-name'				=> 'required'
		);

		$validator 	= Validator::make($data, $rule);

		if ($validator->fails())
		{
	        return Redirect::to('/install/step2')
	                ->with('error', 1);
		} else {

			try
			{
				$dbh = new PDO('mysql:host='.Input::get('db-host').';dbname='.Input::get('db-name'), Input::get('db-user'), Input::get('db-pass'), array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			}
			catch(PDOException $ex)
			{
				return Redirect::to('/install/step2')->with('conn-fail', 1);
			}

			Config::write("database.connections.mysql.host", Input::get('db-host'));
			Config::write("database.connections.mysql.username", Input::get('db-user'));
			Config::write("database.connections.mysql.password", Input::get('db-pass'));
			Config::write("database.connections.mysql.database", Input::get('db-name'));

			$random = str_random(32);

			while (str_contains($random, '#') || str_contains($random, '/') || str_contains($random, '\\')) {
				$random = str_random(32);
			}

			Config::write('app.key', $random);

			return Redirect::to('/install/installing');
		}
	}

	public function ShowInstalling()
	{
		$this->layout->title   			= "Installing";
		$this->layout->content 			= View::make('install.installing');
	}

	public function ShowStep3()
	{
		DB::unprepared(File::get('database.sql'));

		$this->layout->title   			= "Step 3";
		$this->layout->content 			= View::make('install.step3');
	}

	public function DoStep3()
	{

		$data 		=  Input::except(array('_token'));
		$rule  		=  array(
	        'sitename'				=> 'required',
	        'sitedesc'				=> 'required',
	        'currency_1'			=> 'required'
		);

		$messages 	= array(
			'sitename.required'  	=> 'You must enter a site name',
	    	'sitedesc.required'	    => 'You must enter a description for your website',
	    	'currency_1.required'   => 'You must enter a currency name'
		);

		$validator 	= Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
	        return Redirect::to('/install/step3')
	                ->withErrors($validator->messages());
		}
		else
		{
			$config = SiteConfig::find(1);
			$config->sitename = Input::get('sitename');
			$config->description = Input::get('sitedesc');
			$config->currency_1 = Input::get('currency_1');
			$config->sitedomain = $this->getDomain();
			$config->avatarwidth	= "170";
			$config->avatarheight	= "300";
			$config->install_time = Carbon::now();
			$config->save();

			Config::write('mail.from.address', 'noreply@'.$this->getDomain());
			Config::write('mail.from.name', Input::get('sitename'));

			return Redirect::to('/install/step4');
		}
	}

	public function ShowStep4()
	{
		$this->layout->title   			= "Step 4";
		$this->layout->content 			= View::make('install.step4');
	}

	public function DoStep4()
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'username'          => 'required|alpha_num|unique:users|min:3',
		        'email'             => 'required|email',
		        'password'          => 'required|min:4|same:password_confirm',
		        'password_confirm'  => 'required|min:4'
		    );
		$messages = array(
		    'email.email'    			=> 'Your E-Mail address must be valid',
		    'email.unique' 				=> 'That E-Mail address has already been taken. Sorry!',
		    'email.required' 			=> 'We need to know your E-Mail address!',
		    'password.required' 		=> 'A Password is helpful for securing your account ;)',
		    'password_confirm.required' => 'You must confirm your password',
		    'password_confirm.min' 		=> 'Your Password confirmation must be at least :min characters long',
		    'same'                      => 'Your :attribute must be the same as :other',
		    'min'	         			=> 'Your :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		$ip = $_SERVER['REMOTE_ADDR'];

		$verify_token = str_random(64);

		if ($validator->fails())
		{
		        return Redirect::to('/install/step4')
		                ->withErrors($validator->messages());
		}
		else
		{
				$new_user 				= new User;
				$new_user->username 	= Input::get('username');
				$new_user->password 	= Hash::make(Input::get('password'));
				$new_user->email 		= Input::get('email');
				$new_user->gender 		= NULL;
				$new_user->race 		= NULL;
				$new_user->regip 		= $ip;
				$new_user->verify_token	= $verify_token;
				$new_user->save();

				$new_slot 				= new Slot;
				$new_slot->user_id 		= $new_user->id;
				$new_slot->save();

				Auth::login($new_user);

				return Redirect::to('/install/complete');
		}
	}

	public function ShowComplete()
	{
		$this->layout->title   			= "Complete";
		$this->layout->content 			= View::make('install.complete');
	}

	public function DoFinish()
	{
		Config::write('app.installed', true);

		return Redirect::to('/user/dashboard');
	}

}