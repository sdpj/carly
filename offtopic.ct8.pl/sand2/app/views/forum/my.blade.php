@section('content')

<h1 class="title">My Forums</h1>

<div class="forum-category">
  <div class="forum-category-head">
    <span>Your Recent Threads</span>
  </div>

  @if (count($threads) != 0)

    @foreach ($threads as $thread)

      @if ($thread->seen())
        @if ($thread->sticky == 1)
          <a href="{{ url('/forum/thread/'.$thread->id.'') }}" class="forum-thread sticky">
        @elseif ($thread->locked == 1)
          <a href="{{ url('/forum/thread/'.$thread->id.'') }}" class="forum-thread locked">
        @elseif ($thread->seen()->updated_at > $thread->updated_at)
          <a href="{{ url('/forum/thread/'.$thread->id.'') }}" class="forum-thread">
        @else
          <a href="{{ url('/forum/thread/'.$thread->id.'') }}" class="forum-thread unread">
        @endif
      @else
        <a href="{{ url('/forum/thread/'.$thread->id.'') }}" class="forum-thread unread">
      @endif
        <div class="forum-thread-inside">
          <div class="pull-left">
            @if ($thread->sticky == 1)
              <i class="fa fa-thumb-tack"></i>
            @elseif ($thread->locked == 1)
              <i class="fa fa-lock"></i>
            @else
              <i class="fa fa-file"></i>
            @endif
            @if ($profanity == true)
              <h4>{{{ Filter::filter(str_limit($thread->title, $limit = 80, $end = '...'), '***') }}}</h4>
            @else
              <h4>{{{ str_limit($thread->title, $limit = 80, $end = '...') }}}</h4>
            @endif
          </div>
          <div class="pull-right">
            <span>
            <strong>Poster:</strong> {{{ User::find($thread->user_id)->username }}} |
            <strong>Replies:</strong> {{{ count($thread->thread) - 1 }}} | 
            <strong>Last Post by:</strong> 
            @if ($thread->thread->last())
              {{{ User::find($thread->thread->last()->user_id)->username }}}

              @if ($thread->thread->last()->created_at->diffInDays() > 1)
                <i>at {{{ $thread->thread->last()->created_at->timezone(Auth::user()->timezone)->toDayDateTimeString() }}}</i>
              @else
                <i>about {{{ $thread->thread->last()->created_at->diffForHumans() }}}</i>
              @endif
            @endif
            </span>
          </div>
          <div class="clear"></div>
        </div>
      </a>

    @endforeach

  @else

    <div class="well forum-well">
      <p>There are no threads to show here! :(</p>
    </div>

  @endif

  {{ $threads->links() }}
</div>

@stop