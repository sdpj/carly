<hr>
<div id="forum-panel" class="post-mod">
	<div class="pull-left">
		@if ($post->scrubbed_body)
			<a href="{{ url('/forum/post/'.$post->id.'/unscrub') }}" class="btn-normal yellow"><i class="fa fa-gavel"></i>Unscrub Post</a>
		@else
			<a href="{{ url('/forum/post/'.$post->id.'/scrub') }}" class="btn-normal yellow"><i class="fa fa-gavel"></i>Scrub Post</a>
		@endif
	</div>
	<div class="pull-right">
		@if ($counter != 1)
			<a href="{{ url('/forum/post/'.$post->id.'/delete') }}" class="btn-normal red"><i class="fa fa-trash"></i>Delete Post</a>
		@endif
	</div>
</div>