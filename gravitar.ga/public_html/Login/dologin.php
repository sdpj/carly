<?php
$con = mysql_pconnect("mysql.ct8.pl", "m27001_gravitar", "Sg090228") or die("Something went wrong while connecting to the database - ID: 1");
mysql_select_db("m27001_gravitar", $con) or die("Something went wrong while connecting to the database - ID: 2");
if ($_POST['username'] && $_POST['password']){
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['password']);
	$get = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `Username`='$username'"));
	if ($get == 0){
		include('../global.php');
		die("This username is not in use. Do you want to <a href='Register.php'>register it?</a>");
	}else{
		$hashd = hash("ripemd160", $password);
		if ($get['Password'] == $hashd){
			$urn = hash("ripemd160", $username);
			setcookie("ck_usrn", $urn, time()+13337, "/");
			function generateSalt($max = 15) {
				$characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
				$i = 0;
				$salt = "";
				while ($i < $max) {
					$salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
					$i++;
				}
					return $salt;
				}
				$salt = generateSalt();
				setcookie("ch_salt", $salt, time()+13337, "/");
				mysql_query("UPDATE `accounts` SET `salt`='$salt' WHERE `Username`='$username'");
				include('../global.php');
				?>
                You're now logged in.
                <script type="text/javascript">
				window.location = "../Home.php"
				</script>
				Returning..
                <?php				
		}else{
			include('../global.php');
			die("Incorrect password, please try again.");
		}
	}
}