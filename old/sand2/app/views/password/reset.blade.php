@section('content')

<h1 class="title">Change your {{ $sitename }} password</h1>

@if (Session::has('error'))
	<div class="well error-well">
		<p>{{ trans(Session::get('error')) }}</p>
	</div>
@elseif (Session::has('status'))
	<div class="well success-well">
		<p>An email with the password reset has been sent!</p>
	</div>
@endif

{{ Form::open(array('url' => '/user/resetpassword', 'autocomplete' => 'off'))}}

	{{ Form::label('username', 'Username'); }}
	{{ Form::text('username', '', array('class' => 'fw', 'placeholder' => 'Username')) }}

	{{ Form::label('password', 'New Password'); }}
	{{ Form::password('password', array('class' => 'fw', 'placeholder' => 'New Password')) }}

	{{ Form::label('password_confirmation', 'Confirm Password'); }}
	{{ Form::password('password_confirmation', array('class' => 'fw', 'placeholder' => 'Confirm Password')) }}

	{{ Form::hidden('token', $token) }}

	{{ Form::submit('Submit Password Reset', array('class' => 'btn-block btn-submit')) }}

{{ Form::close() }}

@stop