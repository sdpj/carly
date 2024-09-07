@section('content')
	
	<h1 class="title">Verify your {{{ $sitename }}} account</h1>

	@if( Session::has('action_denied') )

		<div class="well error-well">
			<p>The action you attempted is not permitted without verifying your e-mail address!</p>
		</div>

	@endif 

	@if (Auth::user()->activated == 1)

		<div class="well error-well">
			<p>You have already activated your account!</p>
		</div>

	@else



	@if( Session::has('resent') )

		<div class="well success-well">
			<p>Your account verification e-mail has been resent!</p>
		</div>

	@endif 

		<p>We may from time to time need to send you important information about {{{ $sitename }}}, so it's vital we have your e-mail address as so we can contact you when necessary. Additionally, we can ensure that spam accounts don't manage to fill up {{{ $sitename }}} with junk by ensuring they are real users.</p>
		
		<br>
		
		<p>The current e-mail address we hold for your account is: <strong>{{{ Auth::user()->email }}}</strong></p>
		<p style="font-size: 12px;">If this is incorrect, you can change it in your <a href="{{ url('/user/settings') }}">Account Settings</a></p>
		
		<br>
		


		<a href="{{ url('/user/verify/resend') }}" class="btn-block btn-submit">Resend verification e-mail</a>

	@endif

@stop