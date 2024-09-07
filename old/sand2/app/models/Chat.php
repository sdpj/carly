<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Chat extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'chat_messages';

	public function getUsername()
	{
		$userid 	= $this->user_id;
		$user   	= User::find($userid);

		return $user->username;
	}

	public function getAvatar()
	{
		$userid 	= $this->user_id;

		return '/user/avatar/'.$userid.'';
	}

}
