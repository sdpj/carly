<?php

use Carbon\Carbon;

class ForumSeen extends Eloquent {

	protected $table = 'forum_seen';

    public function users()
    {
        return $this->belongsTo('User');
    }

    public function seen()
    {
        return $this->hasMany('User');
    }

}
