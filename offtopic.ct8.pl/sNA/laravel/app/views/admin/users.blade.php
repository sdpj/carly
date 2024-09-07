@section('content')

@include('admin.panel')

<h1 class="title">Manage Users</h1>

@if ($errors->any())

  <div class="well error-well">
    <ul>
      {{ implode('', $errors->all('<li>:message</li>')) }}
    </ul>
  </div>

@endif

{{ Form::open(array('url' => '/admin/users', 'autocomplete' => 'off'))}}

  {{ Form::label('username', 'Username'); }}
  {{ Form::text('username', '', array('class' => 'search-input fw', 'placeholder' => 'Username')) }}

  {{ Form::submit('Search by Username', array('class' => 'search-btn btn-submit')) }}

{{ Form::close() }}

@if (count($users) != 0)

  <table id="manage-users">
    <thead>
    <tr>
    <th><strong>Username</strong></th>
    <th><strong>E-Mail Address</strong></th>
    <th><strong>Registration IP Address</strong></th>
    <th><strong>Creation Date</strong></th>
    <th><strong>User Rank</strong></th>
    <th><strong>Actions</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
  	  <tr>
  		  <td>{{ $user->username }}</td>
  		  <td><a href="{{url('/admin/email/'.$user->email.'')}}">{{ $user->email }}</a></td>
        <td><a href="{{url('/admin/ip/'.$user->regip.'')}}">{{ $user->regip }}</a></td>
  		  <td>{{ $user->created_at->timezone(Auth::user()->timezone)->toDayDateTimeString() }}</td>
  		  <td>{{ $user->getUserRank() }}</td>
  		  <td>
  		  	<a href="{{ url('/user/profile/'.$user->id.'') }}" class="btn-xs blue"><i class="fa fa-user"></i></a>
  		  	<a href="{{ url('/admin/edituser/'.$user->id.'') }}" class="btn-xs yellow"><i class="fa fa-pencil"></i></a>
  		  	<a href="#" class="btn-xs red"><i class="fa fa-ban"></i></a>
  		  </td>
  	  </tr>
    @endforeach
    </tbody>
  </table>

  {{ $users->links() }}

@else
  <div class="well error-well">
    <p>There are no users matching this criteria! :(</p>
  </div>
@endif

@stop