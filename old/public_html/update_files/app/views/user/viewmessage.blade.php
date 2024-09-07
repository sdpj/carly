@section('content')

	<h1 class="title">Messages from {{$sender->username}}</h1>

	{{Form::open(['url'=>'user/pm/send/' . $sender->id, 'id'=>'send_form'])}}
		{{Form::textarea('reply', '', ['class'=>'pm-reply', 'rows'=>'3'])}}
		{{Form::submit('Send Message', ['id'=>'send_message','class'=>'btn-block btn-submit pm-reply'])}}
	{{Form::close()}}

	<div id="pm-messages">
		<div id='pm-messages-content'>
		@if (count($messages) == 0)
			<div class="well" id="no-messages">
				<p>There's been no messages sent between you and <strong>{{$sender->username}}</strong> - why don't you send one?</p>
			</div> 
		@else
			@foreach ($messages as $message)
				@if ($message->sender_id == Auth::user()->id)
				<div class="pm-message right">
					<span>{{nl2br($message->message)}}</span>
					<i>Sent about {{$message->created_at->diffForHumans()}}</i>
				@else
				<div class="pm-message left">
					<span>{{nl2br($message->message)}}</span>
					<i>Received about {{$message->created_at->diffForHumans()}}</i>
				@endif
					
				</div>
			@endforeach
		@endif
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="clear"></div>

@stop

@section('additional-jquery')
	$('#send_form').submit(function(e) {
		e.preventDefault();

		var reply = $('textarea.pm-reply');
		var text = reply.val();

		if (text.trim() == '') { return; }
		reply.val('');

		$.ajax(
			"{{url('user/pm/send/'.$sender->id)}}",
			{
				type: 'POST',
				success: function(data) {
					
                    if ($(".pm-message").length != 1)
                    {
                    	$("#no-messages").fadeOut(500).remove();
                    }

					var msg = $('<div class="pm-message right"></div>');
					msg.html('<span>' + text + '</span><i>Sent on ' + data + '</i>');
					$('#pm-messages-content').prepend(msg);
				},
				data: {reply:text}
			}
		);
	});
@stop