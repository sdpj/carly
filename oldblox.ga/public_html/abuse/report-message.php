<?				
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	$ID = SecurePost($_GET['ID']);
	$CheckContent = mysql_query("SELECT * FROM PMs WHERE ID='".$ID."'");
	$Content = mysql_fetch_object($CheckContent);
	$Exist = mysql_num_rows($CheckContent);
	$getOffender = mysql_query("SELECT * FROM Users WHERE ID='$Content->SenderID'");
	$gO = mysql_fetch_object($getOffender);
	if($Exist == 0){
		header("Location: http://avatar-gamer.ga/Error/?code=404");
		die();
	}
	if(!$User){
		header("Location: http://avatar-gamer.ga/Landing/Animated");
		die();
	}
	if(!$ID){
		header("Location: http://avatar-gamer.ga/Error/?code=404");
		die();
	}
?>
	<div class='report-page'>
		<h1>Report Abuse</h1>
		<div class='divider-right' style='float:left;width:484px;'>
			<h2 style='font-weight:normal;margin:0;padding:0;margin-bottom:10px;'>
				Tell our staff how <? echo $gO->Username; ?> is breaking the rules.
			</h2>
			<form action='' method='POST' style='margin:0;padding:0;'>
				<table cellpadding='0' cellspacing='0' style='margin-left:60px;'>
					<tr>
						<td style='text-align:center;'>
							<b>Subject:</b>
						</td>
						<td>
							<select name='AbuseCategory' style='width:340px;'>
								<option value='0'>
									Please select a category...
								</option>
								<option value='Inappropriate language'>
									Inappropriate language
								</option>
								<option value='Asking for or giving personal information'>
									Asking for or giving personal information
								</option>
								<option value='Bullying, personal attacking, or hate speech'>
									Bullying, personal attacking, or hate speech
								</option>
								<option value='Online dating'>
									Online dating
								</option>
								<option value='Exploiting or breaching boundaries'>
									Exploiting or breaching boundaries
								</option>
								<option value='Account trading, selling, or scamming'>
									Account trading, selling, or scamming
								</option>
								<option value='Bad item content'>
									Bad item content
								</option>
								<option value='Real life threats or suicide threats'>
									Real life threats or suicide threats
								</option>
								<option value='Other Rule Violation'>
									Other Rule Violation
								</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<div style='margin-top:20px;'></div>
						</td>
					</tr>
					<tr>
						<td style='vertical-align:top;padding-right:10px;'>
							<b>Comment:</b>
						</td>
						<td>
							<textarea name='AbuseComment'  rows='10' cols='32' style='width:340px;'></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<div style='margin-top:7px;'></div>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
						</td>
						<td>
							<input type='submit' name='AbuseSubmit' class='btn-primary' value='Report Abuse'
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div style='float:left;padding-left:10px;width:440px;'>
			<p style='margin:0;'>
				<b>Not sure if the thing you are trying to report is really against the rules?</b>
			</p>
			<p style='margin-top:5;'>
				<b>Some of the basic rules of Avatar-Universe include the following:</b>
			</p>
			<div style='margin-left:15px;'>
				<p>
					<li>
						<i>No swear words</i>
					</li>
				</p>
				<p>
					<li>
						<i>No account sharing or trading</i>
					</li>
				</p>
				<p>
					<li>
						<i>No dating - no asking for boyfriends or girlfriends</i>
					</li>
				</p>
				<p>
					<li>
						<i>No asking real life info about each other - no asking for phone numbers or email addresses</i>
					</li>
				</p>
				<p>
					<a href='http://avatar-gamer.ga/info/terms-of-service/'>
						See all rules.
					</a>
				</p>
				<p>
					Users who don't follow the rules will get a warning at first but if they keep it up we may ask them to not come to Avatar-Universe anymore. That way we can keep Avatar-Universe fun and safe!
				</p>
			</div>
		</div>
		<br style='clear:both;'>
	</div>
<?
	$AbuseCategory = SecurePost($_POST['AbuseCategory']);
	$AbuseComment = SecurePost($_POST['AbuseComment']);
	$AbuseSubmit = SecurePost($_POST['AbuseSubmit']);
	if($AbuseSubmit){
		if($User){
			if($AbuseCategory != "0"){
				$TitleReported = addslashes($Content->Title);
				$BodyReported = addslashes($Content->Body);
				mysql_query("INSERT INTO Reports (UserWhoSent, UserReported, Content, Comment, Category, Type, ItemID) VALUES('$myU->ID','$gO->ID','Title: $TitleReported Body: $BodyReported','$AbuseComment','$AbuseCategory','Message','$ID')");
				header("Location: http://avatar-gamer.ga/abuse/thank-you.aspx?contentreport=true");
				die();
			}
			else{
				echo"
				<table cellpadding='0' cellspacing='0'>
					<tr>
						<td>
							<font style='color:red;'>
								<div id='error'>You must select a valid category to report this post.</div>
							</font>
						</td>
					</tr>
				</table>
				";
			}
		}
	}
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>