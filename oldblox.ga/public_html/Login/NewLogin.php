<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	if($User){
		header("Location: /");
		die();
	}
?>
	<div class='login-page'>
		<h1>Login to Avatar-Universe</h1>
		<div class='divider-right' style='width:484px;float:left;'>
			<table>
				<tr>
					<td>
						<center>
							<img src='/Images/your-username.png'>
							<br />
							<input type='username' name='LoginUsername'>
						</center>
					</td>
				</tr>
				<tr>
					<td>
						<div style='padding-top:15px;'></div>
					</td>
				</tr>
				<tr>
					<td>
						<center>
							<img src='/Images/your-password.png'>
							<br />
							<input type='password' name='LoginPassword'>
						</center>
					</td>
				</tr>
			</table>
		</div>
	</div>
<?
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>