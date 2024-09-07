<?php
include "Header.php";
if ($logged==true){
	if ($user['Username']=='Syncro'){
		if ($_POST['username'] && $_POST['upgrade']){
			$username = $_POST['username'];
			$type = $_POST['upgrade'];
			if ($type == "1 Month Premium"){
				$expire = time() + 60 * 60 * 24 * 30;
				mysql_query("UPDATE `accounts` SET `Membership`='1', `Expire`='$expire' WHERE `Username`='$username'") or die(mysql_error());
			}
			if ($type == "6 Months Premium"){
				$expire = time() + 60 * 60 * 24 * 180;
				mysql_query("UPDATE `accounts` SET `Membership`='1', `Expire`='$expire' WHERE `Username`='$username'") or die(mysql_error());
			}
			if ($type == "1,000 Bucks"){
				mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`+'1000' WHERE `Username`='$username'");
			}
			if ($type == "5,000 Bucks"){
				mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`+'5000' WHERE `Username`='$username'");
			}
			if ($type == "500 Reebs"){
				mysql_query("UPDATE `accounts` SET `Reebs`=`Reebs`+'500' WHERE `Username`='$username'");
			}
			if ($type == "1,000 Reebs"){
				mysql_query("UPDATE `accounts` SET `Reebs`=`Reebs`+'1000' WHERE `Username`='$username'");
			}
			die("Done!");
		}
				?>
		Give Upgrades:<br /><br />
        <form action="" method="post">
        Username: <input type="text" name="username" /><br />
        Upgrade Type: <select name="upgrade">
        <option>1 Month Premium</option>
        <option>6 Months Premium</option>
        <option>1,000 Bucks</option>
        <option>5,000 Bucks</option>
        <option>500 Reebs</option>
        <option>1,000 Reebs</option>
        </select><br>
        <input type="submit" value="Give" id="buttonsmall" />
        </form>
        <?php
	}
}