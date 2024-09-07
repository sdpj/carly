<!-- login page -->
<!-- based off: https://vidsurf.glitch.me/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Vidsurf - login</title>
    <link rel="stylesheet" href="css/login.css?ts=<?=time()?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="images/jquery.min.js.download"></script>
  </head>
  <body>

	<div class="top"></div>

	<div class="box">
		<b>Sign up to Vidsurf today!</b>
		<br />
		
		<form class="form-signin" action="processSignup.php" method="post">
		
		<div>
		<table style="margin: auto;">
		<tr>
			<td><label><strong>Email Address</strong></label></td>
			<td><input class="form-control" type="text" name="email" required/></td>
		</tr>
		<tr>
			<td><label><strong>Username</strong></label></td>
			<td><input class="form-control" type="text" name="userName" required/></td>
		</tr>
		<tr>
			<td><label><strong>Password</strong></label></td>
			<td><input class="form-control" type="password" name="userPass" required/></td>
		</tr>
		<tr>
			<td><label><strong>Confirm Password</strong></label></td>
			<td><input class="form-control" type="password" name="confirmUserPass" required/></td>
		</tr>
		</table>
   		</div>

		<button type="submit">Sign Up</button>

		</form>
	</div>

	<!-- sample php code -->
	<?php 

	?>
	
    <aside class="ads">
      
    </aside>
    <footer>
      
    </footer>

</body>
</html>
