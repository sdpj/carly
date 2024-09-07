@section('content')

@if( Session::has('complete_reg') )

	<div class="well success-well">
		<p>Your account is complete!</p>
	</div>

@endif 

@if( Session::has('activated') )

	<div class="well success-well">
		<p>Your account has been successfully activated!</p>
	</div>

@endif 

<div id="feed-top">
	<div id="feed-prev-av">
		<img src="{{ url(Auth::user()->getAvatarURL()) }}">
	</div>
	<div id="feed-chat-row">
		<h2 class="welcome-back">Welcome back, <span>{{ Auth::user()->username }}</span> {{ Auth::user()->getUserRank() }}</h2>
		@if (Auth::user()->activated == 0)
            <div class="well error-well">
                <span>You must verify your e-mail address to send chat messages!</span>
            </div>  
        @else
            {{ Form::open(array('url' => '/user/sendmessage', 'autocomplete' => 'off'))}}
    			{{ Form::textarea('message', '', array('placeholder' => 'Type your chat message here...', 'id' => 'message', 'maxlength' => 255)) }}
    			{{ Form::submit('Post Chat Message', array('class' => 'btn-block btn-submit')) }}
    		{{ Form::close() }}
        @endif
	</div>
</div>

<div id="feed-messages"></div>

@stop
@section('additional-script')

instance = false;

function loadChat() {
    $.ajax({
        type: "POST",
        url: "/user/fetchmessages",
        data: {
            'function': 'initialLoad'
        },
        dataType: "html",
        success: function(data) {
        	$('#feed-messages').append($(data));
        }
    });
}

function getStateOfChat() {
    if (!instance) {
        instance = true;
        $.ajax({
            type: "POST",
            url: "/user/fetchmessages",
            data: {
                'function': 'getState'
            },
            dataType: "json",
            success: function(data) {
                state = data.state;
                instance = false;
            }
        });
    }
}

function updateChat() {
    if (!instance) {
        instance = true;
        $.ajax({
            type: "POST",
            url: "/user/fetchmessages",
            data: {
                'function': 'update',
                'state': state
            },
            success: function(data) {
            	state = state + 1;
				try{
					$('#feed-messages').prepend($(data));
                    $('#feed-messages div.message').first().hide().fadeIn(500);
                    if ($(".message").length == 26)
                    {
                    	$("#feed-messages div.message").last().fadeOut(500).remove();
                    }
				} catch(e){
					state = state - 1;
				}
                instance = false;
            }
        });
    } else {
        setTimeout(updateChat, 1500);
    }
}

$(function() {

    loadChat();
    getStateOfChat();
    updateChat();
    setInterval('updateChat()', 1000);

    jQuery('textarea').keydown(function(event) {
        if (event.keyCode == 13) {
            $(this.form).submit();
            $('textarea').val('');
            $('textarea').text('');
            return false;
        }
    });

    $('form').on('submit', function(e) {

        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/user/sendmessage',
            data: $('form').serialize(),
            success: function(data) {
                updateChat();
            }
        });

        $('textarea').val('');
        $('textarea').text('');

    });

});
@stop