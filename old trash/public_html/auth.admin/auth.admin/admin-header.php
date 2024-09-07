<?
	include($_SERVER['DOCUMENT_ROOT'].'/Global.php');
	
	if(!$User){
		header("Location: http://avatar-gamer.ga/Error/?code=404");
		die();
	}
	
	if($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"){
		
	
	
	$AdminSession = $_SESSION['AdminSession'];
	
	if(!$AdminSession && $_SERVER['PHP_SELF'] != '/auth.admin/login.php'){
		header("Location: http://avatar-gamer.ga/auth.admin/login.aspx");
		die();
	}
	
	echo'<LINK href="http://avatar-gamer.ga/auth.admin/style/style.css" rel="stylesheet" type="text/css"><LINK href="http://avatar-gamer.ga/Base/Style/Main.css" rel="stylesheet" type="text/css">';
	
	echo"<title>Avatar-Universe | Administration</title>
	<div class='site-header'>
		<div id='navigation-container'>
			<a href='http://avatar-gamer.ga/'>
				<img src='http://avatar-gamer.ga/Images/world2build.png' width='190' height='35' style='margin-bottom:2px;margin-right:15px;vertical-align:bottom;'>
			</a>
		</div>
	</div>
	<div style='margin-top:40px'></div>
	<div id='Container' style='border:0;min-height:550px'>
	<center>
		<a href='../index.aspx?admin=return'>
			<img src='http://avatar-gamer.ga/auth.admin/img/adminpanel.png'>
		</a>
		<br />
		<font style='font-size:18px;color:#363636;font-weight:bold;'>
			Administration Panel v.3
		</font>
	</center>
	<div style='padding-top:30px;'></div>
	";
	
	if($_SERVER['PHP_SELF'] != "/auth.admin/login.php"){
$getAds = mysql_query("SELECT * FROM UserAdvertisments WHERE Approved='0'");
$numAds = mysql_num_rows($getAds);
$getPending = mysql_query("SELECT * FROM UserStore WHERE active='0'");
$ItemsPending = mysql_num_rows($getPending);
$totalImages = $numAds+$ItemsPending;
		echo"
		<div id='StandardBox'>
				<b>User Logged:</b> ".$myU->Username." (ID: ".$myU->ID.")
				<font style='margin-left:15px;'></font>
				<font style='float:right;'>
				<a href='site-config.aspx'>
					Site
				</a>
				&nbsp;&nbsp;
				<a href='user-search.aspx'>
					User Search
				</a>
				&nbsp;&nbsp;
				<a href='ImageModeration/index.aspx'>
					Image Moderation
				</a><font color='red'><b>($totalImages)</b></font>
				&nbsp;&nbsp;
				<a href='websitelogs.aspx'>
					Logs
				</a>
				&nbsp;&nbsp;
				<a href='site-config.aspx'>
					Economy
				</a>
				&nbsp;&nbsp;
				<a href='site-config.aspx'>
					Message Logs
				</a>
				";
				
		echo"</font>
		</div>
		"; 
	}}
	else{
		header("Location: http://avatar-gamer.ga/Error/?code=500");
		die();
	}
?>