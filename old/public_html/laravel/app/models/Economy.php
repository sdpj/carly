<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Economy extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'economy';

}
