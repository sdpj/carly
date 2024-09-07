@section('content')

@include('admin.panel')

	@if (Request::is('admin/maintenance'))

	<h1 class="title">Maintenance</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif

	<div class="well">
		<p>
		When Maintenance Mode is activated, the whole website will be unavailable for everyone other than Administrators currently logged in.
		<br>
		When Emergency Maintenance Mode is activated, the whole website will be unavailable for <strong>everyone</strong> - even Administrators, and yourself.
		<br>
		Maintenance Mode can be switched off by visting the recovery URL with the recovery key you specified when turning it on.
		</p>
	</div>

	{{ Form::open(array('url' => '/admin/maintenance', 'autocomplete' => 'off'))}}

		{{ Form::label('type', 'Maintenance Type') }}
		{{ Form::select('type', ['maintenance' => 'Maintenance Mode', 'emergency_maintenance' => 'Emergency Maintenance Mode'], '', array('class' => 'default fw')) }}

		{{ Form::label('key', 'Recovery Key') }}
		{{ Form::password('key', array('class' => 'fw', 'placeholder' => 'Recovery Key')) }}

		{{ Form::submit('Activate Maintenance', array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

	@elseif (Request::is('admin/maintenance/recover'))

	<h1 class="title">Recover Website</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif

	@if( Session::has('key_fail') )
	    <div class="well error-well">
	        <p>That recovery key doesn't match the key currently set!</p>
	    </div>
	@endif 

	<div class="well">
		<p>The Recovery Key is the key specified when opening Maintenance Mode</p>
	</div>

	{{ Form::open(array('url' => '/admin/maintenance/recover', 'autocomplete' => 'off'))}}

		{{ Form::label('key', 'Recovery Key') }}
		{{ Form::password('key', array('class' => 'fw', 'placeholder' => 'Recovery Key')) }}

		{{ Form::submit('Recover Website', array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

	@endif

@stop
@section('additional-js')
<script src="//cdn.jsdelivr.net/dropkick/1.4/jquery.dropkick-min.js"></script>
@stop
@section('additional-jquery')
$('.default').dropkick();
@stop