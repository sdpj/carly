<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Stipend extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'stipend_log';

}
