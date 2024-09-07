<?php

Route::group(array('prefix' => '/install'), function()
{
	Route::get('/', ['uses'=>'InstallController@ShowWelcome']);
	Route::post('/', ['uses'=>'InstallController@DoWelcome']);
	Route::get('/step2', ['uses'=>'InstallController@ShowStep2']);
	Route::post('/step2', ['uses'=>'InstallController@DoStep2']);
	Route::get('/installing', ['uses'=>'InstallController@ShowInstalling']);
	Route::get('/step3', ['uses'=>'InstallController@ShowStep3']);
	Route::post('/step3', ['uses'=>'InstallController@DoStep3']);
	Route::get('/step4', ['uses'=>'InstallController@ShowStep4']);
	Route::post('/step4', ['uses'=>'InstallController@DoStep4']);
	Route::get('/complete', ['uses'=>'InstallController@ShowComplete']);
	Route::get('/finish', ['uses'=>'InstallController@DoFinish']);
});

Route::group(array('before' => 'install'), function()
{
	Route::get('/', ['before'=>'guest','uses'=>'UserController@ShowHome']);

	Route::group(array('prefix' => '/user'), function()
	{
		Route::get('register', ['before'=>'guest','uses'=>'UserController@ShowRegister']);
		Route::post('register', ['before'=>'guest','uses'=>'UserController@DoRegister']);
		Route::get('signin', ['before'=>'guest','uses'=>'UserController@ShowLogin']);
		Route::post('signin', ['before'=>'guest','uses'=>'UserController@DoLogin']);
		Route::get('logout', ['before'=>'auth','uses'=>'UserController@DoLogout']);

		Route::get('forgotpassword', ['before'=>'guest','uses'=>'RemindersController@ShowRemind']);
		Route::post('forgotpassword', ['before'=>'guest','uses'=>'RemindersController@DoRemind']);
		Route::get('resetpassword/{token}', ['before'=>'guest','uses'=>'RemindersController@getReset']);
		Route::post('resetpassword', ['before'=>'guest','uses'=>'RemindersController@postReset']);

		Route::get('welcome', ['before'=>'auth','uses'=>'UserController@ShowWelcome']);
		Route::post('welcome', ['before'=>'auth','uses'=>'UserController@DoWelcome']);
		Route::get('dashboard', ['before'=>'auth','uses'=>'UserController@ShowDashboard']);
		Route::get('settings', ['before'=>'auth','uses'=>'UserController@ShowSettings']);
		Route::post('changeemail', ['before'=>'auth','uses'=>'UserController@DoEmailChange']);
		Route::post('changepassword', ['before'=>'auth','uses'=>'UserController@DoPasswordChange']);
		Route::post('changetimezone', ['before'=>'auth','uses'=>'UserController@DoChangeTimezone']);
		Route::post('changesignature', ['before'=>'auth','uses'=>'UserController@DoChangeSignature']);
		Route::get('verify', ['before'=>'auth','uses'=>'UserController@ShowVerify']);
		Route::get('verify/resend', ['before'=>'auth','uses'=>'UserController@ResendVerify']);
		Route::get('verify/{token}', ['before'=>'auth', 'uses'=>'UserController@DoVerify']);

		Route::get('members', ['uses'=>'UserController@ShowMembers']);
		Route::post('members', ['uses'=>'UserController@DoSearchMembers']);
		Route::get('members/search/{username}', ['uses'=>'UserController@ShowSearchMembers']);
		Route::get('members/search', ['uses'=>'UserController@ShowSearchMembers_Empty']);
		Route::get('members/online', ['uses'=>'UserController@ShowOnlineMembers']);

		Route::get('profile/{id}', 'UserController@ShowProfile')->where('id','[0-9]+');

		Route::get('avatar/{id}', 'UserController@ShowAvatar')->where('id','[0-9]+');

		Route::get('banned', ['before'=>'auth','uses'=>'UserController@ShowBanned']);
		Route::get('reactivate', ['before'=>'auth','uses'=>'UserController@ShowReactivate']);

		Route::get('economy', ['before'=>'auth|active','uses'=>'UserController@ShowEconomy']);
		Route::get('inventory', ['before'=>'auth|active','uses'=>'UserController@ShowInventory']);
		Route::get('inventory/slot/{id}', ['before'=>'auth|active','uses'=>'UserController@ShowSlot'])->where('id','[0-8]{1}');
		Route::get('inventory/slot/{id}/choose/{item_id}', ['before'=>'auth|active','uses'=>'UserController@ChooseSlot'])->where('id','[0-8]{1}')->where('item_id','[0-9]+');
		Route::get('inventory/slot/{id}/clear', ['before'=>'auth|active','uses'=>'UserController@ClearSlot'])->where('id','[0-8]{1}');

		Route::post('sendmessage', ['before'=>'auth|active','uses'=>'UserController@SendMessage']);
		Route::post('fetchmessages', ['before'=>'auth','uses'=>'UserController@FetchMessages']);
		Route::post('formatmessages', ['before'=>'auth','uses'=>'UserController@FormatMessages']);

		Route::get('notifications', ['before'=>'auth|active','uses'=>'UserController@ShowNotifications']);
		Route::get('notifications/{id}/dismiss', ['before'=>'auth|active','uses'=>'UserController@DismissNotification']);

		Route::get('generateapikey', ['before'=>'auth|active','uses'=>'UserController@DoAPIKey']);

		Route::get('inbox', ['before'=>'auth|active','uses'=>'UserController@ShowInbox']);
		Route::get('pm/from/{id}', ['before'=>'auth|active','uses'=>'UserController@ShowPMThread'])->where('id','[0-9]+');
		Route::post('pm/send/{id}',['before'=>'auth|active', 'uses'=>'UserController@SendPM'])->where('id','[0-9]+');
	});

	Route::group(array('prefix' => '/forum'), function()
	{
		Route::get('/', ['uses'=>'ForumController@ShowHome']);
		Route::get('topic/{id}', ['uses'=>'ForumController@ShowTopic'])->where('id','[0-9]+');
		Route::get('topic/{id}/new', ['before'=>'auth|active','uses'=>'ForumController@ShowNewThread'])->where('id','[0-9]+');
		Route::post('topic/{id}/new', ['before'=>'auth|active','uses'=>'ForumController@DoNewThread'])->where('id','[0-9]+');
		Route::get('thread/{id}', ['uses'=>'ForumController@ShowThread'])->where('id','[0-9]+');
		Route::get('thread/{id}/new', ['before'=>'auth|active','uses'=>'ForumController@ShowNewReply'])->where('id','[0-9]+');
		Route::post('thread/{id}/new', ['before'=>'auth|active','uses'=>'ForumController@DoNewReply'])->where('id','[0-9]+');
		Route::get('thread/{id}/new/quote/{post_id}', ['before'=>'auth|active','uses'=>'ForumController@ShowNewReplyWithQuote'])->where('id','[0-9]+')->where('post_id','[0-9]+');
		Route::get('my', ['before'=>'auth','uses'=>'ForumController@ShowMy']);

		Route::get('thread/{id}/delete', ['before'=>'auth|admin','uses'=>'AdminController@DeleteThread'])->where('id','[0-9]+');
		Route::get('thread/{id}/restore', ['before'=>'auth|admin','uses'=>'AdminController@RestoreThread'])->where('id','[0-9]+');
		Route::get('thread/{id}/lock', ['before'=>'auth|admin','uses'=>'AdminController@LockThread'])->where('id','[0-9]+');
		Route::get('thread/{id}/unlock', ['before'=>'auth|admin','uses'=>'AdminController@UnlockThread'])->where('id','[0-9]+');
		Route::get('thread/{id}/sticky', ['before'=>'auth|admin','uses'=>'AdminController@StickyThread'])->where('id','[0-9]+');
		Route::get('thread/{id}/unsticky', ['before'=>'auth|admin','uses'=>'AdminController@UnstickyThread'])->where('id','[0-9]+');
		Route::post('thread/{id}/move', ['before'=>'auth|admin','uses'=>'AdminController@MoveThread'])->where('id','[0-9]+');
		Route::get('post/{id}/delete', ['before'=>'auth|admin','uses'=>'AdminController@DeletePost'])->where('id','[0-9]+');
		Route::get('post/{id}/scrub', ['before'=>'auth|admin','uses'=>'AdminController@ScrubPost'])->where('id','[0-9]+');
		Route::get('post/{id}/unscrub', ['before'=>'auth|admin','uses'=>'AdminController@UnscrubPost'])->where('id','[0-9]+');
		Route::get('post/{id}/edit', ['before'=>'auth|admin','uses'=>'AdminController@EditPost'])->where('id','[0-9]+');
		Route::post('post/{id}/edit', ['before'=>'auth|admin','uses'=>'AdminController@DoEditPost'])->where('id','[0-9]+');
	});

	Route::group(array('prefix' => '/store'), function()
	{
		Route::get('/', ['uses'=>'StoreController@ShowStore']);
		Route::get('item/{id}', ['uses'=>'StoreController@ShowItem'])->where('id','[0-9]+');
		Route::get('item/{id}/purchase', ['before'=>'auth|active', 'uses'=>'StoreController@PurchaseItem'])->where('id','[0-9]+');
		Route::get('upload', ['before'=>'auth|admin','uses'=>'StoreController@ShowUpload']);
		Route::post('upload', ['before'=>'auth|admin','uses'=>'StoreController@DoUpload']);
		Route::get('/{category}', ['uses'=>'StoreController@ShowStoreCategory'])->where('category','[a-z]+');
	});

	Route::group(array('prefix' => '/admin', 'before' => 'auth|admin'), function()
	{
		Route::get('dashboard', ['uses'=>'AdminController@ShowDashboard']);
		Route::get('users', ['uses'=>'AdminController@ShowUsers']);
		Route::post('users', ['uses'=>'AdminController@DoSearchUser']);
		Route::get('users/search/{username}', ['uses'=>'AdminController@ShowSearchUser']);
		Route::get('users/search', ['uses'=>'AdminController@ShowSearchUser_Empty']);
		Route::get('email/{email}', ['uses'=>'AdminController@ShowByEmail']);
		Route::get('ip/{ip}', ['uses'=>'AdminController@ShowByIP']);
		Route::get('edituser/{id}', ['uses'=>'AdminController@ShowEditUser'])->where('id','[0-9]+');
		Route::post('changeuser/{id}', ['uses'=>'AdminController@DoChangeUser'])->where('id','[0-9]+');
		Route::get('logging', ['uses'=>'AdminController@ShowLogging']);
		Route::get('alerts', ['uses'=>'AdminController@ShowAlerts']);
		Route::get('alerts/new', ['uses'=>'AdminController@ShowNewAlert']);
		Route::post('alerts/new', ['uses'=>'AdminController@DoNewAlert']);
		Route::get('alerts/{id}/edit', ['uses'=>'AdminController@ShowEditAlert'])->where('id','[0-9]+');
		Route::post('alerts/{id}/edit', ['uses'=>'AdminController@DoEditAlert'])->where('id','[0-9]+');
		Route::get('alerts/{id}/delete', ['uses'=>'AdminController@DoDeleteAlert'])->where('id','[0-9]+');
		Route::get('badges', ['uses'=>'AdminController@ShowBadges']);
		Route::get('badges/new', ['uses'=>'AdminController@ShowNewBadge']);
		Route::post('badges/new', ['uses'=>'AdminController@DoNewBadge']);
		Route::get('badges/{id}/edit', ['uses'=>'AdminController@ShowEditBadge'])->where('id','[0-9]+');
		Route::post('badges/{id}/edit', ['uses'=>'AdminController@DoEditBadge'])->where('id','[0-9]+');
		Route::get('badges/{id}/delete', ['uses'=>'AdminController@DoDeleteBadge'])->where('id','[0-9]+');
		Route::get('badges/assign/{id}', ['uses'=>'AdminController@ShowAssignBadge'])->where('id','[0-9]+');
		Route::post('badges/assign/{id}', ['uses'=>'AdminController@DoAssignBadge'])->where('id','[0-9]+');
		Route::get('badges/remove/{id}', ['uses'=>'AdminController@ShowRemoveBadge'])->where('id','[0-9]+');
		Route::post('badges/remove/{id}', ['uses'=>'AdminController@DoRemoveBadge'])->where('id','[0-9]+');
		Route::get('economy', ['uses'=>'AdminController@ShowEconomy']);
		Route::get('ban/{id}', ['uses'=>'AdminController@ShowBan'])->where('id','[0-9]+');
		Route::post('ban/{id}', ['uses'=>'AdminController@DoBan'])->where('id','[0-9]+');
		Route::get('unban/{id}', ['uses'=>'AdminController@DoUnban'])->where('id','[0-9]+');
		Route::get('config', ['uses'=>'AdminController@ShowConfig']);
		Route::post('config', ['uses'=>'AdminController@DoConfig']);
		Route::get('roles/assign/{id}', ['uses'=>'AdminController@ShowAssignRole'])->where('id','[0-9]+');
		Route::post('roles/assign/{id}', ['uses'=>'AdminController@DoAssignRole'])->where('id','[0-9]+');
		Route::get('roles/remove/{id}', ['uses'=>'AdminController@ShowRemoveRole'])->where('id','[0-9]+');
		Route::post('roles/remove/{id}', ['uses'=>'AdminController@DoRemoveRole'])->where('id','[0-9]+');
		Route::get('maintenance', ['uses'=>'AdminController@ShowMaintenance']);
		Route::post('maintenance', ['uses'=>'AdminController@DoMaintenance']);
		Route::get('maintenance/recover', ['uses'=>'AdminController@ShowRecover']);
		Route::post('maintenance/recover', ['uses'=>'AdminController@DoRecover']);
	});

	Route::group(array('prefix' => '/api'), function()
	{
		Route::group(array('prefix' => '/public'), function()
		{
			Route::group(array('prefix' => '/user'), function()
			{
			    Route::get('/{id}', ['uses'=>'APIController@GetUser'])->where('id','[0-9]+');
			});
		});
		Route::group(array('prefix' => '/private/{apikey}'), function($apikey)
		{
			Route::get('/user', ['uses'=>'APIController@GetPrivateUser']);
		});
	});
});