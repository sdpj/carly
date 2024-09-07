<?php
	// setcookie('loopMech','0',time() + 3600, '/');
	if(isset($_COOKIE['EPICNAME']) && isset($_COOKIE['EPICPASS'])){
		// they are already logged in check for creds at dashbaord
		echo"<script>window.location='/Dashboard/'</script>";
}
?>

<link rel='stylesheet' href='/EpicClubRebootMisc/global.css'>
<title>Unitorium | Login</title>
<center><h1 style="background-color:#FF00FF;">Unitorium</h1></center>
<center><h2>Continue from where you left off!</h2></center>
 <center><img src="https://cdn.discordapp.com/attachments/793953239208820799/807672022678634546/NewUnitoriumLogo.png" alt="Unitorium Logo" style="width:200px;height:200px;"></center>
 <br>
				<form method='post' action='../Login/login.php'>
					<center><input id='usernameLogin' class='Ginput' name='Username' placeholder="Username" maxlength='20' required /><br></center>
					<center><input class='Ginput' name='password1' type='password' placeholder="Password" required /><br></center>
					<center><button> Submit </button></center>
				</form>
			</div>