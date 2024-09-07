@section('content')

@include('forum.panel')

@foreach ($categories as $category)

	<div class="forum-category">
		<div class="forum-category-head">
			<span>{{{ $category->name }}}</span>
		</div>

		@foreach ($category->topic as $topic)
			<a href="{{ url('/forum/topic/'.$topic->id.'') }}" class="forum-topic">
				<h2>{{{ $topic->name }}}</h2>
				<p>{{{ $topic->description }}}</p>
				<span><strong>Threads in this Topic:</strong> {{{ count($topic->topic) }}}</span>
			</a>
		@endforeach

	</div>

@endforeach

@stop