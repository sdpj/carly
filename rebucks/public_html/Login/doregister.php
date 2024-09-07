<?php
$con = mysql_pconnect("mysql.ct8.pl", "m27001_OT", "Sg090228") or die("Something went wrong while connecting to the database - ID: 1");
mysql_select_db("m27001_OT", $con) or die("Something went wrong while connecting to the database - ID: 2");
	if ($_POST['username'] && $_POST['password'] && $_POST['cpassword'] && $_POST['email']){
		$name = '';
		if ($_POST['name']){
			$name = mysql_real_escape_string($_POST['name']);
		}
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$cpassword = mysql_real_escape_string($_POST['cpassword']);
		$email = mysql_real_escape_string($_POST['email']);
               

                if (strlen($username) > 20) {
include('../global.php');
die("That username is too long! The maximum character amount is 20. Press back, or click <a href='Register.php'>here</a>.");
}else{
if (strlen($username) < 3) {
include('../global.php');
die("That username is too short! The minimum character amount is 3. Press back, or click <a href='Register.php'>here</a>.");
}else{
		if (!ctype_alnum($username)){
			include('../global.php');
			die("That username contains special characters, only numbers and letters are allowed. Press back, or click <a href='Register.php'>here</a>");
		}else{
			$check = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `Username`='$username'"));
			if ($check != 0){
			include('../global.php');
				die("That username already exists. Please press back, or click <a href='Register.php'>here</a>");
			}else{
                        
				if ($password != $cpassword){
			include('../global.php');
					die("Password does not match confirm password, please press back or click <a href='Register.php'>here</a>");
				}
				if ($password == 44444){
			include('../global.php');
					die("Your password cannot be '$password', please press back or click <a href='Register.php'>here</a>");
				}else{
					function checkEmail($email) {
					  if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])
					  ↪*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",
								   $email)){
						list($username,$domain)=split('@',$email);
						if(!checkdnsrr($domain,'MX')) {
						  return false;
						}
						return true;
					  }
					  return false;
					}
					$check = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `email`='$email'"));
			if ($check != 0){
			include('../global.php');
				die("That email already exists. Please press back, or click <a href='Register.php'>here</a>");
					}else{ 
                                                
			
						$hashed = hash("ripemd160", $password);
						mysql_query("INSERT INTO `accounts` (`Username`, `Password`, `Name`, `Email`, `ShirtPath`, `PantsPath`, `EyesPath`, `HairPath`, `MouthPath`) VALUES ('$username', '$hashed', '$name', '$email', 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', 'Default Hat.png', 'Default Smile.png')");
						$gets = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `Username`='$username'"));
						if ($gets == 0){
			include('../global.php');
							die("Something went wrong.. Try again.");
						}else{
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
							ob_end_clean();
							include('../global.php');
die("You are now registered!");
						}
					}
				}
			}
		}
	}
}
}