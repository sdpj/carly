@section('content')

@if( Session::has('restore-success') )
	<div class="well success-well">
		<p>This thread has been successfully restored! <a href="{{ url(''.Request::url().'/delete') }}">(undo this action)</a></p>
	</div>
@endif 
@if( Session::has('lock-success') )
	<div class="well success-well">
		<p>This thread has now been locked! <a href="{{ url(''.Request::url().'/unlock') }}">(undo this action)</a></p>
	</div>
@endif 
@if( Session::has('unlock-success') )
	<div class="well success-well">
		<p>This thread has now been unlocked! <a href="{{ url(''.Request::url().'/lock') }}">(undo this action)</a></p>
	</div>
@endif 
@if( Session::has('sticky-success') )
	<div class="well success-well">
		<p>This thread is now a sticky thread! <a href="{{ url(''.Request::url().'/unsticky') }}">(undo this action)</a></p>
	</div>
@endif 
@if( Session::has('unsticky-success') )
	<div class="well success-well">
		<p>This thread is no longer a sticky! <a href="{{ url(''.Request::url().'/sticky') }}">(undo this action)</a></p>
	</div>
@endif 
@if( Session::has('move-thread-success') )
	<div class="well success-well">
		<p>This thread has been moved to <strong>{{{ ForumTop::find($thread->topic)->name }}}</strong>!</p>
	</div>
@endif 
@if( Session::has('delete-success') )
	<div class="well success-well">
		<p>The selected post has been deleted!</p>
	</div>
@endif 

@include('forum.panel')

<div class="forum-category">
	<div class="forum-category-head">
		@if ($profanity == true)
			<span>{{{ Filter::filter(str_limit($thread->title, $limit = 50, $end = '...'), '***') }}}</span>
		@else
			<span>{{{ str_limit($thread->title, $limit = 50, $end = '...') }}}</span>
		@endif
	</div>

	<?php $counter = 0; ?>
	@foreach ($posts as $post)
		<?php $counter++ ?>

		<div class="forum-post">
			<div class="forum-post-user pull-left">
				<img src="{{$post->poster->getAvatarURL()}}">
				<br>
				<span class="username"><a href="{{ url('/user/profile/'.$post->user_id.'') }}">{{ $post->poster->username }}</a></span>
				{{ $post->poster->getUserRank() }}
				<span class="forum-posts">Forum Posts: <strong>{{ ForumPos::where('user_id', '=', $post->user_id)->count() }}</strong></span>
			</div>

			<div class="forum-post-content pull-right">
				<input type="hidden" class='post-id' value='{{ $post->id }}'>
				<a name="post-{{ $post->id }}"></a>
				@if ($profanity == true)
					<span class="pull-left">{{{ Filter::filter(str_limit($thread->title, $limit = 50, $end = '...'), '***') }}}</span>
				@else
					<span class="pull-left">{{{ str_limit($thread->title, $limit = 50, $end = '...') }}}</span>
				@endif
				<span class="pull-right">
					@if (Auth::check() && $post->created_at->diffInDays() > 1)
						Posted on {{ $post->created_at->timezone(Auth::user()->timezone)->toDayDateTimeString() }}
					@else
						Posted around {{ $post->created_at->diffForHumans() }}
					@endif
				</span>
				<div class="clear"></div>
				<hr>
				<div class="content">
					{{ nl2br($post->parseBBCode()) }}
					@if ($post->scrubbed_body && Auth::check() && Auth::user()->hasRole('Administrator'))
						<blockquote>
							{{ nl2br(e($post->scrubbed_body)) }}
						</blockquote>
					@endif
					@if ($post->old_body && Auth::check() && Auth::user()->hasRole('Administrator'))
						<blockquote>
							{{ nl2br(e($post->old_body)) }}
							<br>
							<strong style="font-size:12px;">Edited by {{{ User::find($post->post_editor)->username }}} about {{{ $post->updated_at->diffForHumans() }}}</strong>
						</blockquote>
					@endif
				</div>

				<hr>
				<span class="signature">
					
					@if (User::find($post->user_id)->signature)
						{{{ User::find($post->user_id)->signature }}}
					@else
						Hello, I'm {{{ User::find($post->user_id)->username }}}!
					@endif

				</span>
				@if (Auth::check())
					<hr>
					<div id="forum-panel" class="post-mod">
						<div class="pull-right">
							<a href="{{ url('/forum/thread/'.$thread->id.'/new/quote/'.$post->id) }}" class="btn-normal blue"><i class="fa fa-quote-right"></i>Quote Post</a>
						</div>
					</div>
				@endif
				@if (Auth::check() && Auth::user()->hasRole('Administrator'))
					<hr>
					<div id="forum-panel" class="post-mod">
						<div class="pull-left">
							@if ($post->scrubbed_body)
								<a href="{{ url('/forum/post/'.$post->id.'/unscrub') }}" class="btn-normal yellow"><i class="fa fa-gavel"></i>Unscrub Post</a>
							@else
								<a href="{{ url('/forum/post/'.$post->id.'/scrub') }}" class="btn-normal yellow"><i class="fa fa-gavel"></i>Scrub Post</a>
							@endif
							<a href="{{ url('/forum/post/'.$post->id.'/edit') }}" class="btn-normal blue"><i class="fa fa-pencil"></i>Edit Post</a>
						</div>
						<div class="pull-right">
							@if ($counter != 1)
								<a href="{{ url('/forum/post/'.$post->id.'/delete') }}" class="btn-normal red"><i class="fa fa-trash"></i>Delete Post</a>
							@endif
						</div>
					</div>
				@endif
			</div>
			<div class="clear"></div>
		</div>
	@endforeach
	<a name="last"></a>
</div>

{{ $posts->links() }}

@if ($thread->locked == 1)
	<div class="well error-well">
		<p>This thread is locked; you cannot reply to it.</p>
	</div>
@endif

@include('forum.panel')

@if (Auth::check() && Auth::user()->hasRole('Administrator'))
	@include('forum.adminpanel')
@endif

@stop