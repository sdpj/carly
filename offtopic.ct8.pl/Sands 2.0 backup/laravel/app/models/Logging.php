<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Logging extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'logs';

	public static function LogEvent($event, $user_id, $ip)
	{
		$log 			= new Logging;
		$log->type 		= $event;
		$log->user_id 	= $user_id;
		$log->ip 		= $ip;
		$log->save();
	}

	public static function LogEventWithData($event, $user_id, $ip, $old_data, $new_data)
	{
		$log 			= new Logging;
		$log->type 		= $event;
		$log->user_id 	= $user_id;
		$log->ip 		= $ip;
		$log->old_data	= $old_data;
		$log->new_data 	= $new_data;
		$log->save();
	}

}


