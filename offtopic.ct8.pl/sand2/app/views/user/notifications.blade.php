@section('content')

	<h1 class="title">Notifications</h1>

	@if (Auth::user()->countNotifications() == 0)
		<div class="well">
			<p>You've got no new notifications!</p>
		</div>
	@else

		<?php $i=0; ?>

		@foreach ($notifications as $notification)

		<?php $i++; ?>

		@if ($notification->type == "stipend")
			<div class="notification green @if($i%2==0) right @else left @endif">
				<span>You have received your daily stipend!</strong>
				<a href="{{ url('/user/notifications/'.$notification->id.'/dismiss') }}">(dismiss)</a></span>

				<i>about {{$notification->created_at->diffForHumans()}}</i>
				
			</div>
		@endif

		@endforeach

	@endif

	<div class="clear"></div>

@stop