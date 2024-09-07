<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Item extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'items';

	public function owned($id)
	{
		if (Inventory::where('user_id', '=', Auth::user()->id)->where('item_id', '=', $id)->get()->count() != 0)
		{
			return true;
		} else {
			return false;
		}
	}

}
