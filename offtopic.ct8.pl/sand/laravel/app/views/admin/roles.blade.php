@section('content')

@include('admin.panel')

@if (Request::is('admin/roles/assign/*'))

	<h1 class="title">Assign Role to {{{ $user->username }}}</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif

	{{ Form::open(array('url' => '/admin/roles/assign/'.$user->id, 'autocomplete' => 'off'))}}

		{{ Form::label('type', 'Role Type') }}
		{{ Form::select('type', $role_types, '', array('class' => 'default fw')) }}

		{{ Form::label('badge_type', 'Badge Type') }}
		{{ Form::select('badge_type', $badge_types, '', array('class' => 'default fw')) }}

		{{ Form::submit('Assign Role to '.$user->username, array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

@elseif (Request::is('admin/roles/remove/*'))
	
	<h1 class="title">Remove Role from {{{ $user->username }}}</h1>

	@if ($errors->any())
		<div class="well error-well">
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}
			</ul>
		</div>
	@endif

	{{ Form::open(array('url' => '/admin/roles/remove/'.$user->id, 'autocomplete' => 'off'))}}

		{{ Form::label('type', 'Role Type') }}
		{{ Form::select('type', $role_types, '', array('class' => 'default fw')) }}

		{{ Form::submit('Remove Role from '.$user->username, array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

@endif

@stop

@section('additional-js')
<script src="//cdn.jsdelivr.net/dropkick/1.4/jquery.dropkick-min.js"></script>
@stop
@section('additional-jquery')
$('.default').dropkick();
@stop