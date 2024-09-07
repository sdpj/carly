@section('content')

@include('admin.panel')

<h1 class="title">Ban User ({{ $user->username }})</h1>

@if ($errors->any())
	<div class="well error-well">
		<ul>
			{{ implode('', $errors->all('<li>:message</li>')) }}
		</ul>
	</div>
@endif

{{ Form::open(array('url' => '/admin/ban/'.$user->id, 'autocomplete' => 'off'))}}

	{{ Form::label('length', 'Ban Length') }}
	{{ Form::select('length', ['warning' => 'Warning', '1_day' => '1 Day', '3_day' => '3 Days', '7_day' => '1 Week', '14_day' => '2 Weeks', '1_month' => '1 Month', 'permanent' => 'Permanent'], '', array('class' => 'default fw')) }}

	{{ Form::label('reason', 'Ban Reason'); }}
	{{ Form::text('reason', '', array('class' => 'fw', 'placeholder' => 'Ban Reason')) }}

	{{ Form::submit('Ban '.$user->username, array('class' => 'btn-block btn-submit')) }}

{{ Form::close() }}

@stop
@section('additional-js')
<script src="//cdn.jsdelivr.net/dropkick/1.4/jquery.dropkick-min.js"></script>
@stop
@section('additional-jquery')
$('.default').dropkick();
@stop