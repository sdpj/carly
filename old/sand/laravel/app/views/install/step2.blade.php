@section('content')

	@if (Session::has('conn-fail'))
		<div class="well error-well top">
			<span>The installer was unable to connect to your database with the settings provided!</span>
		</div>
	@endif

	@if (Session::has('error'))
		<div class="well error-well top">
			<span>You must fill out all the fields!</span>
		</div>
	@else
		<p>SANS 2.0 requires a MySQL database to store its data - the details needed for this are provided by your webhost</p>
	@endif

	{{ Form::open(array('url' => '/install/step2', 'autocomplete' => 'off'))}}

<h1>Cracked by jarkee (social media: @JaredYoshi)</h1>
<h2>Made specially for a friend called wafkee</h2>

		<!-- REQUIRED TO REMOVE AUTOFILL - DO NOT REMOVE!-->
		<input style="display:none" type="text" name="fakeusernameremembered"/>
		<input style="display:none" type="password" name="fakepasswordremembered"/>
		<!-- REQUIRED TO REMOVE AUTOFILL - DO NOT REMOVE!-->

	    {{ Form::label('db-host', 'Database Host'); }}
	    {{ Form::text('db-host', '', '') }}

	    {{ Form::label('db-user', 'Database Username'); }}
	    {{ Form::text('db-user', '', '') }}

	    {{ Form::label('db-pass', 'Database Password'); }}
	    {{ Form::password('db-pass', '', '') }}

	    {{ Form::label('db-name', 'Database Name'); }}
	    {{ Form::text('db-name', '', '') }}

	    {{ Form::submit('Proceed to next step', '') }}

	{{ Form::close() }}

@stop