<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class ForumTop extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'forum_topics';

	public function category()
	{
	    return $this->belongsTo('ForumCat');
	}

    public function topic()
    {
        return $this->hasMany('ForumThr', 'topic')->orderBy('sticky', 'DESC')->orderBy('updated_at', 'DESC');
    }

	public function getUsername() {
		$id 		= $this->user_id;
		$username 	= User::find($id);
		return $username;
	}

}
