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
            <span><img src="/lowgo.png" style="width:140px;"></span>
        </a>
        <div id="navigation" class="pull-left">
            <a href="{{ url('/user/members') }}">Users</a>
            <a href="{{ url('/store') }}">Market</a>
            <a href="{{ url('/forum') }}">Forum</a>
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
                <a href="{{ url('/user/economy') }}"><i class="fa fa-dot-circle-o currency_1" style="margin-right:3px!important;"></i>{{ Auth::user()->currency_1 }}</a>
                @if (Auth::user()->hasRole('Administrator'))
                    <a href="{{ url('/admin/dashboard') }}">Admin</a>
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
            <style>.site-footer {
    width: 100%;
    background: white; box-shadow: 0 1px 2px #aaa;
}</style><div class="site-footer">
<div style="padding-top: 15px;">
<div class="center-align" style="text-align:center;">
<img src="http://web.archive.org/web/20170921221304im_/https://www.brickplanet.com/assets/images/BCIcon.png" style="height: 55px; padding-top: 10px;">
<div style="font-size: 16px; color: black; font-weight: 300;">© {{ date("Y") }} {{{ $sitename }}}. All rights reserved.</div>
<div style="height: 10px;"></div>
<div>
<a href="http://bloxcity.gq/user_img/place.php">Terms</a>&nbsp;&nbsp;&nbsp;
<a href="http://bloxcity.gq/user_img/place.php" class="footer-link">Privacy</a>&nbsp;&nbsp;&nbsp;
<a href="http://bloxcity.gq/user_img/place.php" class="footer-link">About</a>&nbsp;&nbsp;&nbsp;
<!--<a href="http://bloxcity.gq/user_img/place.php" class="footer-link">Jobs</a>&nbsp;&nbsp;&nbsp;-->
<a href="http://bloxcity.gq/user_img/place.php" class="footer-link">Team</a>&nbsp;&nbsp;&nbsp;
<!--<a href="http://web.archive.org/web/20200401161023/https://corp.bloxcity.com/contact" class="footer-link">Contact</a>-->
</div>
</div>
</div>
</div><br>
        @else
            
      
      
      
      <style>.site-footer {
    width: 100%;
    background: white; box-shadow: 0 1px 2px #aaa;
}</style><div class="site-footer">
<div style="padding-top: 15px;">
<div class="center-align" style="text-align:center;">
<img src="http://web.archive.org/web/20170921221304im_/https://www.brickplanet.com/assets/images/BCIcon.png" style="height: 55px; padding-top: 10px;">
<div style="font-size: 16px; color: black; font-weight: 300;">© {{{ $install_time->year }}} - {{ date("Y") }} {{{ $sitename }}}. All rights reserved.</div>
<div style="height: 10px;"></div>
<div>
<a href="/web/20200401161023/https://www.bloxcity.com/notes/tos" class="footer-link">Terms</a>&nbsp;&nbsp;&nbsp;
<a href="/web/20200401161023/https://www.bloxcity.com/notes/privacy" class="footer-link">Privacy</a>&nbsp;&nbsp;&nbsp;
<a href="http://web.archive.org/web/20200401161023/https://corp.bloxcity.com/" class="footer-link">About</a>&nbsp;&nbsp;&nbsp;
<!--<a href="http://web.archive.org/web/20200401161023/https://corp.bloxcity.com/join-our-team" class="footer-link">Jobs</a>&nbsp;&nbsp;&nbsp;-->
<a href="http://web.archive.org/web/20200401161023/https://corp.bloxcity.com/#team" class="footer-link">Team</a>&nbsp;&nbsp;&nbsp;
<!--<a href="http://web.archive.org/web/20200401161023/https://corp.bloxcity.com/contact" class="footer-link">Contact</a>-->
</div>
</div>
</div>
</div><br>
      
        @endif
        <!--<span class="pull-right">Proudly powered by <a href="http://getsans.com"><strong>Social Avatar Network Script (SANS)</strong></a></span>-->
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