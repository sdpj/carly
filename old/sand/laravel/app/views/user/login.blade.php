@section('content')

<h1 class="title">Login to your {{ $sitename }} account</h1>

@if ($errors->any())

	<div class="well error-well">
		<ul>
			{{ implode('', $errors->all('<li>:message</li>')) }}
		</ul>
	</div>

@endif

	<!-- REQUIRED TO REMOVE AUTOFILL - DO NOT REMOVE!-->
	<input style="display:none" type="text" name="fakeusernameremembered"/>
	<input style="display:none" type="password" name="fakepasswordremembered"/>
	<!-- REQUIRED TO REMOVE AUTOFILL - DO NOT REMOVE!-->

{{ Form::open(array('url' => '/user/signin', 'autocomplete' => 'off'))}}

	{{ Form::label('username', 'Username'); }}
	{{ Form::text('username', '', array('class' => 'fw', 'placeholder' => 'Username')) }}

	{{ Form::label('password', 'Password'); }}
	{{ Form::password('password', array('class' => 'fw', 'placeholder' => 'Password'))}}

	{{ Form::submit('Login to your Account', array('class' => 'btn-block btn-submit')) }}

{{ Form::close() }}

<a href="/user/forgotpassword" class="btn-block btn-forgot">Help! I've forgotten my password!</a>

@stop