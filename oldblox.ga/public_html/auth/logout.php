<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	if(!$User){
		header("Location: /Landing/Animated/");
		die();
	}
	session_destroy();
	echo"
	<META HTTP-EQUIV=Refresh CONTENT='3; URL=/Landing/Animated/'>
	<div class='logout-page'>
		<img src='/auth/img/logout-loader.GIF'>
		<div id='alertTextTop'>
			Logging you out...
		</div>
		<div id='alertTextBottom'>
Please wait, securely logging you out.
		</div>
	</div>

	";
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>