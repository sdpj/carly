@section('content')

@include('admin.panel')

<h1 class="title">
  Manage Users (by E-Mail address)
  @if (URL::previous() == url('/'))
    <a href="{{ url('/admin/users') }}" class="back-to-btn btn-submit">Back to Manage Users</a>
  @else
    <a href="{{ URL::previous() }}" class="back-to-btn btn-submit">Back to Manage Users</a>
  @endif
</h1>

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
  		  <td><strong>{{ $user->email }}</strong></td>
        <td>{{ $user->regip }}</td>
  		  <td>{{ $user->created_at->timezone(Auth::user()->timezone)->toDayDateTimeString() }}</td>
  		  <td>{{ $user->getUserRank() }}</td>
  		  <td>
  		  	<a href="#" class="btn-xs blue"><i class="fa fa-user"></i></a>
  		  	<a href="#" class="btn-xs yellow"><i class="fa fa-pencil"></i></a>
  		  	<a href="#" class="btn-xs red"><i class="fa fa-ban"></i></a>
  		  </td>
  	  </tr>
    @endforeach
    </tbody>
  </table>

  {{ $users->links() }}

@else

  <div class="well error-well">
    <p>There are no records for the e-mail address you entered! :(</p>
  </div>

@endif

@stop