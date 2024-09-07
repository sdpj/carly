<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Notification extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'notifications';

	public static function NewStipend($user_id)
	{
		$notification 			= new Notification;
		$notification->user_id  = $user_id;
		$notification->type 	= "stipend";
		$notification->save();
	}

}
