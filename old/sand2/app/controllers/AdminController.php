<?php

class AdminController extends BaseController {

	protected $layout = 'layouts.master';

	public function ShowDashboard()
	{
		$recent_reg_total = $recent_reg_date = array();
		for ($i = 1; $i <= 7; $i++)
		{
			if ($i == 1)
			{
				$recent_reg_total[$i] 	= User::whereBetween('created_at', array(Carbon::today()->subDays(7)->addDays($i + 5), Carbon::today()))->count();
			} else {
				$recent_reg_total[$i] 	= User::whereBetween('created_at', array(Carbon::today()->subDays(7)->addDays($i), Carbon::today()->subDays(7)->addDays($i + 1)))->count();
			}
				$recent_reg_date[$i] 	= Carbon::today()->subDays(7)->addDays($i);
		}
		$this->layout->title   			= "Admin Dashboard";
		$this->layout->content 			= View::make('admin.dashboard', ['recent_reg_total' => $recent_reg_total, 'recent_reg_date' => $recent_reg_date]);
	}

	public function ShowUsers()
	{
		$users 							= User::paginate(25);
		$this->layout->title   			= "Manage Users";
		$this->layout->content 			= View::make('admin.users', ['users' => $users]);
	}

	public function ShowByEmail($email)
	{
		$users 							= User::where('email', '=', $email)->paginate(25);
		$this->layout->title   			= "Manage Users";
		$this->layout->content 			= View::make('admin.email', ['users' => $users]);
	}

	public function ShowByIP($ip)
	{
		$users 							= User::where('regip', '=', $ip)->paginate(25);
		$this->layout->title   			= "Manage Users";
		$this->layout->content 			= View::make('admin.ip', ['users' => $users]);
	}

	public function ShowEditUser($id)
	{
		$user							= User::findOrFail($id);
		$this->layout->title   			= "Edit User";
		$this->layout->content 			= View::make('admin.edituser', ['user' => $user, 'id' => $id]);
	}

