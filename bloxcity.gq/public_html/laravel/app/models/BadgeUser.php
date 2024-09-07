<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class BadgeUser extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'badge_user';

}
