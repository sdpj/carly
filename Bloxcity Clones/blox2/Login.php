<?php
	include "Header.php";
	
	if (!$User) {
	
		$Username = SecurePost($_POST['Username']);
		$Password = SecurePost($_POST['Password']);
		$Submit =   SecurePost($_POST['Submit']);
		
		if ($Submit) {
		
			if (!$Username || !$Password) {
			
				echo "
				<div id='Error'>
					Sorry, you have missing fields.
				</div>
				";
			
			}
			
			else {
			
				$_HASH = hash('sha512',$Password);
				
				$checkUser = mysql_query("SELECT * FROM Users WHERE Username='$Username'");
				
				$cU = mysql_num_rows($checkUser);
				
				if ($cU == 0) {
				
				echo "
				<div id='Error'>
					Sorry, that account does not exist.
				</div>
				";
				
				}
				
				else {
				
					$getPassword = mysql_query("SELECT * FROM Users WHERE Username='$Username' AND Password='$_HASH'");
					
					$gP = mysql_num_rows($getPassword);
					
					if ($gP == 0) {
					
						echo "
						<div id='Error'>
							Sorry, but your password is incorrect.
						</div>
						";
					
					}
					
					else {
					
						$_SESSION['Username']=$Username;
						$_SESSION['Password']=$_HASH;
						
						header("Location: /");
					
					}
				
				}
			
			}
		
		}
	
		echo "
		<form action='' method='POST'>
						<h1>Login to your account</h1>
                                   <div class='divider-top' style='width:100%;padding-top:5px;margin-top:5px;'></div>
				<tr>
					<td>
						<b>Username</b>
					</td>
					<td>
						<input type='text' name='Username'>
					</td>
				</tr>
<br>
				<tr>
					<td>
						<b>Password</b>
					</td>
					<td>
						<input type='password' name='Password'>
					</td>
				</tr>
<br>
				<tr>
					<td>
						<input class='btn btn-primary' type='submit' name='Submit' value='Log in'>
					</td>
				</tr>
		</form>
		";
	
	}
	
	else {
	
		header("Location: ../");
	
	}
	
	include "Footer.php";
?>