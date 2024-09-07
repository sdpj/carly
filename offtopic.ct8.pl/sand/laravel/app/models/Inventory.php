<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Inventory extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'inventories';

}
