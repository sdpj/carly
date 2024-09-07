<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class APIKey extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'api_keys';

}
