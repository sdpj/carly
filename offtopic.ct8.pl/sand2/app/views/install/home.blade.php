@section('content')

	<h1>Welcome to SANS 2.0</h1>

	<p>This installation process is here to make setting up your SANS 2.0 website quick and easy.<br>Each step is labelled to guide you through the process - if you have any problems, please consult the Documentation!</p>

	@if ($errors->any())
		<div class="well error-well">
			{{ implode('', $errors->all('<span>:message</span>')) }}
		</div>
	@endif

	@if (Session::has('invalid'))
		<div class="well error-well">
			<span>The license key you entered is either non-existent, not valid for this domain, or not active.<br>If you believe this to be an error, please open a support ticket in the SANS billing panel.</span>
		</div>
	@endif

	{{ Form::open(array('url' => '/install', 'autocomplete' => 'off'))}}

	    {{ Form::label('license-key', 'License Key'); }}
	    {{ Form::text('license-key', '', array('id' => 'license-key', 'class' => 'uppercase')) }}

	    {{ Form::submit('Proceed to next step', '') }}

	{{ Form::close() }}

@stop

@section('additional-js')
<script src="//cdn.jsdelivr.net/jquery.maskedinput/1.3.1/jquery.maskedinput.min.js"></script>
@stop
@section('additional-jquery')
	$("#license-key").mask("*****-*****-*****-*****-*****",{placeholder:" "});
@stop