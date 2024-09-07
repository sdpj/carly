<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class ForumCat extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'forum_categories';

    public function topic()
    {
        return $this->hasMany('ForumTop', 'category')->orderBy('order');
    }

}
