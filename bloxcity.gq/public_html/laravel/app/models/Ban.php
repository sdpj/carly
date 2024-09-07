<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Ban extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'bans';

	protected $dates = array('expiry');

}