	public function DoChangeUser($id)
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'email'          		=> 'required|email|min:6',
		        'username'				=> 'required|min:3'
		    );
		$messages = array(
		    'same'                      		=> 'Your :attribute must be the same as :other',
		    'min'	         					=> 'Your :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
	        return Redirect::to('/admin/edituser/'.$id.'')
	                ->withErrors($validator->messages());
		}
		else
		{
			$user 				= User::find($id);
			$currentemail    	= $user->email;
			$newemail 		 	= Input::get('email');
			$currentusername    = $user->username;
			$newusername 		= Input::get('username');

			if ($currentemail == $newemail){
				$username 				= Input::get('username');
				$username 				= User::where('username', '=', $username)->take(1)->get();
				if (count($username) == 0) {
					$user 					= User::find($id);
					$user->username 		= Input::get('username');
					$user->save();
					return Redirect::to('/admin/edituser/'.$id.'')->with('success', 1);
				} else {
	        		return Redirect::to('/admin/edituser/'.$id.'')
	                	->withErrors('That username is taken by another user! :(');
				}
			} elseif ($currentusername == $newusername) {
				$user 					= User::find($id);
				$user->email 			= Input::get('email');
				$user->save();
				return Redirect::to('/admin/edituser/'.$id.'')->with('success', 1);
			} else {
				$username 				= Input::get('username');
				$username 				= User::where('username', '=', $username)->take(1)->get();
				if (count($username) == 0) {
					$user 					= User::find($id);
					$user->email 			= Input::get('email');
					$user->username 		= Input::get('username');
					$user->save();
					return Redirect::to('/admin/edituser/'.$id.'')->with('success', 1);
				} else {
	        		return Redirect::to('/admin/edituser/'.$id.'')
	                	->withErrors('That username is taken by another user! :(');
				}
			}
		}
	}

	public function DoSearchUser()
	{
		$input_username 				= Input::get('username');

		return Redirect::to('/admin/users/search/'.$input_username.'');
	}

	public function ShowSearchUser($username)
	{
		$users 							= User::where('username', 'LIKE', '%'.$username.'%')->paginate(25);
		$this->layout->title   			= "Manage Users";
		$this->layout->content 			= View::make('admin.users', ['users' => $users]);
	}

	public function ShowSearchUser_Empty()
	{
		if (empty($username)){
			return Redirect::to('/admin/users')->withErrors('Make sure you enter a username!');
		}
	}

	public function ShowLogging()
	{
		$logs							= Logging::orderBy('ID', 'DESC')->paginate(25);

		$this->layout->title   			= "Logging";
		$this->layout->content 			= View::make('admin.logging', ['logs' => $logs]);		
	}

	public function DeleteThread($id)
	{
		$thread 			= ForumThr::find($id);
		$topic 				= $thread->topic;
		$threadid			= $id;
		$thread->timestamps = false;
		$thread->delete();

		return Redirect::to('/forum/topic/'.$topic.'')->with('threadid', $threadid)->with('delete-success', 1);
	}

	public function RestoreThread($id)
	{
		$thread 			= ForumThr::withTrashed()->find($id);
		$topic 				= $thread->topic;
		$thread->timestamps = false;
		$thread->restore();

		return Redirect::to('/forum/thread/'.$id.'')->with('restore-success', 1);
	}

	public function LockThread($id)
	{
		$thread 			= ForumThr::find($id);
		$thread->locked 	= 1;
		$thread->timestamps = false;
		$thread->save();

		return Redirect::to('/forum/thread/'.$id.'')->with('lock-success', 1);
	}

	public function UnlockThread($id)
	{
		$thread 			= ForumThr::find($id);
		$thread->locked 	= 0;
		$thread->timestamps = false;
		$thread->save();

		return Redirect::to('/forum/thread/'.$id.'')->with('unlock-success', 1);
	}

	public function StickyThread($id)
	{
		$thread 			= ForumThr::find($id);
		$thread->sticky 	= 1;
		$thread->timestamps = false;
		$thread->save();

		return Redirect::to('/forum/thread/'.$id.'')->with('sticky-success', 1);
	}

	public function UnstickyThread($id)
	{
		$thread 			= ForumThr::find($id);
		$thread->sticky 	= 0;
		$thread->timestamps = false;
		$thread->save();

		return Redirect::to('/forum/thread/'.$id.'')->with('unsticky-success', 1);
	}

	public function MoveThread($id)
	{
		$newtopic 			= Input::get('topic');
		$thread 			= ForumThr::find($id);
		$thread->timestamps = false;
		$thread->topic 		= $newtopic;
		$thread->save();

		return Redirect::to('/forum/thread/'.$id.'')->with('move-thread-success', 1);
	}

	public function DeletePost($id)
	{
		$post 				= ForumPos::find($id);
		$thread 			= $post->thread;
		$post->timestamps 	= false;
		$post->delete();

		return Redirect::to('/forum/thread/'.$thread.'')->with('delete-success', 1);	
	}

	public function ScrubPost($id)
	{
		$post 					= ForumPos::find($id);
		$thread 				= $post->thread;
		$post->scrubbed_body 	= $post->body;
		$post->body 			= "[This post has been scrubbed]";
		$post->save();

		return Redirect::to('/forum/thread/'.$thread.'')->with('scrub-success', 1);
	}

	public function UnscrubPost($id)
	{
		$post 					= ForumPos::find($id);
		$thread 				= $post->thread;
		$post->body 			= $post->scrubbed_body;
		$post->scrubbed_body 	= NULL;
		$post->save();

		return Redirect::to('/forum/thread/'.$thread.'')->with('unscrub-success', 1);
	}

	public function EditPost($id)
	{
		$post 							= ForumPos::find($id);
		$this->layout->title   			= "Edit Post";
		$this->layout->content 			= View::make('forum.editpost', ['post' => $post]);
	}

	public function DoEditPost($id)
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'body'             		=> 'required|min:15'
		    );
		$messages = array(
		    'required'                  => 'You must enter a :attribute for your thread!',
		    'min'	         			=> 'Your :attribute must be at least :min characters long'
		);

		$validator 	= Validator::make($data, $rule, $messages);


		if ($validator->fails()){
		        return Redirect::to('/forum/thread/'.$id.'/new')
		                ->withErrors($validator->messages())->withInput(Input::except(array('_token')));
		}
			$post 					= ForumPos::find($id);
			$post->old_body			= $post->body;
			$post->body 			= Input::get('body');
			$post->post_editor 		= Auth::user()->id;
			$post->save();

			return Redirect::to('/forum/thread/'.$post->thread.'');
	}

	public function ShowAlerts()
	{
		$alerts 						= Alert::all();

		$this->layout->title   			= "Alerts";
		$this->layout->content 			= View::make('admin.alerts', ['alerts' => $alerts]);		
	}

	public function ShowNewAlert()
	{
		$this->layout->title   			= "New Alert";
		$this->layout->content 			= View::make('admin.alerts');
	}

	public function DoNewAlert()
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'text'  				=> 'required|min:1',
		        'type'			   		=> 'required|in:normal,success,warning,danger'
		);
		$messages = array(
		    	'min'	         		=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/alerts/new')
		                ->withErrors($validator->messages());
		} else {
				$new_alert 				= new Alert;
				$new_alert->user_id		= Auth::user()->id;
				$new_alert->type 		= Input::get('type');
				$new_alert->text        = Input::get('text');
				$new_alert->save();

				return Redirect::to('/admin/alerts')->with('success', 1);
		}
	}

	public function ShowEditAlert($id)
	{
		$alert = Alert::find($id);

		$this->layout->title   			= "Edit Alert";
		$this->layout->content 			= View::make('admin.alerts', ['alert' => $alert]);
	}

	public function DoEditAlert($id)
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'text'  				=> 'required|min:1',
		        'type'			   		=> 'required|in:normal,success,warning,danger'
		);
		$messages = array(
		    	'min'	         		=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/alerts/'.$id.'/edit')
		                ->withErrors($validator->messages());
		} else {
				$alert 				= Alert::find($id);
				$alert->user_id		= Auth::user()->id;
				$alert->type 		= Input::get('type');
				$alert->text        = Input::get('text');
				$alert->save();

				return Redirect::to('/admin/alerts')->with('success', 1);
		}
	}

	public function DoDeleteAlert($id)
	{
		$alert = Alert::find($id);
		$alert->delete();

		return Redirect::to('/admin/alerts')->with('alert-deleted', 1);
	}

	public function ShowBadges()
	{
		$badges 						= BadgeType::orderBy('id', 'DESC')->get();

		$this->layout->title   			= "Badges";
		$this->layout->content 			= View::make('admin.badges', ['badges' => $badges]);
	}

	public function ShowNewBadge()
	{
		$this->layout->title   			= "New Badge";
		$this->layout->content 			= View::make('admin.badges');
	}

	public function DoNewBadge()
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
				'image'          		=> 'required|image',
		        'name'  				=> 'required|min:1',
		        'description'	   		=> 'required|min:1'
		);
		$messages = array(
				'image.image'    		=> 'You must upload an image!',
		    	'min'	         		=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/badges/new')
		                ->withErrors($validator->messages());
		} elseif (Image::make(Input::file('image'))->width() != 128 || Image::make(Input::file('image'))->height() != 128) {
			return Redirect::to('/admin/badges/new')->with('dimension_error', 1);
		} elseif (Image::make(Input::file('image'))->mime() != 'image/png') {
			return Redirect::to('/admin/badges/new')->with('mime_error', 1);
		} else {
				$file 					= Input::file('image');

			    $destinationPath    	= 'user_img/badges/';
			    $extension          	= $file->getClientOriginalExtension();
			    $rand					= str_random();
			    $filename           	= 'usr_'.  Auth::user()->id . '_str=' . $rand . '_file='. md5($file->getClientOriginalName()) .'.'. $extension;
			    $upload_success     	= $file->move($destinationPath, $filename);

				$new_badge 				= new BadgeType;
				$new_badge->name 		= Input::get('name');
				$new_badge->description = Input::get('description');
				$new_badge->filename 	= $filename;
				$new_badge->save();

				return Redirect::to('/admin/badges')->with('success', 1);
		}	
	}

	public function ShowEditBadge($id)
	{
		if (!BadgeType::find($id)){
			App::abort(404);
		}

		$badge 							= BadgeType::find($id);

		$this->layout->title   			= "Edit Badge";
		$this->layout->content 			= View::make('admin.badges', ['badge' => $badge]);
	}

	public function DoEditBadge($id)
	{
		if (!BadgeType::find($id)){
			App::abort(404);
		}

		$data =  Input::except(array('_token'));
		$rule  =  array(
				'image'          		=> 'image',
		        'name'  				=> 'required|min:1',
		        'description'	   		=> 'required|min:1'
		);
		$messages = array(
				'image.image'    		=> 'You must upload an image!',
		    	'min'	         		=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/badges/'.$id.'/edit')
		                ->withErrors($validator->messages());
		} else {
				if (Input::file('image')) {
					if (Image::make(Input::file('image'))->width() != 128 || Image::make(Input::file('image'))->height() != 128) {
						return Redirect::to('/admin/badges/'.$id.'/edit')->with('dimension_error', 1);
					} elseif (Image::make(Input::file('image'))->mime() != 'image/png') {
						return Redirect::to('/admin/badges/'.$id.'/edit')->with('mime_error', 1);
					}
				}

				$badge 						= BadgeType::find($id);

				if (Input::file('image')) {
					$file 					= Input::file('image');

				    $destinationPath    	= 'user_img/badges/';
				    $extension          	= $file->getClientOriginalExtension();
				    $rand					= str_random();
				    $filename           	= 'usr_'.  Auth::user()->id . '_str=' . $rand . '_file='. md5($file->getClientOriginalName()) .'.'. $extension;
				    $upload_success     	= $file->move($destinationPath, $filename);
				    $badge->filename 	= $filename;
				}

				$badge->name 			= Input::get('name');
				$badge->description 	= Input::get('description');
				$badge->save();

				return Redirect::to('/admin/badges')->with('success', 1);
		}	
	}

	public function DoDeleteBadge($id)
	{
		if (!BadgeType::find($id)){
			App::abort(404);
		}

		$badge = BadgeType::find($id);
		$badge->delete();

		return Redirect::to('/admin/badges')->with('success', 1);
	}

	public function ShowAssignBadge($id)
	{
		if (!User::find($id)){
			App::abort(404);
		}

		$badges 						= BadgeType::all();
		$badge_types 					= array();

		foreach($badges as $type) {
		    $badge_types[$type->id] = $type->name;
		}

		$user 							= User::find($id);

		$this->layout->title   			= "Assign Badge";
		$this->layout->content 			= View::make('admin.badges', ['badge_types' => $badge_types, 'user' => $user]);
	}

	public function DoAssignBadge($id)
	{
		if (!User::find($id)){
			App::abort(404);
		}

		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'type'			   		=> 'required|integer'
		);
		$messages = array(
		    	'min'	         		=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/badges/assign/'.$id)
		                ->withErrors($validator->messages());
		} else {
				$badge_user 				= new BadgeUser;
				$badge_user->user_id		= $id;
				$badge_user->badge_id 		= Input::get('type');
				$badge_user->save();

				return Redirect::to('/user/profile/'.$id)->with('success', 1);
		}

	}

	public function ShowEconomy()
	{
		$users 								= User::orderBy('currency_1', 'DESC')->get();
		$top15_username = $top15_currency 	= array();
		$top15_username_2 = $top15_currency_2 	= array();
		$i 									= 1;
		foreach ($users as $user)
		{
			$top15_username[$i] = $user->username;
			$top15_currency[$i] = $user->currency_1;
			$i++;
		}
		$i 									= 1;
		foreach ($users as $user)
		{
			if ($user->hasRole('Administrator') || $user->hasRole('Moderator') || $user->hasRole('Designer'))
			{
				continue;
			}
			$top15_username_2[$i] = $user->username;
			$top15_currency_2[$i] = $user->currency_1;
			$i++;
		}

		$economy_raw						= Economy::where('type', '=', 'daily')->take(7)->get();
		$economy_total = $economy_date 		= array();
		$i 									= 1;
		foreach ($economy_raw as $econ)
		{
			$economy_total[$i] 				= $econ->total;
			$economy_date[$i] 				= $econ->updated_at;
			$i++;
		}

		$this->layout->title   				= "Economy";
		$this->layout->content 				= View::make('admin.economy', ['economy_total' => $economy_total, 'economy_date' => $economy_date, 'top15_username' => $top15_username, 'top15_currency' => $top15_currency, 'top15_username_2' => $top15_username_2, 'top15_currency_2' => $top15_currency_2]);
	}

	public function ShowBan($id)
	{
		if (!User::find($id))
		{
			App::abort(404);
		}

		$user 							= User::find($id);

		$this->layout->title   			= "Ban User";
		$this->layout->content 			= View::make('admin.ban', ['user' => $user]);		
	}

	public function DoBan($id)
	{
		if (!User::find($id)){
			App::abort(404);
		}

		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'length'			   		=> 'required|in:warning,1_day,3_day,7_day,14_day,1_month,permanent',
		        'reason' 					=> 'required|min:1'
		);
		$messages = array(
		    	'min'	         			=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/ban/'.$id)
		                ->withErrors($validator->messages());
		} else {
				$ban_user 					= new Ban;
				$ban_user->user_id			= $id;
				$ban_user->staff_id			= Auth::user()->id;
				$ban_user->length 			= Input::get('length');
				$ban_user->reason 			= Input::get('reason');
				switch ($ban_user->length){
					case "warning": 	$ban_user->expiry = Carbon::now(); 					break;
					case "1_day": 		$ban_user->expiry = Carbon::now()->addDay(); 		break;
					case "3_day": 		$ban_user->expiry = Carbon::now()->addDays(3); 		break;
					case "7_day": 		$ban_user->expiry = Carbon::now()->addDays(7); 		break;
					case "14_day": 		$ban_user->expiry = Carbon::now()->addDays(14); 	break;
					case "1_month": 	$ban_user->expiry = Carbon::now()->addMonth(); 		break;
					case "permanent": 	$ban_user->expiry = Carbon::now()->addYears(10); 	break;
				}
				$ban_user->save();

				return Redirect::to('/user/profile/'.$id)->with('banned', 1);
		}		
	}

	public function DoUnban($id)
	{
		if (!User::find($id)){
			App::abort(404);
		}

		$ban = Ban::where('user_id', '=', $id);	
		$ban->delete();

		return Redirect::to('/user/profile/'.$id)->with('unbanned', 1);	
	}

	public function ShowConfig()
	{
		$this->layout->title   			= "Configuration";
		$this->layout->content 			= View::make('admin.config');			
	}

	public function DoConfig()
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'sitename'  			=> 'required|min:1',
		        'description'			=> 'required|min:1',
		        'currency_1'  			=> 'required|min:1',
		        'sitedomain'			=> 'required|min:5|regex:/^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/'
		);
		$messages = array(
		    	'min'	         		=> 'The :attribute must be at least :min characters long',
		    	'sitedomain.regex'	   	=> 'You must enter a valid domain name'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/config')
		                ->withErrors($validator->messages());
		} else {
				$config 				= SiteConfig::find(1);
				$config->sitename		= Input::get('sitename');
				$config->description	= Input::get('description');
				$config->sitedomain		= Input::get('sitedomain');
				$config->currency_1		= Input::get('currency_1');
				$config->save();

				return Redirect::to('/admin/config')->with('success', 1);
		}
	}

	public function ShowAssignRole($id)
	{
		if (!User::find($id)){
			App::abort(404);
		}

		$roles 							= Role::all();
		$role_types 					= array();

		foreach($roles as $role) {
		    $role_types[$role->id] = $role->name;
		}

		$badges 						= BadgeType::all();
		$badge_types 					= array();

		foreach($badges as $type) {
		    $badge_types[$type->id] = $type->name;
		}

		$user 							= User::find($id);

		$this->layout->title   			= "Assign Role";
		$this->layout->content 			= View::make('admin.roles', ['role_types' => $role_types, 'badge_types' => $badge_types, 'user' => $user]);
	}

	public function DoAssignRole($id)
	{
		if (!User::find($id)){
			App::abort(404);
		}

		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'type'			   		=> 'required|integer'
		);
		$messages = array(
		    	'min'	         		=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/roles/assign/'.$id)
		                ->withErrors($validator->messages());
		} else {

				$user 						= User::find($id);
				$user->attachRoles(Role::find(Input::get('type')));
				$user->save();

				$badge_user 				= new BadgeUser;
				$badge_user->user_id		= $id;
				$badge_user->badge_id 		= Input::get('badge_type');
				$badge_user->save();

				return Redirect::to('/user/profile/'.$id)->with('success', 1);
		}

	}

	public function ShowRemoveRole($id)
	{
		if (!User::find($id)){
			App::abort(404);
		}

		$roles 							= UserRole::where('user_id', '=', $id)->get();
		$role_types 					= array();

		foreach($roles as $role) {
		    $role_types[$role->id] = Role::find($role->role_id)->name;
		}

		$user 							= User::find($id);

		$this->layout->title   			= "Remove Role";
		$this->layout->content 			= View::make('admin.roles', ['role_types' => $role_types, 'user' => $user]);
	}

	public function DoRemoveRole($id)
	{
		if (!User::find($id)){
			App::abort(404);
		}

		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'type'			   		=> 'required|integer'
		);
		$messages = array(
		    	'min'	         		=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/roles/remove/'.$id)
		                ->withErrors($validator->messages());
		} else {

				$user 						= User::find($id);
				$user->detachRoles(Role::find(Input::get('type')));
				$user->save();

				return Redirect::to('/user/profile/'.$id)->with('success', 1);
		}
	}

	public function ShowRemoveBadge($id)
	{
		if (!User::find($id)){
			App::abort(404);
		}

		$badges 						= BadgeUser::where('user_id', '=', $id)->get();
		$badge_types 					= array();

		foreach($badges as $badge) {
		    $badge_types[$badge->id] 	= BadgeType::find($badge->badge_id)->name;
		}

		$user 							= User::find($id);

		$this->layout->title   			= "Remove Badge";
		$this->layout->content 			= View::make('admin.badges', ['badge_types' => $badge_types, 'user' => $user]);
	}

	public function DoRemoveBadge($id)
	{
		if (!User::find($id)){
			App::abort(404);
		}

		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'type'			   		=> 'required|integer'
		);
		$messages = array(
		    	'min'	         		=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/roles/remove/'.$id)
		                ->withErrors($validator->messages());
		} else {

				$badge = BadgeUser::find(Input::get('type'));
				$badge->delete();

				return Redirect::to('/user/profile/'.$id)->with('success', 1);
		}
	}

	public function ShowMaintenance()
	{
		$this->layout->title   			= "Maintenance";
		$this->layout->content 			= View::make('admin.maintenance');
	}

	public function DoMaintenance()
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'type'			   		=> 'required|in:maintenance,emergency_maintenance',
		        'key'			   		=> 'required|min:1'
		);
		$messages = array(
		    	'min'	         		=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/maintenance')
		                ->withErrors($validator->messages());
		} else {

				$config = SiteConfig::find(1);
				$config->maintenance = Input::get('type');
				$config->recovery_key = Hash::make(Input::get('key'));
				$config->save();

				return Redirect::to('/admin/dashboard')->with('success', 1);
		}
	}

	public function ShowRecover()
	{
		$this->layout->title   			= "Recover Website";
		$this->layout->content 			= View::make('admin.maintenance');
	}

	public function DoRecover()
	{
		$data =  Input::except(array('_token'));
		$rule  =  array(
		        'key'			   		=> 'required|min:1'
		);
		$messages = array(
		    	'min'	         		=> 'The :attribute must be at least :min characters long'
		);

		$validator = Validator::make($data, $rule, $messages);

		$config = SiteConfig::find(1);

		if ($validator->fails())
		{
		        return Redirect::to('/admin/maintenance/recover')
		                ->withErrors($validator->messages());
		} elseif (!Hash::check(Input::get('key'), $config->recovery_key)) {
			return Redirect::to('/admin/maintenance/recover')->with('key_fail', 1);
		} else {

				$config->maintenance = "off";
				$config->save();

				return Redirect::to('/admin/dashboard')->with('success', 1);
		}
	}

}