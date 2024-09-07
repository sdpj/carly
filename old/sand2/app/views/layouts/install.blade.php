<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=1280"/>

    <script src="//use.edgefonts.net/lato:n1,i1,n3,i3,n4,i4,n7,i7,n9,i9.js"></script>

	<link rel="stylesheet" type="text/css" href="{{ asset('media/install/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

	@yield('additional-css')
	
	<title>{{{ $title }}} - SANS 2.0</title>
</head>
<body>

@if (Request::is('install/installing') || Request::is('install/complete'))
<div id="container" class="center installing">
@else
<div id="container" class="center">
@endif

    @yield('content')

    <div id="footer">
        <div class="pull-left">
            <span>SANS 2.0</span>
        </div>
        <div class="pull-right">
            @if (Request::is('install'))
                <span class="current">Welcome</span><span> -> Database Information -> Installing -> Site Metadata -> Admin Account -> Complete</span>
            @elseif (Request::is('install/step2'))
                <span class="complete">Welcome -> </span><span class="current">Database Information</span><span> -> Installing -> Site Metadata -> Admin Account -> Complete</span>
            @elseif (Request::is('install/installing'))
                <span class="complete">Welcome -> Database Information -></span><span class="current"> Installing </span><span>-> Site Metadata -> Admin Account -> Complete</span>
            @elseif (Request::is('install/step3'))
                <span class="complete">Welcome -> Database Information -> Installing -> </span><span class="current">Site Metadata</span><span> -> Admin Account -> Complete</span>
            @elseif (Request::is('install/step4'))
                <span class="complete">Welcome -> Database Information -> Installing -> Site Metadata -> </span><span class="current">Admin Account</span><span> -> Complete</span>
            @endif
        </div>
    </div>

</div>


<!-- Javascript placed at bottom of the file for quicker page load -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
@yield('additional-js')
<script type="text/javascript">
    @yield('additional-script')
	$(document).ready(function() {
		@yield('additional-jquery')
	});
</script>
</body>
</html>