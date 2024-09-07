@section('content')

	<h1 class="title">Private Messages</h1>

	<div id="pm-list">
		<ul>
			@if (count($message_threads) == 0)
				No messages! Send one!
			@else
				@foreach ($message_threads as $thread)
					<a href="{{url('user/pm/from/'.$thread->sender_id)}}">
						@if ($thread->seen)
							<li>
						@else
							<li class="unread">
						@endif
								<img src="{{ url('/user/avatar/'.$thread->sender_id)  }}">
								<div class="pm-col2">
									<h2>{{User::find($thread->sender_id)->username}}</h2>
									<p>{{$thread->message}}</p>
								</div>
								<div class="pm-col3">
									<span>Last Message: {{ Message::find($thread->id)->created_at->diffForHumans() }}</span>
								</div>
							</li>
					</a>
				@endforeach
			@endif
		</ul>
	</div>

@stop