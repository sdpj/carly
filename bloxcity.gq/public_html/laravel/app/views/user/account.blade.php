@section('additional-css')
<link rel="stylesheet" href="//cdn.jsdelivr.net/dropkick/1.4/dropkick.css">
@stop
@section('content')

<h1 class="title">Modify your Account</h1> 

@if ($errors->any())

	<div class="well error-well">
		<ul>
			{{ implode('', $errors->all('<li>:message</li>')) }}
		</ul>
	</div>

@endif

@if( Session::has('api_error') )

	<div class="well error-well">
		<p>You already have an API key!</p>
	</div>

@endif 

@if( Session::has('success') )

	<div class="well success-well">
		<p>Your settings have been successfully updated!</p>
	</div>

@endif 

<h3 class="form">Change Forum Signature</h3>

{{ Form::open(array('url' => '/user/changesignature', 'autocomplete' => 'off'))}}

	{{ Form::label('signature', 'Forum Signature'); }}
	{{ Form::textarea('signature', Auth::user()->signature, array('class' => 'fw', 'rows' => 4, 'maxlength' => 255, 'placeholder' => 'Enter a forum signature...')) }}

	{{ Form::submit('Save your new Forum Signature', array('class' => 'btn-block btn-submit', 'style' => 'margin-bottom: 20px;')) }}

{{ Form::close() }}

<h3 class="form">Change Timezone</h3>

{{ Form::open(array('url' => '/user/changetimezone', 'autocomplete' => 'off'))}}

	{{ Form::label('timezone', 'Timezone'); }}
	{{ Timezone::selectForm(Auth::user()->timezone, 'Select your timezone', array('class' => 'default fw', 'name' => 'timezone', 'id' => 'timezone')) }}

	{{ Form::submit('Save your new Timezone', array('class' => 'btn-block btn-submit', 'style' => 'margin-bottom: 20px;')) }}

{{ Form::close() }}

<h3 class="form">Change E-Mail Address</h3>

{{ Form::open(array('url' => '/user/changeemail', 'autocomplete' => 'off'))}}

	{{ Form::label('email', 'E-Mail Address'); }}
	{{ Form::text('email', Auth::user()->email, array('class' => 'fw', 'placeholder' => 'E-Mail Address')) }}

	{{ Form::submit('Save your new E-Mail Address', array('class' => 'btn-block btn-submit', 'style' => 'margin-bottom: 20px;')) }}

{{ Form::close() }}

<h3 class="form">Change Password</h3>

{{ Form::open(array('url' => '/user/changepassword', 'autocomplete' => 'off'))}}

	{{ Form::label('password', 'Current Password'); }}
	{{ Form::password('password', array('class' => 'fw', 'placeholder' => 'Current Password')) }}

	{{ Form::label('newpassword', 'New Password'); }}
	{{ Form::password('newpassword', array('class' => 'fw', 'placeholder' => 'New Password')) }}

	{{ Form::label('newpassword_confirm', 'Confirm New Password'); }}
	{{ Form::password('newpassword_confirm', array('class' => 'fw', 'placeholder' => 'Confirm New Password')) }}

	{{ Form::submit('Save your new Password', array('class' => 'btn-block btn-submit', 'style' => 'margin-bottom: 20px;')) }}

{{ Form::close() }}

<h3 class="form">Generate API Key</h3>

@if (APIKey::where('user_id', '=', Auth::user()->id)->count() == 0)
	<a href="{{ url('/user/generateapikey') }}" class="btn-block btn-submit">Click to Generate API Key</a>
@else
	{{ Form::label('key', 'API Key'); }}
	{{ Form::text('key', APIKey::where('user_id', '=', Auth::user()->id)->first()->key, array('class' => 'fw', 'disabled')) }}
@endif

@stop
@section('additional-js')
<script src="//cdn.jsdelivr.net/dropkick/1.4/jquery.dropkick-min.js"></script>
@stop
@section('additional-jquery')
$('.default').dropkick();
@stop