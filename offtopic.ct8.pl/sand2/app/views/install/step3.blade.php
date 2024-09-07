@section('content')

	@if ($errors->any())
		<div class="well error-well top">
			{{ implode('', $errors->all('<span>:message</span>')) }}
		</div>
	@else
		<p>Here, you need to specify the name and other information about your SANS 2.0 website so we can set it up</p>
	@endif

	{{ Form::open(array('url' => '/install/step3', 'autocomplete' => 'off'))}}

	    {{ Form::label('sitename', 'Site Name'); }}
	    {{ Form::text('sitename', '', '') }}

	    {{ Form::label('sitedesc', 'Site Description'); }}
	    {{ Form::textarea('sitedesc', '', array('rows' => 3)) }}

	    {{ Form::label('currency_1', 'Currency Name'); }}
	    {{ Form::text('currency_1', '', '') }}

	    {{ Form::submit('Proceed to next step', '') }}

	{{ Form::close() }}

@stop