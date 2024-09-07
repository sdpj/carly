@section('content')

@include('admin.panel')

<h1 class="title">Edit User ({{ $user->username }})<a href="{{ url('/admin/users') }}" class="back-to-btn btn-submit">Back to Manage Users</a></h1>

@if ($errors->any())

  <div class="well error-well">
    <ul>
      {{ implode('', $errors->all('<li>:message</li>')) }}
    </ul>
  </div>

@endif

@if( Session::has('success') )

  <div class="well success-well">
    <p>This user has been successfully updated</p>
  </div>

@endif 

<a href="{{ url('/user/profile/'.$user->id.'') }}" class="btn-block btn-submit btm">View Public Profile</a>

<h3 class="subtitle">Change User Information</h3>

{{ Form::open(array('url' => '/admin/changeuser/'.$id.'', 'autocomplete' => 'off'))}}

  {{ Form::label('username', 'Username'); }}
  {{ Form::text('username', $user->username, array('class' => 'fw', 'placeholder' => 'Username')) }}

  {{ Form::label('email', 'E-Mail Address'); }}
  {{ Form::text('email', $user->email, array('class' => 'fw', 'placeholder' => 'E-Mail address')) }}

  {{ Form::submit('Save User Information', array('class' => 'btn-block btn-submit btm')) }}

{{ Form::close() }}

<h3 class="subtitle">Change User Password</h3>

{{ Form::open(array('url' => '/admin/changepassword', 'autocomplete' => 'off'))}}

  {{ Form::label('newpassword', 'New Password'); }}
  {{ Form::password('newpassword', array('class' => 'fw', 'placeholder' => 'New Password')) }}

  {{ Form::label('newpassword_confirm', 'Confirm New Password'); }}
  {{ Form::password('newpassword_confirm', array('class' => 'fw', 'placeholder' => 'Confirm New Password')) }}

  {{ Form::submit('Save User Password', array('class' => 'btn-block btn-submit')) }}

{{ Form::close() }}

@stop