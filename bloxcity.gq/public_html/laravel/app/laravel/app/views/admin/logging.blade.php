@section('content')

@include('admin.panel')

<h1 class="title">Logging</h1>

@if (count($logs) != 0)

  <table id="manage-users">
    <thead>
      <tr>
        <th><strong>ID</strong></th>
        <th><strong>Type</strong></th>
        <th><strong>Username</strong></th>
        <th><strong>IP Address</strong></th>
        <th><strong>Old Data</strong></th>
        <th><strong>New Data</strong></th>
        <th><strong>Date / Time</strong></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($logs as $log)
    	  <tr>
          <td>{{ $log->id }}</td>
    		  <td>{{ $log->type }}</td>
    		  <td><a href="{{url('/user/profile/'.$log->user_id)}}">{{ User::find($log->user_id)->username }}</a></td>
          <td>{{ $log->ip }}</td>
    		  <td>{{ $log->old_data }}</td>
    		  <td>{{ $log->new_data }}</td>
    		  <td>{{ $log->created_at->timezone(Auth::user()->timezone)->toDayDateTimeString() }}</td>
    	  </tr>
      @endforeach
    </tbody>
  </table>

  {{ $logs->links() }}

@else
  <div class="well error-well">
    <p>There are no logs matching this criteria!</p>
  </div>
@endif

@stop