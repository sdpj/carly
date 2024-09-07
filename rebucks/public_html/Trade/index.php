<?php
include('../global.php');
if ($logged == false){
	die("You're not logged in!");
}else{
	if ($_GET['with']){
		if ($_GET['myadd']){
			$myadd = mysql_real_escape_string($_GET['myadd']);
		}
		if ($_GET['youradd']){
			$youradd = mysql_real_escape_string($_GET['youradd']);
		}
		if ($_GET['send']){
			if ($myadd != 0 && $youradd != 0){
		$id = mysql_real_escape_string($_GET['with']);
				$checkmy = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id`='$myadd' AND `limited`='1'"));
				if ($checkmy == 0){
					die("Oops, something went wrong!");
				}
				$checkyours = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id`='$youradd' AND `limited`='1'"));
				if ($checkyours == 0){
					die("Oops, something went wrong!");
				}
				mysql_query("INSERT INTO `trade` (`fromid`, `toid`, `itemid`, `myitemid`) VALUES ('$uid', '$id', '$youradd', '$myadd')");
				message("Done", "Trade request sent!", "index.php", "Back", false, '');
				die();
			}
		}else{
		$id = mysql_real_escape_string($_GET['with']);
		$get = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$id'"));
		if ($get == 0){
			die("That user does not exist!");
		}
		?>
        <h1>You are trading with <?php print_r($get['Username']); ?></h1><br>
        <div style="width: 98%; overflow: auto; max-height: 250px; border: 1px solid black; background-color: #EBEBEB; color: black;"><div style="width: 98%; background-color: white; color: black;"><?php print_r($get['Username']); ?>'s Items</div>
        <table>
        <tr>
        <?php
		$q = mysql_query("SELECT * FROM `inventory` WHERE `ownerid`='$id' ORDER BY id DESC");
		$qq = mysql_num_rows($q);
		for ($count = 1; $count <= $qq; $count ++){
			$qr = mysql_fetch_array($q);
			$itemid = $qr['itemid'];
			$fr = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `id`='$itemid'"));
			if ($fr != 0){
				if ($fr['islimited'] != 0){
					$if = $qr['id'];
					mysql_query("UPDATE `inventory` SET `limited`='1' WHERE `id`='$if'");
				}
			}
		}
		$q = mysql_query("SELECT * FROM `inventory` WHERE `ownerid`='$id' AND `limited`='1' ORDER BY id DESC");
		$qq = mysql_num_rows($q);
		for ($count = 1; $count <= $qq; $count ++){
			$qr = mysql_fetch_array($q);
			$itemid = $qr['itemid'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `id`='$itemid'"));
			?>
            <td><center>
            <a href="?with=<?php print_r($id); ?>&youradd=<?php print_r($qr['id']); ?>&myadd=<?php print_r($myadd); ?>">
            <img src="/assets/Avatars/<?php print_r($item['path']); ?>" border="0" /><br>
            <?php print_r($item['Name']); ?><br>
            [Add]
            </a>
            </center>
            </td>
            <?php
		}
		?>
        </tr>
        </table>
        </div><br>
         <div style="width: 98%; border: 1px solid black; background-color: #EBEBEB; color: black;"><div style="width: 98%; background-color: white; color: black;">Your Items</div>
         <table>
        <tr>
        <?php
		$q = mysql_query("SELECT * FROM `inventory` WHERE `ownerid`='$uid' ORDER BY id DESC");
		$qq = mysql_num_rows($q);
		for ($count = 1; $count <= $qq; $count ++){
			$qr = mysql_fetch_array($q);
			$itemid = $qr['itemid'];
			$fr = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `id`='$itemid'"));
			if ($fr != 0){
				if ($fr['islimited'] != 0){
					$if = $qr['id'];
					mysql_query("UPDATE `inventory` SET `limited`='1' WHERE `id`='$if'");
				}
			}
		}
		$q = mysql_query("SELECT * FROM `inventory` WHERE `ownerid`='$uid' AND `limited`='1' ORDER BY id DESC");
		$qq = mysql_num_rows($q);
		for ($count = 1; $count <= $qq; $count ++){
			$qr = mysql_fetch_array($q);
			$itemid = $qr['itemid'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `id`='$itemid'"));
			?>
            <td><center>
            <a href="?with=<?php print_r($id); ?>&myadd=<?php print_r($qr['id']); ?>&youradd=<?php print_r($youradd); ?>">
            <img src="/assets/Avatars/<?php print_r($item['path']); ?>" border="0" /><br>
            <?php print_r($item['Name']); ?><br>
            [Add]
            </a>
            </center>
            </td>
            <?php
		}
		?>
        </tr>
        </table>
        </div><br><br>
        <center>
        <?php
		if ($myadd != 0 && $youradd != 0){
			?>
            <a href="?with=<?php print_r($id); ?>&myadd=<?php print_r($myadd); ?>&youradd=<?php print_r($youradd); ?>&send=true" id="buttonsmall">Send Trade Request</a>
            <?php
		}else{
			?>
            * Please select an item from both inventories before continuing!
            <?php
		}
		}
	}else{
		if ($_GET['accept']){
			$id = mysql_real_escape_string($_GET['accept']);
			$t = mysql_fetch_array(mysql_query("SELECT * FROM `trade` WHERE `id`='$id'"));
			if ($t != 0){
				$fromid = $t['fromid'];
				$toid = $uid;
				$whatigive2 = $t['itemid'];
				$whatiwant2 = $t['myitemid'];
				$whatigive3 = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id`='$whatigive2'"));
				$whatigive = $whatigive3['itemid'];
				$whatiwant3 = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id`='$whatiwant2'"));
				$whatiwant = $whatiwant3['itemid'];
				mysql_query("UPDATE `inventory` SET `ownerid`='$fromid' WHERE `ownerid`='$toid' AND `itemid`='$whatigive'") or die(mysql_error());
				mysql_query("UPDATE `inventory` SET `ownerid`='$toid' WHERE `ownerid`='$fromid' AND `itemid`='$whatiwant'") or die(mysql_error());
				mysql_query("DELETE FROM `trade` WHERE `id`='$id'");
				mysql_query("INSERT INTO `messages` (`fromid`, `toid`, `subject`, `body`) VALUES ('1', '$fromid', 'Trade Accepted', ' $user[Username] has accepted your trade request.')");
				message("Done", "You have traded with this user.", "index.php", "Back", false, '');
				die();
			}
		}
		if ($_GET['decline']){
			$id = mysql_real_escape_string($_GET['decline']);
			$t = mysql_fetch_array(mysql_query("SELECT * FROM `trade` WHERE `id`='$id' AND `toid`='$uid'"));
			if ($t != 0){
				$fromid = $t['fromid'];
				mysql_query("DELETE FROM `trade` WHERE `id`='$id'");
				mysql_query("INSERT INTO `messages` (`fromid`, `toid`, `subject`, `body`) VALUES ('1', '$fromid', 'Trade Declined', ' $user[Username] has declined your trade request.')");
				message("Done", "You have declined the trade with this user.", "index.php", "Back", false, '');
				die();
			}
		}
	?>
	<h1>My Trade Requests (<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `trade` WHERE `toid`='$uid' ORDER BY id"))); ?>)</h1><br><br>
    <table width="98%">
    <tr>
    <td width="130" style="text-align: center;">
 	<b>Requester</b>
    </td>
    <td width="300" style="text-align: center;">
    <b>What I Want</b>
    </td>
    <td width="300" style="text-align: center;">
    <b>What I'll Give</b>
    </td>
    <td style="text-align: right;">
    <b>Actions</b>
    </td>
    </tr>
    <?php
	$q = mysql_query("SELECT * FROM `trade` WHERE `toid`='$uid' ORDER BY id");
	$qq = mysql_num_rows($q);
	for ($count = 1; $count <= $qq; $count ++){
		$qr = mysql_fetch_array($q);
		$requesterid = $qr['fromid'];
		$requester = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$requesterid'"));
		$whatigivef = $qr['itemid'];
		$whatiwantf = $qr['myitemid'];
		$wantf = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id`='$whatigivef'"));
		$givef = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id`='$whatiwantf'"));
		$wanti = $wantf['itemid'];
		$givei = $givef['itemid'];
		$want = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `id`='$wanti'"));
		$give = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `id`='$givei'"));
		$whatigive = $give['id'];
		$whatiwant = $want['id'];
		?>
		<tr>
        <td width="130" style="text-align: center;">
        <center>
        <?php
		drawCharacter($requesterid, 100, 140);
		?><br>
        <a href="/Profile.php?id=<?php print_r($requesterid); ?>"><?php print_r($requester['Username']); ?></a>
        </center>
        </td>
        <td width="300" style="text-align: center;">
        <a href="/Store/Item.php?id=<?php print_r($whatiwant); ?>">
        <img src="/assets/Avatars/<?php print_r($want['path']); ?>" border="0" /><br>
        <?php print_r($want['Name']); ?>
		</a>
        </td>
        <td width="300" style="text-align: center;">
        <a href="/Store/Item.php?id=<?php print_r($whatigive); ?>">
        <img src="/assets/Avatars/<?php print_r($give['path']); ?>" border="0" /><br>
        <?php print_r($give['Name']); ?>
		</a>
        </td>
        <td style="text-align: right;">
        <a href="?accept=<?php print_r($qr['id']); ?>">Accept</a> | <a href="?decline=<?php print_r($qr['id']); ?>">Decline</a>
        </td>
        </tr>
        <?php
	}
	?>
    </table>
    <?php
}
}