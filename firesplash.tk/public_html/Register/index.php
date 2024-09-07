<?php
	// setcookie('loopMech','0',time() + 3600, '/');
	if(isset($_COOKIE['EPICNAME']) && isset($_COOKIE['EPICPASS'])){
		// they are already logged in check for creds at dashbaord
		echo"<script>window.location='/Dashboard/'</script>";
}
?>

<link rel='stylesheet' href='/EpicClubRebootMisc/global.css'>
<title>Unitorium | Register</title>
<center><h1 style="background-color:#FF00FF;">Unitorium</h1></center>
<center><h2>Start your adventure here!</h2></center>
 <center><img src="https://cdn.discordapp.com/attachments/793953239208820799/807672022678634546/NewUnitoriumLogo.png" alt="Unitorium Logo" style="width:200px;height:200px;"></center>
 <br>
					<center><form method='post' action='/Register/register.php'>
					<input id='username' class='Ginput' onkeyup='ValidateEpicU()' name='Username' placeholder="Desired Username"  maxlength='20' required/><br>
					<input class='Ginput' name='email' type='email' placeholder="Email" required /><br>
					<input class='Ginput' name='password1' type='password' placeholder="Password" required /><br>
					<input class='Ginput' name='password2' type='password' placeholder="Retype Password" required /><br
				
					</div><br>
					<button> Submit </button></center>
				</form>
			</div>