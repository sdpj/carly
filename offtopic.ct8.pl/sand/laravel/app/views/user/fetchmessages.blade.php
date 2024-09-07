@foreach ($messages as $message)

	@if ($message->user_id == Auth::id())
		<div class="message own" title="{{ $message->created_at }}"> 
	@else
		<div class="message" title="{{ $message->created_at }}"> 
	@endif

			<a href="{{ url('/user/profile/'.$message->user_id) }}">
				<img src="{{ $message->getAvatar() }}">
			</a>
			<div>
				<h4>{{{ $message->getUsername() }}}</h4>
				<i>{{ $message->created_at->diffForHumans() }}</i>
				<span>{{{ $message->message }}}</span>
			</div>

			{{--
				@if (Auth::user()->hasRole('Moderator') || Auth::user()->hasRole('Administrator'))
					<div class="chat-moderation">
						<a href="#"><i class="fa fa-times"></i> Delete Message</a>
					</div>
				@endif
			--}}

		</div>

@endforeach