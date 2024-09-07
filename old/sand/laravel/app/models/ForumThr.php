<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class ForumThr extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'forum_threads';

    public function thread()
    {
        return $this->hasMany('ForumPos', 'thread')->orderBy('created_at');
    }

    public function seen()
    {
        return $this->hasMany('ForumSeen', 'thread')->where('user_id', '=', Auth::id())->orderBy('created_at', 'DESC')->first();
    }

}
