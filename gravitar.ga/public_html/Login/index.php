<?php
include('../global.php');
if ($logged == false){
	?>
    <h1>Login</h1><br />
    <h6>No account? <a href="Register.php">Register here</a></h6><br /><br />
    <form action="dologin.php" method="post">
    <table>
    <tr><td>Username</td><td><input type="text" name="username" /></td></tr>
    <tr><td>Password</td><td><input type="password" name="password" /></td></tr>
    </table>
    <input type="submit" value="Login" id="buttonsmall" />
    </form>
    <?php
}else{
	echo "<center><strong><h3><font color=#2E2E2E>Hey there, welcome back! You're already logged in!</font></h3></strong></center>";
	ob_end_clean();
}