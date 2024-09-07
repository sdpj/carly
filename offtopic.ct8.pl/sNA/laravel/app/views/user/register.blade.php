@section('content')

<h1 class="title">Register an account at {{ $sitename }}</h1>

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
	<input style="display:none" type="email" name="fakeemailremembered"/>
	<!-- REQUIRED TO REMOVE AUTOFILL - DO NOT REMOVE!-->

{{ Form::open(array('url' => '/user/register', 'autocomplete' => 'off'))}}

	{{ Form::label('username', 'Username'); }}
	{{ Form::text('username', '', array('class' => 'fw', 'placeholder' => 'Username')) }}

	{{ Form::label('password', 'Password'); }}
	{{ Form::password('password', array('class' => 'fw', 'placeholder' => 'Password'))}}

	{{ Form::label('password_confirm', 'Confirm Password'); }}
	{{ Form::password('password_confirm', array('class' => 'fw', 'placeholder' => 'Confirm Password'))}}

	{{ Form::label('email', 'E-Mail Address'); }}
	{{ Form::text('email', '', array('class' => 'fw', 'placeholder' => 'E-Mail address')) }}

	{{ Form::submit('Complete your Registration', array('class' => 'btn-block btn-submit')) }}

{{ Form::close() }}

@stop