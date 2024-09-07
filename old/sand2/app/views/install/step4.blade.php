@section('content')

	@if ($errors->any())
		<div class="well error-well top">
			{{ implode('', $errors->all('<span>:message</span>')) }}
		</div>
	@else
		<p>This is where you create your administrator account - it'll be the first account on your SANS 2.0 website!</p>
	@endif

	{{ Form::open(array('url' => '/install/step4', 'autocomplete' => 'off'))}}

		<!-- REQUIRED TO REMOVE AUTOFILL - DO NOT REMOVE!-->
		<input style="display:none" type="text" name="fakeusernameremembered"/>
		<input style="display:none" type="password" name="fakepasswordremembered"/>
		<input style="display:none" type="email" name="fakeemailremembered"/>
		<!-- REQUIRED TO REMOVE AUTOFILL - DO NOT REMOVE!-->

	    {{ Form::label('username', 'Administrator Username'); }}
	    {{ Form::text('username', '', '') }}

	    {{ Form::label('password', 'Administrator Password'); }}
	    {{ Form::password('password', '', '') }}

	    {{ Form::label('password_confirm', 'Confirm Administrator Password'); }}
	    {{ Form::password('password_confirm', '', '') }}

	    {{ Form::label('email', 'Administrator E-Mail Address'); }}
	    {{ Form::email('email', '', '') }}

	    {{ Form::submit('Complete Installation!', '') }}

	{{ Form::close() }}

@stop