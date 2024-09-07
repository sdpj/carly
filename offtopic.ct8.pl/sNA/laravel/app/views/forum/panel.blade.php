<div id="forum-panel">
	<div class="pull-left">
		@if (Request::is('forum/topic/*/new'))
			<a href="{{ url('/forum/topic/'.$id.'') }}"><i class="fa fa-arrow-left"></i>Back a Page</a>
		@elseif (Request::is('forum/topic/*'))
			<a href="{{ url('/forum') }}"><i class="fa fa-arrow-left"></i>Back a Page</a>
		@elseif (Request::is('forum/thread/*'))
			<a href="{{ url('/forum/topic/'.$thread->topic.'') }}"><i class="fa fa-arrow-left"></i>Back a Page</a>
		@elseif (Request::is('forum/post/*/edit'))
			<a href="{{ url('/forum/thread/'.$post->thread.'') }}"><i class="fa fa-arrow-left"></i>Back a Page</a>
		@endif
	</div>
	@if (Auth::check())
		<div class="pull-right">
			@if (Request::is('forum/topic/*'))
				<a href="{{ url('/forum/topic/'.$id.'/new') }}"><i class="fa fa-file"></i>New Thread</a>
			@elseif (Request::is('forum/thread/*'))
				@if ($thread->locked != 1)
					<a href="{{ url('/forum/thread/'.$id.'/new') }}"><i class="fa fa-file"></i>New Reply</a>
				@endif
			@endif
			<a href="{{ url('/forum/my') }}"><i class="fa fa-user"></i>My Forums</a>
		</div>
	@endif
</div>