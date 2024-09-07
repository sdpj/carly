@section('content')

<h1 class="title">Welcome to {{ $sitename }}</h1>

@if ($errors->any())

	<div class="well error-well">
		<ul>
			{{ implode('', $errors->all('<li>:message</li>')) }}
		</ul>
	</div>

@endif

@if (Auth::user()->gender == null)

	{{ Form::open(array('url' => '/user/welcome', 'autocomplete' => 'off'))}}

		<h3 class="subtitle tac">Are you Male or Female?</h3>

		<div id="welcome-gender"> 
			{{ Form::radio('gender', 'male', '', array('class' => 'male', 'id' => 'male-one')) }}
			<label for="male-one">Male One</label> 

			{{ Form::radio('gender', 'female', '', array('class' => 'female', 'id' => 'female-one')) }}
			<label for="female-one">Female One</label>
		</div>

		{{ Form::submit('Next step...', array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

@else

	@if( Session::has('success_1') )

		<div class="well success-well">
			<p>Okay then, next step!</p>
		</div>

	@endif 

	{{ Form::open(array('url' => '/user/welcome', 'autocomplete' => 'off'))}}

		<h3 class="subtitle tac">skin color</h3>


		<div id="welcome-race"> 
			{{ Form::radio('race', 'white', '', array('class' => 'white', 'id' => 'white-one')) }}
			<label for="white-one">White One</label> 

			{{ Form::radio('race', 'asian', '', array('class' => 'asian', 'id' => 'asian-one')) }}
			<label for="asian-one">Asian One</label> 

			{{ Form::radio('race', 'black', '', array('class' => 'black', 'id' => 'black-one')) }}
			<label for="black-one">Blak One</label> 
		</div>

		{{ Form::submit('Complete your Registration', array('class' => 'btn-block btn-submit')) }}

	{{ Form::close() }}

@endif

@stop