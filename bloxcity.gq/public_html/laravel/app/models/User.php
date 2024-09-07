<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Smallneat\Trust\UserRoleTrait;
use Carbon\Carbon;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait, UserRoleTrait;

	protected $table = 'users';

	protected $dates = array('last_activity', 'last_stipend', 'time');

	protected $hidden = array('password', 'remember_token');

	public function getAvatarURL() {
		$id = $this->id;
		return '/user/avatar/'.$id.'';
	}

	public function getProfileRank() {
		if ($this->hasRole('Administrator')) {
			return '<div class="tag red profile">Administrator</div>';
		} elseif ($this->hasRole('Moderator')) {
			return '<div class="tag purple profile">Moderator</div>';
		} elseif ($this->hasRole('Designer')) {
			return '<div class="tag orange profile">Designer</div>';
		} elseif ($this->hasRole('Upgraded')) {
			return '<div class="tag green profile">Upgraded User</div>';
		} else {
			return '<div class="tag blue profile">Regular User</div>';
		}
	}

	public function getUserRank() {
		if ($this->hasRole('Administrator')) {
			return '<div class="tag red">Administrator</div>';
		} elseif ($this->hasRole('Moderator')) {
			return '<div class="tag purple">Moderator</div>';
		} elseif ($this->hasRole('Designer')) {
			return '<div class="tag orange">Designer</div>';
		} elseif ($this->hasRole('Upgraded')) {
			return '<div class="tag green">Upgraded User</div>';
		} else {
			return '<div class="tag blue">Regular User</div>';
		}
	}

	public function processStipend() {

		$user 			= Auth::user();
		$current_value  = $user->currency_1;
		$last_stipend	= $user->last_stipend;
		$stipend_amount = $user->stipend_1_amount;
		$new_value 		= $current_value + $stipend_amount;

		if (Carbon::now()->diffInDays($last_stipend) >= 1) {
			Logging::LogEventWithData('stipend', $user->id, $_SERVER['REMOTE_ADDR'], $current_value, $new_value);

			$user 				= Auth::user();
			$user->currency_1 	= $new_value;
			$user->last_stipend = Carbon::now();
			$user->save();

			Notification::NewStipend($user->id);
		}
	}

	public function getNumberOfMessages()
	{
		return Message::where('recipient_id', '=', $this->id)->where('seen', '=', 0)->count();
	}

	public function countPosts()
	{
		return ForumPos::where('user_id', '=', $this->id)->count();
	}

	public function countNotifications()
	{
		return Notification::where('user_id', '=', $this->id)->where('seen', '=', 0)->count();
	}

	public function isBanned()
	{
		if (Ban::where('user_id', '=', $this->id)->count() != 0){
			return true;
		} else {
			return false;
		}
	}

}
