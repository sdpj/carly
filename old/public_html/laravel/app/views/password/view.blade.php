@section('content')

<h1 class="title">Reset your {{ $sitename }} password</h1>

@if (Session::has('error'))
	<div class="well error-well">
		<p>{{ trans(Session::get('error')) }}</p>
	</div>
@elseif (Session::has('status'))
	<div class="well success-well">
		<p>An email with the password reset has been sent!</p>
	</div>
@endif

{{ Form::open(array('url' => '/user/forgotpassword', 'autocomplete' => 'off'))}}

	{{ Form::label('username', 'Username'); }}
	{{ Form::text('username', '', array('class' => 'fw', 'placeholder' => 'Username')) }}

	{{ Form::submit('Send Password Reset', array('class' => 'btn-block btn-submit')) }}

{{ Form::close() }}

@stop