@section('additional-css')
	<link rel="stylesheet" href="//cdn.jsdelivr.net/dropkick/1.4/dropkick.css">
@stop
@section('content')

@include('admin.panel')

@if (Request::is('admin/alerts'))
	<h1 class="title">Alerts</h1>

	@if( Session::has('alert-deleted') )
		<div class="well success-well">
			<p>The selected alert has been successfully deleted!</p>
		</div>
	@endif 

	@if( Session::has('success') )
		<div class="well success-well">
			<p>Alert successfully submitted!</p>
		</div>
	@endif 

	@foreach (Alert::orderBy('created_at', 'DESC')->get() as $alert)
	    <div class="alert-bar {{ $alert->type }}">
	    	<a href="{{ url('/admin/alerts/'.$alert->id.'/edit') }}" class="alert-left"><i class="fa fa-pencil"></i></a>
	        <span>{{ $alert->text }}</span>
			<a href="{{ url('/admin/alerts/'.$alert->id.'/delete') }}" class="alert-right"><i class="fa fa-close"></i></a>
	    </div>
	@endforeach

	<a href="{{ url('/admin/alerts/new') }}" class="btn-block btn-submit">Create a New Alert</a>
@elseif (Request::is('admin/alerts/new'))

	<h1 class="title">New Alert</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif

	{{ Form::open(array('url' => '/admin/alerts/new', 'autocomplete' => 'off'))}}

		{{ Form::label('text', 'Alert Content'); }}
		{{ Form::text('text', '', array('class' => 'fw', 'placeholder' => 'Alert Content')) }}

		{{ Form::label('type', 'Alert Type'); }}
		{{ Form::select('type', ['normal' => 'Normal', 'success' => 'Success', 'warning' => 'Warning', 'danger' => 'Danger'], '', array('class' => 'default fw')) }}

		{{ Form::submit('Add New Alert', array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

@elseif (Request::is('admin/alerts/*/edit'))

	<h1 class="title">Edit Alert</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif

	{{ Form::open(array('url' => '/admin/alerts/'.$alert->id.'/edit', 'autocomplete' => 'off'))}}

		{{ Form::label('text', 'Alert Content'); }}
		{{ Form::text('text', $alert->text, array('class' => 'fw', 'placeholder' => 'Alert Content')) }}

		{{ Form::label('type', 'Alert Type'); }}
		{{ Form::select('type', ['normal' => 'Normal', 'success' => 'Success', 'warning' => 'Warning', 'danger' => 'Danger'], $alert->type, array('class' => 'default fw')) }}

		{{ Form::submit('Save Changes to Alert', array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

@endif

@stop
@section('additional-js')
<script src="//cdn.jsdelivr.net/dropkick/1.4/jquery.dropkick-min.js"></script>
@stop
@section('additional-jquery')
$('.default').dropkick();
@stop