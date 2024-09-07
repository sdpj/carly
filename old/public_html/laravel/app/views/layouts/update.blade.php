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
	
	<title>{{{ $title }}} - SANS 2.0</title>
</head>
<body>

@if ($title == "Complete")
    <div id="container" class="center updater2">
@else
    <div id="container" class="center updater">
@endif

    @yield('content')

    <div id="footer">
        <div class="pull-left">
            <span>SANS 2.0</span>
        </div>
        <div class="pull-right">
            @if ($title == "Complete")
                <span class="complete">Welcome -> Updating -> </span><span class="current">Complete</span>
            @else
                <span class="current">Welcome</span><span> -> Updating -> Complete</span>
            @endif
        </div>
    </div>

</div>

</body>
</html>