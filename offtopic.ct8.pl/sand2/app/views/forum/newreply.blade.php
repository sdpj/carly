@section('content')

@include('forum.panel')

<div class="forum-category">
	<div class="forum-category-head">
		<span>Posting a new reply to {{{ $thread->title }}}</span>
	</div>

	<div id="forum-new-thread-container"> 

		@if ($errors->any())

			<div class="well error-well">
				<ul>
					{{ implode('', $errors->all('<li>:message</li>')) }}
				</ul>
			</div>

		@endif


		@if ($thread->locked == 1)
			<div class="well error-well">
				<p>This thread is locked and as such, you cannot reply to it.</p>
			</div> 
		@else
			{{ Form::open(array('url' => '/forum/thread/'.$id.'/new', 'autocomplete' => 'off'))}}

				{{ Form::label('body', 'Reply Body'); }}
				@if (isset($quote))
					{{ Form::textarea('body', $quote, array('class' => 'fw', 'placeholder' => 'Reply Body...')) }}
				@else
					{{ Form::textarea('body', '', array('class' => 'fw', 'placeholder' => 'Reply Body...')) }}
				@endif

				{{ Form::submit('Post Reply to '.$thread->title.'', array('class' => 'btn-block btn-submit')) }}

			{{ Form::close() }}
		@endif

	</div>

</div>

@stop

@stop