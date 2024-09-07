@section('content')

@include('admin.panel')

<h1 class="title">Configuration</h1>

@if( Session::has('success') )
	<div class="well success-well">
		<p>Site configuration has been updated!</p>
	</div>
@endif 

@if ($errors->any())
	<div class="well error-well">
		<ul>
			{{ implode('', $errors->all('<li>:message</li>')) }}
		</ul>
	</div>
@endif

{{ Form::open(array('url' => '/admin/config', 'autocomplete' => 'off'))}}

	{{ Form::label('sitename', 'Site Name'); }}
	{{ Form::text('sitename', $sitename, array('class' => 'fw', 'placeholder' => 'Site Name')) }}
	
	{{ Form::label('userstore', 'Userstore enabled'); }}
	{{ Form::text('userstore', $userstore, array('class' => 'fw', 'placeholder' => 'true or false')) }}
	
	{{ Form::label('avatarwidth', 'avatar width'); }}
	{{ Form::text('avatarwidth', $avatarwidth, array('class' => 'fw', 'placeholder' => 'avatar width')) }}
	
	{{ Form::label('avatarheight', 'avatar height'); }}
	{{ Form::text('avatarheight', $avatarheight, array('class' => 'fw', 'placeholder' => 'avatar height')) }}

	{{ Form::label('description', 'Site Description'); }}
	{{ Form::textarea('description', $sitedescription, array('rows' => 3, 'class' => 'fw', 'placeholder' => 'Site Description')) }}

	{{ Form::label('sitedomain', 'Site Domain'); }}
	{{ Form::text('sitedomain', $sitedomain, array('class' => 'fw', 'placeholder' => 'Site Domain')) }}

	{{ Form::label('currency_1', 'Currency 1 Name'); }}
	{{ Form::text('currency_1', $currency_1, array('class' => 'fw', 'placeholder' => 'Currency 1 Name')) }}

	{{ Form::submit('Save Configuration', array('class' => 'btn-block btn-submit')) }}

{{ Form::close() }}

@stop