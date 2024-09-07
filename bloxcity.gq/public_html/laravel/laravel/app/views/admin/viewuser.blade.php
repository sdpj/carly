@section('content')

@include('admin.panel')

<h1 class="title">View User ({{ $user->username }})</h1>

<a href="{{ url('/user/profile/'.$user->id.'') }}" class="btn-block btn-submit">View Public Profile</a>

@stop