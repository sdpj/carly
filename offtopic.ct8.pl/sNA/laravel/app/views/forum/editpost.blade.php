@section('content')

@include('forum.panel')

<div class="forum-category">
	<div class="forum-category-head">
		<span>Edit post</span>
	</div>

	<div id="forum-new-thread-container"> 

		@if ($errors->any())

			<div class="well error-well">
				<ul>
					{{ implode('', $errors->all('<li>:message</li>')) }}
				</ul>
			</div>

		@endif

		{{ Form::open(array('url' => '/forum/post/'.$post->id.'/edit', 'autocomplete' => 'off'))}}

			{{ Form::label('body', 'Post Body'); }}
			{{ Form::textarea('body', $post->body, array('class' => 'fw', 'placeholder' => 'Post Body...')) }}

			{{ Form::submit('Submit edition', array('class' => 'btn-block btn-submit')) }}

		{{ Form::close() }}

	</div>

</div>

@stop

@stop