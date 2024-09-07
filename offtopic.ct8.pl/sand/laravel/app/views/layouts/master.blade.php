<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=1280"/>
    
    <meta name="description" content="{{ $sitedescription }}"/>
    <meta name="keywords" content=""/>

    <link rel="icon" href="{{ asset('media/img/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('media/img/favicon.png') }}" type="image/x-icon">

	<link rel="stylesheet" type="text/css" href="{{ asset('media/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    @if (empty($sitetheme))
        <link rel="stylesheet" type="text/css" href="{{ asset('media/themes/default/css/theme.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('media/themes/'.$sitetheme.'/css/theme.css') }}">
    @endif

	@yield('additional-css')
	
	<title>{{{ $title }}} - {{{ $sitename }}}</title>
</head>
<body class="preload">

<div id="topbar">
    <div class="container">
        <a href="{{ url('/') }}" class="sitename">
            <span>{{ $sitename }}</span>
        </a>
        <div id="navigation" class="pull-left">
            <a href="{{ url('/user/members') }}">Members</a>
            <a href="{{ url('/store') }}">Store</a>
            <a href="{{ url('/forum') }}">Forums</a>
        </div>
        <div id="user-actions" class="pull-right">
            @if (Auth::check())
                <ul id="menu1" class="menu dropit pull-right">
                    <li class="dropit-trigger">
                        <a href="#">{{ Auth::user()->username }}</a>
                        <ul class="dropit-submenu" style="display: none;">
                            <li><a href="{{ url('/user/settings') }}">My Account</a></li>
                            <li><a href="{{ url('/user/profile/'.Auth::user()->id.'') }}">View Profile</a></li>
                            <li><a href="{{ url('/user/inventory') }}">Change Avatar</a></li>
                            <li><a href="{{ url('/user/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="{{ url('/user/notifications') }}"><i class="fa fa-exclamation notification_count"></i>{{ Auth::user()->countNotifications() }}</a>
                <a href="{{ url('/user/inbox') }}"><i class="fa fa-envelope pm"></i>{{ Auth::user()->getNumberOfMessages() }}</a>
                <a href="{{ url('/user/economy') }}"><i class="fa fa-circle currency_1"></i>{{ Auth::user()->currency_1 }}</a>
                @if (Auth::user()->hasRole('Administrator'))
                    <a href="{{ url('/admin/dashboard') }}">ACP</a>
                @endif
            @else
                <a href="{{ url('/user/register') }}">Register</a>
                <a href="{{ url('/user/signin') }}">Sign In</a>
            @endif
        </div>
    </div>
</div>	

<div class="container main-content">

    @if ($invalid_license)
        <div class="alert-bar danger">
            <span>The SANS license key for this domain is invalid. The relevant team has been alerted; <a href="http://getsans.com/">purchase a license</a> now to avoid legal action!</span>
        </div> 
    @endif

    @if (Auth::check())
        @if (Auth::user()->activated != 1)
            <div class="alert-bar danger">
                <span>Your account is not verified; some site features are disabled until you <a href="{{ url('/user/verify') }}">verify your e-mail address</a>!</span>
            </div> 
        @endif
    @endif

    @foreach (Alert::orderBy('created_at', 'DESC')->get() as $alert)

        <div class="alert-bar {{ $alert->type }}">
            <span>{{ $alert->text }}</span>
        </div>

    @endforeach

    <div id="content">
        @yield('content')
    </div>
</div>

<div id="footer">
    <div class="container">
        @if ($install_time->year == date("Y"))
            <span class="pull-left">&copy; Copyright {{ date("Y") }}; <strong>{{{ $sitename }}}</strong> - All Rights Reserved</span>
        @else
            <span class="pull-left">&copy; Copyright {{{ $install_time->year }}} - {{ date("Y") }}; <strong>{{{ $sitename }}}</strong> - All Rights Reserved</span>
        @endif
        <span class="pull-right">Proudly powered by <a href="http://getsans.com"><strong>Social Avatar Network Script (SANS)</strong></a></span>
        <div class="clear"></div>
    </div>
</div>

<!-- Javascript placed at bottom of the file for quicker page load -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('media/js/dropdown.js') }}"></script>
@yield('additional-js')
<script type="text/javascript">
    window.addEventListener( 'load',
    function load()
    {
    window.removeEventListener('load', load, false);
    document.body.classList.remove('preload');
    }
    , false);
    @yield('additional-script')
	$(document).ready(function() {
        $('.menu').dropit();
		@yield('additional-jquery')
	});
</script>
</body>
</html>