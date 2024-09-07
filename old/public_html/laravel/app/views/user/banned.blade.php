@section('content')

	<h1 class="title">You've been banned!</h1>
	<p>The Administration Team of {{{ $sitename }}} have determined that your actions on the website are unacceptable, and for that reason, they have issued you with a moderation strike - the reasoning for such, and your ban length are visible below:</p>
	<br>
	<span><strong>Reason: </strong>{{{ $ban->reason }}}</span>
	<br>
	<span><strong>Type: </strong>
	@if ($ban->length == "warning")
		Warning
	@elseif ($ban->length == "1_day")
		1 Day
	@elseif ($ban->length == "3_day")
		3 Days
	@elseif ($ban->length == "7_day")
		1 Week (7 Days)
	@elseif ($ban->length == "14_day")
		2 Weeks (14 Days)
	@elseif ($ban->length == "1_month")
		1 Month
	@elseif ($ban->length == "permanent")
		Permanent
	@endif
	</span>
	<br>
	<span><strong>Issued at: </strong>{{{ $ban->created_at->toDayDateTimeString() }}} ({{{ $ban->created_at->diffForHumans() }}})</span>
	<br>
	@if ($ban->length == "permanent")
		<span><strong>Expiry Date / Time: </strong>Never</span>
	@else
		<span><strong>Expiry Date / Time: </strong>{{{ $ban->expiry->toDayDateTimeString() }}} ({{{ $ban->expiry->diffForHumans() }}})</span>
	@endif

	@if ($ban->expiry < Carbon::now())
		<a href="{{ url('user/reactivate') }}" class="btn-block btn-submit">Reactivate your {{{ $sitename }}} account</a>
	@endif

	<a href="{{ url('user/logout') }}" class="btn-block btn-forgot">Logout of your {{{ $sitename }}} account</a>

@stop