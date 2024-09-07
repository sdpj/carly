<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Message extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'private_messages';

}
