<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class BadgeType extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'badge_type';

}
