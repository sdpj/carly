<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header1.php');
	 
	if(!$User){
		header("Location: http://avatar-gamer.ga/Landing/Animated/");
		die(); 
	} 
	
	if($myU->Ban != "1"){
		header("Location: http://avatar-gamer.ga");
		die();
	}
	
	echo'
	<title>
		Account Disabled
	</title>
	';
	
	echo"
	<div align='center'>
	<div id='StandardBox' style='border:1px solid black;width:560px;padding:20px;text-align:left;'>
	<h2 style='letter-spacing:-1px;'>
	";
	
	if ($myU->BanLength == "Reminder"){
		echo "Reminder";
	}
								
	if ($myU->BanLength == "0"){
		echo "Warning";
	}
	
	if ($myU->BanLength == "1"){
		echo "Banned for 1 Day";
	}
	
	if ($myU->BanLength == "3"){
		echo "Banned for 3 Days";
	}
	
	if ($myU->BanLength == "7"){
		echo "Banned for 7 Days";
	}
	
	if ($myU->BanLength == "14"){
		echo "Banned for 14 Days";
	}
	
	if ($myU->BanLength == "forever") {
		echo "Account Deleted";
	}
	
	echo"
	</h2>

	";
	
	echo"
	Our content moderators have determined that your behaviour at Avatar-Universe has been in violation of our Terms of Service. We will terminate your account if you do not abide by the rules.
	<div style='padding-top:15px;'></div>
	Reviewed: <b>".date("F j, Y g:iA","".$myU->TimeBanned."")."</b>
	";
	if($myU->BanDescription){
		echo"
		<div style='padding-top:10px;'></div>
		Moderator Note: <b>".$myU->BanDescription."</b>
		";
	}
	else{
		echo"
		<div style='padding-top:10px;'></div>
		Moderator Note: <b>Your behaviour is not tolerated on Avatar-Universe.
		";
	}
	
	if($myU->BanType && $myU->BanContent){
		echo"
		<div style='padding-top:10px;'></div>
		<div align='center'>
			<div id='StandardBox' style='border:1px solid black;width:95%;padding:10px;text-align:left;'>
			<b>Reason</b>: ".$myU->BanType."
			<br /><br />
			<b>Offensive Content:</b> ".$myU->BanContent."</b>
			<div id='StandardBox' style='border:0;margin-top:5px;'>
				
			
			</div>
			</div>
		</div>
		";
	}
	
	echo"
	<div style='padding-top:10px;'></div>
	<font style='font-weight:normal;'>
		Please abide by the
			<a href='http://avatar-gamer.ga/info/terms-of-service/'>
			Avatar-Universe Community Guidelines
		</a>
		so that Avatar-Universe can be fun for users of all ages.
	</font>
	<div style='padding-top:10px;'></div>
	";
	
	$time1 = time();
	$open = $myU->BanTime;
	if ($myU->BanLength != "forever") {
		$TimeUp = date("F j, Y g:iA","".$myU->BanTime."");
	}
	
	if($myU->BanLength != "forever"){
		if($myU->BanLength == "0"){
			echo'
			</b>
			You may re-activate your account by agreeing to our <a href="http://avatar-gamer.ga/info/terms-of-service/">
Terms of Service</a>.
			<div style="padding-top:10px;"></div>
			<center>
			<form action="" method="POST">
			<input type="checkbox" id="cb1"><font style="font-size:11px;">I Agree</font><div style="padding-top:5px;"></div>
			<input type="submit" id="button" name="Reac" value="Reactivate My Account" style="padding:1;">
			</form>
			<script>
			var cb1 = document.getElementById("cb1"),
			button = document.getElementById("button");
			button.disabled = true;    
			cb1.onclick = function(){
				if(cb1.checked){
					button.disabled = false;
				}
				else{ 
					button.disabled = true;
				}
			};
			</script>
			</center>
			';
		
		}
			$Unban =  mysql_real_escape_string($_POST['Reac']);
			if ($Unban) {
			mysql_query("UPDATE Users SET Ban='0' WHERE ID='$myU->ID'");
			header("Location: http://avatar-gamer.ga/");
			exit();
			}
		else if($time1 >= $open && $myU->BanLength != "0"){
			echo'
			</b>
			You may re-activate your account by agreeing to our <a href="../info/terms.aspx">Terms of Service</a>.
			<div style="padding-top:10px;"></div>
			<center>
			<form action="" method="POST">
			<input type="checkbox" id="cb1"><font style="font-size:11px;">I Agree</font><div style="padding-top:5px;"></div>
			<input type="submit" id="button" name="Reac" value="Reactivate My Account" style="padding:1;">
			</form>
			<script>
			var cb1 = document.getElementById("cb1"),
			button = document.getElementById("button");
			button.disabled = true;    
			cb1.onclick = function(){
				if(cb1.checked){
					button.disabled = false;
				}
				else{ 
					button.disabled = true;
				}
			};
			</script>
			</center>
			';
				
		}
		else if ($time1 <= $open && $myU->BanLength != "0"){
			echo"
			Your account has been disabled. You may reactivate your account after ".$TimeUp.".
			<div style='padding-top:10px;'></div>
			If you wish to appeal this ban, please send an email to <a href='mailto:info@avatar-gamer.ga'>info@avatar-gamer.ga</a>.
			";
		}
	}
		
		$Reac = mysql_real_escape_string(strip_tags(stripslashes($_POST['Reac'])));
		if($Reac){
			if($myU->BanLength == "0"){
				mysql_query("UPDATE Users SET Ban='0' WHERE Username='".$myU->Username."'");
				mysql_query("UPDATE Users SET BanTime='' WHERE Username='".$myU->Username."'");	
				mysql_query("UPDATE Users SET BanLength='' WHERE Username='".$myU->Username."'");
				mysql_query("UPDATE Users SET BanType='' WHERE Username='".$myU->Username."'");
				mysql_query("UPDATE Users SET BanDescription='' WHERE Username='".$myU->Username."'");
				header("Location: http://avatar-gamer.ga/");
				die();
			}
			elseif($time1 >= $open){
				if ($myU->BanLength != "forever") {
					mysql_query("UPDATE Users SET Ban='0' WHERE Username='".$myU->Username."'");
					mysql_query("UPDATE Users SET BanTime='' WHERE Username='".$myU->Username."'");	
					mysql_query("UPDATE Users SET BanLength='' WHERE Username='".$myU->Username."'");
					mysql_query("UPDATE Users SET BanType='' WHERE Username='".$myU->Username."'");
					mysql_query("UPDATE Users SET BanDescription='' WHERE Username='".$myU->Username."'");
					header("Location: http://avatar-gamer.ga");
					die();
				}
			}
		}
		else{ 
		}
		if ($myU->BanLength == "forever"){
			echo"
			Your account has been terminated.
			<div style='padding-top:10px;'></div>
			If you wish to appeal this ban, please send an email to <a href='mailto:info@avatar-gamer.ga'>info@avatar-gamer.ga</a>.
			";
		}

	
	echo"
	<div style='padding-top:10px;'></div>
	<center>
		<font style='font-size:12px;color:gray;'>
			Want to logout? 
			<a href='?logout=true'>
				Logout here.
			</a>
		</font>
	</center>
	</div>
	</div>
	";
	
	$Logout = SecurePost($_GET['logout']);
	if($Logout == "true"){
		session_destroy();
		header("Location: http://avatar-gamer.ga/");
		die();
	}
	
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>