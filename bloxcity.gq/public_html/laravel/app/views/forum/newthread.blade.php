@section('content')

@include('forum.panel')

<div class="forum-category">
	<div class="forum-category-head">
		<span>Posting a new thread in {{{ $category->name }}}</span>
	</div>

	<div id="forum-new-thread-container"> 

		@if ($errors->any())

			<div class="well error-well">
				<ul>
					{{ implode('', $errors->all('<li>:message</li>')) }}
				</ul>
			</div>

		@endif

		{{ Form::open(array('url' => '/forum/topic/'.$id.'/new', 'autocomplete' => 'off'))}}

			{{ Form::label('title', 'Thread Title'); }}
			{{ Form::text('title', '', array('class' => 'fw', 'placeholder' => 'Thread Title...')) }}

			{{ Form::label('body', 'Thread Body'); }}
			{{ Form::textarea('body', '', array('class' => 'fw', 'placeholder' => 'Thread Body...')) }}

			{{ Form::submit('Post Thread to '.$category->name.'', array('class' => 'btn-block btn-submit')) }}

		{{ Form::close() }}

	</div>

</div>

@stop

@stop