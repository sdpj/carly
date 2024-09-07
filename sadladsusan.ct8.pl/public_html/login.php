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
		<b>Sign in to Vidsurf</b>
		<br />
		
		<form class="form-signin" action="processLogin.php" method="post">
		
		<div>
		<table>
		<tr>
			<td><label><strong>Username</strong></label></td>
			<td><input class="form-control" type="text" name="userName" required/></td>
		</tr>
		<tr>
			<td><label><strong>Password</strong></label></td>
			<td><input class="form-control" type="password" name="userPass" required/></td>
		</tr>
		</table>
   		</div>

		<button type="submit">Login</button>

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
