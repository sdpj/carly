<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;
use Golonka\BBCode\BBCodeParser;

class ForumPos extends Eloquent {

	use SoftDeletingTrait;

	protected $table = 'forum_posts';

	public function poster()
	{
	    return $this->belongsTo('User', 'user_id');
	}

	public function parseBBCode()
	{
		BBCode::setParser('namedQuote', '/\[quote\=(.*?)\](.*)\[\/quote\]/s', '<blockquote><small>Quote of: <strong>$1</strong></small><hr>$2</blockquote>');
		return BBCode::only('bold', 'italic', 'underLine', 'namedQuote')->parse(e($this->body));
	}

}
