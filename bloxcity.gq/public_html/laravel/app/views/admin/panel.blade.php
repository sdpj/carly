@section('additional-css')
<link rel="stylesheet" type="text/css" href="{{ asset('media/css/admin.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('media/themes/default/css/admin.css') }}">
<link rel="stylesheet" href="//cdn.jsdelivr.net/dropkick/1.4/dropkick.css">
@stop

<div id="forum-panel">
	<div class="pull-left">
		<a href="{{ url('/admin/config') }}"><i class="fa fa-cog"></i>Configuration</a>
		<a href="{{ url('/admin/logging') }}"><i class="fa fa-files-o"></i>Logging</a>
		<a href="{{ url('/admin/alerts') }}"><i class="fa fa-exclamation"></i>Alerts</a>
	</div>
	<div class="pull-right">
		<a href="{{ url('/admin/economy') }}"><i class="fa fa-money"></i>Economy</a>
		<a href="{{ url('/admin/badges') }}"><i class="fa fa-tags"></i>Badges</a>
		<a href="{{ url('/admin/users') }}"><i class="fa fa-users"></i>Users</a>
	</div>
</div>