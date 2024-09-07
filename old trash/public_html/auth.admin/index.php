<?
	include($_SERVER['DOCUMENT_ROOT'].'/auth.admin/admin-header.php');
	$NumOnline = mysql_num_rows($NumOnline = mysql_query("SELECT * FROM Users WHERE $now < expireTime")); 
	
	//FetchReports
	$getReports = mysql_query("SELECT * FROM Reports");
	$ActiveReports = mysql_num_rows($getReports);
	//End Reports
	
	echo"
	<div class='blank-admin-box'>
		<adminh2>
			Administration
		</adminh2>
	</div>
	<div id='StandardBox'>
		<table cellspacing='0' cellpadding='0' width='49%' style='float:left;margin-right:7px;'>
			<tr>
				<td valign='top'>
					<div id='StandardBoxHeader'>
						Upload Moderation
					</div>
					<div id='StandardBox'>
						Items Pending: ()
						<div style='padding-top:3px;'></div>
						Advertisements Pending: ()
						<div style='padding-top:3px;'></div>
						Profile Banners Pending: () 
					</div>
				</td>
			</tr>
			<tr>
				<td valign='top'>
					<div id='StandardBoxHeader'>
						Global Reports
					</div>
					<div id='StandardBox'>
						Total Reports Awaiting: <font color='red'><b>$ActiveReports</b></font>
						<div style='padding-top:3px;'></div>
					
					
						<a href='../auth.admin/view-reports.aspx'>
						View all reports
						</a>
					</div>
				</td>
			</tr>
		</table>
		<table cellspacing='0' cellpadding='0' width='50%' style='float:left;'>
			<tr>
				<td valign='top'>
					<div id='StandardBoxHeader'>
				Most Visited Sections
					</div>
					<div id='StandardBox'>
			<div style='padding-top:3px;'>
					<a href='user-search.aspx'>Account lookup</a></div>
					<div style='padding-top:3px;'>
					<a hre=f'moderate-items.aspx'>Item moderation</a></div>
					<br /></div>
				</td>
			</tr>
			<tr>
				<td valign='top'>
					<div id='StandardBoxHeader'>
					Website Stats 
					</div>
					<div id='StandardBox'>
						There are <b><font color='blue'>$NumOnline</font></b> users logged on
						<div style='padding-top:3px;'></div>
						There are total items in the store<br />
						There are ads running
					</div>
				</td>
			</tr>
		</table>
	<br style='clear: both' />
	</div>
	
	";
	
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>