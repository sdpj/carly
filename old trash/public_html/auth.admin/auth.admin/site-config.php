<?
	include($_SERVER['DOCUMENT_ROOT'].'/auth.admin/admin-header.php');
	
	echo"
	<div class='blank-admin-box'>
		<adminh2>
			Site Configuration
		</adminh2>
	</div>
	<div id='StandardBox'>
		<form action='' method='POST'>
			<table align='center' style='width:100%;'>
				<tr>
					<td valign='top'>
						<b>Public Banner</b>
						<br />
						<textarea name='BannerText' rows='5' cols='40'>".$gB->Text."</textarea>
						<br />
						<input type='submit' name='Submit' value='Change' />
					</td>
					<td valign='top'>
						<b>Admin Banner</b>
						<br />
						<textarea name='AdmBannerText' disabled='disabled' rows='5' cols='40' placeholder='This feature has been disabled.'>".$gBA->text."</textarea>
						<br /> 
						<input type='submit' disabled='disabled' name='admsubmit' value='Change' />
					</td>
				</tr>
			</table>
		</form>
		<form action='' method='POST' style='padding:0;margin:0;'>
			<input type='submit' name='MaintenanceTrue' value='Maintenance: On' />
			<input type='submit' name='MaintenanceFalse' value='Maintenance: Off' />
		</form>
		<div style='padding-top:5px;'></div>
		";
		$checkMaintenance = mysql_query("SELECT * FROM `Maintenance`");
		$cM = mysql_fetch_object($checkMaintenance);
		
		if($cM->Status == "true"){
			echo"
			<font style='color:red;'>
				Maintenance is currently enabled.
			</font>
			";
		}
		elseif($cM->Status == "false"){
			echo"
			<font style='color:green;'>
				Maintenance is currently disabled.
			</font>
			";
		}
		
		echo"
		<div style='padding-top:10px;'></div>
		<form action='' method='POST' style='padding:0;margin:0;'>
			<input type='submit' name='RegisterTrue' value='Register: On' />
			<input type='submit' name='RegisterFalse' value='Register: Off' />
		</form>
		<div style='padding-top:5px;'></div>
	";
	
		$checkRegister = mysql_query("SELECT * FROM `Configuration`");
		$cR = mysql_fetch_object($checkRegister);
		
		if($cR->Register == "false"){
			echo"
			<font style='color:red;'>
				Register is currently disabled.
			</font>
			";
		}
		elseif($cR->Register == "true"){
			echo"
			<font style='color:green;'>
				Register is currently enabled.
			</font>
			";
		}
	
	echo"
	</div>
	";
	
	$BannerText = SecurePost($_POST['BannerText']);
	$MaintenanceTrue = SecurePost($_POST['MaintenanceTrue']);
	$MaintenanceFalse = SecurePost($_POST['MaintenanceFalse']);
	$RegisterTrue = SecurePost($_POST['RegisterTrue']);
	$RegisterFalse = SecurePost($_POST['RegisterFalse']);
	$AdmBannerText = SecurePost($_POST['AdmBannerText']);
	$Color = $_POST['color'];
	$Submit = $_POST['Submit'];
	$admsubmit = $_POST['admsubmit'];
				
	if ($Submit) {
					
					
		mysql_query("UPDATE `Banner` SET `Text`='".$BannerText."'");
		mysql_query("UPDATE Banner SET Color='darkRed'");
		
		header("Location: ../auth.admin/site-config.aspx?statupdate=true");
		die();
		
	}
					
	if($admsubmit) {
							
		$AdmBannerText = ($AdmBannerText);
		$AdmBannerText = "$AdmBannerText";
							
		mysql_query("UPDATE adminBanner SET text='".$AdmBannerText."'");
		
	}
	
	if($MaintenanceTrue){
		mysql_query("UPDATE `Maintenance` SET `Status`='true'");
		header("Location: ../auth.admin/site-config.aspx?maint=true");
		die();
	}
	
	if($MaintenanceFalse){
		mysql_query("UPDATE `Maintenance` SET `Status`='false'");
		header("Location: ../auth.admin/site-config.aspx?maint=false");
		die();
	}
	
	if($RegisterTrue){
		mysql_query("UPDATE `Configuration` SET `Register`='true'");
		header("Location: ../auth.admin/site-config.aspx?regist=true");
		die();
	}
	
	if($RegisterFalse){
		mysql_query("UPDATE `Configuration` SET `Register`='false'");
		header("Location: ../auth.admin/site-config.aspx?regist=false");
		die();
	} 
	
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>