<style>body{background-color:#ffffff!important;}</style>
<?      $bannedcanview = "true";

	include($_SERVER['DOCUMENT_ROOT'].'/header.php');
	 
	if(!$user){
		header("Location: /");
		die(); 
	} 
	
	if($myu->Ban != "1"){
		header("Location: /");
		die();
	}
	
	echo'
	<title>
		Account Disabled
	</title>
	';
	
	echo"<form action='' method='POST'>
	<div align='center'>
	<div id='StandardBox' style='border:1px solid black;width:560px;padding:20px;text-align:left;'>
	<h2 style='letter-spacing:-1px;'>
	";
	
	if ($myu->BanLength == "Reminder"){
		echo "Reminder";
	}
								
	if ($myu->BanLength == "0"){
		echo "Warning";
	}
	
	if ($myu->BanLength == "1"){
		echo "Banned for 1 Day";
	}
	
	if ($myu->BanLength == "3"){
		echo "Banned for 3 Days";
	}
	
	if ($myu->BanLength == "7"){
		echo "Banned for 7 Days";
	}
	
	if ($myu->BanLength == "14"){
		echo "Banned for 14 Days";
	}
	
	if ($myu->BanLength == "forever") {
		echo "Account Deleted";
	}
	
	echo"
	</h2>

	";
	
	echo"
	Our content moderators have determined that your behaviour at ".$sitename." has been in violation of our Terms of Service. We will terminate your account if you do not abide by the rules.
	<div style='padding-top:15px;'></div>
	Reviewed: <b>".date("F j, Y g:iA","".$myu->TimeBanned."")."</b>
	";
	if($myu->BanDescription){
		echo"
		<div style='padding-top:10px;'></div>
		Moderator Note: <b>".$myu->BanDescription."</b>
		";
	}
	else{
		echo"
		<div style='padding-top:10px;'></div>
		Moderator Note: <b>Your behaviour is not tolerated on ".$sitename.".
		";
	}
	
	if($myu->BanType && $myu->BanContent){
		echo"
		<div style='padding-top:10px;'></div>
		<div align='center'>
			<div id='StandardBox' style='border:1px solid black;width:95%;padding:10px;text-align:left;'>
			<b>Reason</b>: ".$myu->BanType."
			<br /><br />
			<b>Offensive Item:</b> ".htmlspecialchars($myu->BanContent)."</b>
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
			<a href='/info/terms-of-service/'>
			".$sitename." Community Guidelines
		</a>
		so that ".$sitename." can be fun for all users.
	</font>
	<div style='padding-top:10px;'></div>
	";
	
	$time1 = time();
	$open = $myu->BanTime;
	if ($myu->BanLength != "forever") {
		$TimeUp = date("F j, Y g:iA","".$myu->BanTime."");
	}
	
	if($myu->BanLength != "forever"){
		if($myu->BanLength == "0"){
			echo'
			</b>
			You may re-activate your account by agreeing to our <a href="/info/terms-of-service/">
Terms of Service</a>.
			<div style="padding-top:10px;"></div>
			<center>
			<!--<form action="" method="POST">-->
			<input type="checkbox" id="cb1"><font style="font-size:11px;">I Agree</font><div style="padding-top:5px;"></div>
			<input type="submit" id="button" name="Reac" value="Reactivate My Account" style="margin-top: 3px;">
			<!--</form>-->
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
			mysql_query("UPDATE users SET Ban='0' WHERE id='$myu->id'");
			header("Location: /");
			exit();
			}
		else if($time1 >= $open && $myu->BanLength != "0"){
			echo'
			</b>
			You may re-activate your account by agreeing to our <a href="/info/terms-of-service/">Terms of Service</a>.
			<div style="padding-top:10px;"></div>
			<center>
			<!--<form action="" method="POST">-->
			<input type="checkbox" id="cb1"><font style="font-size:11px;">I Agree</font><div style="padding-top:5px;"></div>
			<input type="submit" id="button" name="Reac" value="Reactivate My Account" style="margin-top: 3px;">
			<!--</form>-->
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
		else if ($time1 <= $open && $myu->BanLength != "0"){
			echo"
			Your account has been disabled. You may reactivate your account after ".$TimeUp.".
			<div style='padding-top:10px;'></div>
			If you wish to appeal, please send an email to <a href='#'>[ No Email Yet ]</a>.
			";
		}
	}
		
		$Reac = mysql_real_escape_string(strip_tags(stripslashes($_POST['Reac'])));
		if($Reac){
			if($myu->BanLength == "0"){
				mysql_query("UPDATE users SET Ban='0' WHERE username='".$myu->username."'");
				mysql_query("UPDATE users SET BanTime='' WHERE username='".$myu->username."'");	
				mysql_query("UPDATE users SET BanLength='' WHERE username='".$myu->username."'");
				mysql_query("UPDATE users SET BanType='' WHERE username='".$myu->username."'");
				mysql_query("UPDATE users SET BanDescription='' WHERE username='".$myu->username."'");
				header("Location: /");
				die();
			}
			elseif($time1 >= $open){
				if ($myu->BanLength != "forever") {
					mysql_query("UPDATE users SET Ban='0' WHERE username='".$myu->username."'");
					mysql_query("UPDATE users SET BanTime='' WHERE username='".$myu->username."'");	
					mysql_query("UPDATE users SET BanLength='' WHERE username='".$myu->username."'");
					mysql_query("UPDATE users SET BanType='' WHERE username='".$myu->username."'");
					mysql_query("UPDATE users SET BanDescription='' WHERE username='".$myu->username."'");
					header("Location: /");
					die();
				}
			}
		}
		else{ 
		}
		if ($myu->BanLength == "forever"){
			echo"
			Your account has been terminated.
			<div style='padding-top:10px;'></div>
			If you wish to appeal, please send an email to <a href='#'>[ No Email Yet ]</a>.
			";
		}

if($_POST['logout']){
header("Location: /user/logout.php");
die(); exit;
}
	
	echo"
	<center>
		<input type='submit' id='logout' name='logout' value='Logout' style='margin-top:1rem;'>	
        </center>
	</div>
	</div>
	";
	
        echo "</form>";

	include($_SERVER['DOCUMENT_ROOT'].'/footer.php');
?>