<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Alert extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'alerts';

}
