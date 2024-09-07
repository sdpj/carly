@section('content')

@if (!Request::is('user/members/online'))
    <h1 class="title">Members of {{{ $sitename }}} <a href="{{ url('/user/members/online') }}">({{{ User::where('last_activity', '>', Carbon::now()->subMinutes(5))->count() }}} Online Users)</a></h1>
@else
    <h1 class="title">Online Members of {{{ $sitename }}} <a href="{{ url('/user/members') }}">(Return to Members)</a></h1>
@endif

@if ($errors->any())

  <div class="well error-well">
    <ul>
      {{ implode('', $errors->all('<li>:message</li>')) }}
    </ul>
  </div>

@endif

@if (!Request::is('user/members/online'))

    {{ Form::open(array('url' => '/user/members', 'autocomplete' => 'off'))}}

      {{ Form::label('username', 'Username'); }}
      {{ Form::text('username', '', array('class' => 'search-input fw', 'placeholder' => 'Username')) }}

      {{ Form::submit('Search by Username', array('class' => 'search-btn btn-submit')) }}

    {{ Form::close() }}

@endif

@if (count($members) != 0)

<div id="members">

	@foreach ($members as $member)
		<div class="member">
			<a href="{{ url('/user/profile/'.$member->id.'') }}">
				<img src="{{ url($member->getAvatarURL()) }}">
				<span>{{{ $member->username }}}</span>
			</a>
		</div>
	@endforeach

	{{ $members->links() }}

</div>

@else
  <div class="well error-well">
    <p>There are no members matching this criteria! :(</p>
  </div>
@endif

@stop