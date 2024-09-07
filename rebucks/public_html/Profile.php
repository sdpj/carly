<?php
include('global.php');
$id = 0;
$isOwned = false;
if ($_GET['id']){
	$id = mysql_real_escape_string($_GET['id']);
}
if ($id != 0){
	$check = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$id'"));
	if ($check == 0){
		die("This user doesn't exist!");
	}
	if ($check['banned'] != 0){
		die("This user is currently banned!");
	}
}
if ($id == 0){
	$array = $user;
	$id    = $user['id'];
	$isOwned = true;
}else{
	$array = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$id'"));
}
if ($id == 0){
	die("Oops! Server error!");
}
if ($uid != $id){
mysql_query("UPDATE `accounts` SET `profileviews`=`profileviews`+'1' WHERE `id`='$id'") or die(mysql_error());
}
if ($_POST['rept']){
		$rept = mysql_real_escape_string($_POST['rept']);
		if ($logged==false){
			die("not logged in");
		}
		if ($rept < 0){
			die("You can't give negative reputation points!");
		}
		if ($user['Reputation'] < $rept){
			message("Sorry", "You don't have enough reputation points to exchange with this user.", "?id=" . $id, "Back", false, '');
		}else{
			mysql_query("UPDATE `accounts` SET `Reputation`=`Reputation`-'$rept' WHERE `id`='$uid'");
			mysql_query("UPDATE `accounts` SET `Reputation`=`Reputation`+'$rept' WHERE `id`='$id'");
			message("Success", "You have given this user your " . $rept . " reputation points. Thanks.", "?id=" . $id, "Back", false, '');
		}
	}
if ($_GET['rep']){
	message("Reputation.", "<form action='Profile.php?id=" . $id . "' method='post'><input type='text' style='min-width: 400px;' name='rept' placeholder='How much reputation would you like to give this user?' /><br><input type='submit' value='Give Reputation' /></form>", "?id=" . $id, "Cancel", false, '');
}
if ($_GET['fr']){
	if ($uid == $id){
		message("Error", "You can't send yourself a friend request!", "?id=" . $id, "Back", false, '');
	}else{
		$check = mysql_fetch_array(mysql_query("SELECT * FROM `friends` WHERE `withid`='$id' AND `uid`='$uid'"));
		if ($check != 0){
			message("Error", "You're already friends with this player.", "?id=".$id, "Back", false, '');
		}else{
			mysql_query("INSERT INTO `friends` (`uid`, `withid`) VALUES ('$uid', '$id')");
			message("Success", "You have sent a friend request to this player.", "?id=".$id, "Back", false, '');
		}
	}
}
if ($_POST['statusupdate']){
	$statusupdate = strip_tags(nl2br(mysql_real_escape_string($_POST['statusupdate'])));
	mysql_query("UPDATE `accounts` SET `statusupdate`='$statusupdate' WHERE `id`='$uid'");
	echo "Status updated!";
}
?>
<center><div style="width: 100%; height: 30px; background-color: #2D81BA; color: white; text-align: center;"><?php if ($isOwned == true){ ?>Your Profile <a href="/My/CreateAd.php?id=<?php print_r($id); ?>&type=1"><font color="white"></font></a><?php }else{ print_r($array['Username']); ?>'s Profile<?php } ?>
<form action="" method="post">
</div></center><br>

<center><input type="text" name="statusupdate" placeholder="<?php print_r($user['statusupdate']); ?>"/>
<input type="submit" value="Update Status" id="buttonsmall" /></center>

</form>
<div style="width: 98%; max-width: 100%; max-height: 400px; overflow: auto; border: 1px solid black; background-color: white; color: black;">
<center><br>
<b><?php
print_r($array['Username']) ?> says: </b>
<?php
echo "
".nl2br($array['statusupdate'])."
";

?>
</center><br>
</div><br><br>
<table width="98%">
<tr>
<td width="49%">
<div style="width: 98%; max-width: 98%; border: 2px solid black; background-color: white; color: black; vertical-align: text-top; text-align: center;"><center>
<?php
drawCharacter($id);
?><br>
<?php
if (checkUserOnline($id) == true){
	?>
<center>
	<font color="#009900">[ ONLINE ]</font><br>
</center>
    <?php
}else{
	?>
<center>
	<font color="#CC0000">[ OFFLINE ]</font><br>
</center>
    <?php
}
?><br>
<div style="width: 98%; max-width: 100%; max-height: 400px; overflow: auto; border: 2px solid black; background-color: white; color: black;">
<center>
<?php
echo "
".nl2br($array['blurb'])."
";
?>
</center>
</div><br><br>

<br><br>
<?php if ($logged==true){ ?><table width="98%" style="text-align: center;"><tr>
<td><a href="Inbox/SendMessage.php?id=<?php print_r($id); ?>" id="buttonsmall">Message</a></td>
<?php
$k = mysql_fetch_array(mysql_query("SELECT * FROM `friends` WHERE `withid`='$id' AND `uid`='$uid'"));
if ($k == 0){
	?><td><a href="?id=<?php print_r($id); ?>&fr=true" id="buttonsmall" font-size: 50%;>Send Friend Request</a></td>
    <?php
}else{
	if ($_GET['remove']){
		mysql_query("DELETE FROM `friends` WHERE `withid`='$id' AND `uid`='$uid'");
		mysql_query("DELETE FROM `friends` WHERE `uid`='$id' AND `withid`='$uid'");
		message("Done", "You have removed this user from your friends list!", "?id=" . $id, "Back", false, '');
		die();
	}
	?>
        <td><a href="?id=<?php print_r($id); ?>&remove=true" id="buttonsmall">Unfriend</a></td>
    <?php
}
?>
<td><a href="?id=<?php print_r($id); ?>&rep=true" id="buttonsmall">Give Rep</a></td>
<td><a href="/Trade/?with=<?php print_r($id); ?>" id="buttonsmall">Trade</a></td>
<?php
if ($logged==true){
	if ($user['moderator'] == '1'){
		if ($_GET['deleter']){
			if ($_GET['ok']){
				mysql_query("DELETE FROM accounts WHERE id='$id'");
				message("ok", "done", "Players.php", "Go back", false, '');
				die();
			}else{
				message("Are you sure?", "?id=" . $id . "&deleter=true&ok=true", "Yep. Remove this User", true, "?id=" . $id);
			}
		}
		?>
        <td><a href="?id=<?php print_r($id); ?>&deleter=true"><font color="red"></font></a></td>
        <?php
	}
}
?>

</tr></table>
<br>
<?php
}
?>
<a href="<?php print_r($array['lastloc']); ?>"><font color="red"><?php print_r($array['lastloc']); ?></font></a><br />
<h6><a href="/Report/?type=1&id=<?php print_r($id); ?>">Report User</a></h6>
</center>
</div><br>
<div style="width: 98%; max-width: 98%; border: 2px solid black; background-color: white; color: black; vertical-align: text-top; text-align: left;">
<center><h3>User Statistics</h3><hr></center><br>
<table width="98%">
<tr>
<td>
<b>Join Date:</b>
</td>
<td>
<?php
print_r($array['joined']);
?>
</td>
</tr>
<tr>
<td>
<b>Friends:</b>
</td>
<td>
<?php
print_r(mysql_num_rows(mysql_query("SELECT * FROM `friends` WHERE `withid`='$id' ORDER BY id")));
?>
</td>
</tr>
<tr>
<td>
<b>Reputation Points:</b>
</td>
<td>
<?php print_r($array['Reputation']); ?>
</td>
</tr>

<tr>
<td>
<b>Forum Posts:</b>
</td>
<td>
<?php print_r($array['totalposts']); ?>
</td>
</tr>
<tr>
<td>
<b>Profile Views:</b>
</td>
<td>
<?php print_r($array['profileviews']); ?>
</td>
</tr>
</table>
</div>
<br>
<br>
<div style="width: 98%; max-width: 98%; border: 2px solid black; background-color: white; color: black; vertical-align: text-top; text-align: left;">
<center><h3>Player Badges</h3><hr></center><br>
<center><table><tr>
<?php
$f = mysql_query("SELECT * FROM `Job` WHERE `userid`='$id' ORDER BY id");
$ff = mysql_num_rows($f);
for ($count = 1; $count <= $ff; $count ++){
	$fr = mysql_fetch_array($f);
	if ($fr['jobid'] == '1'){
		?>
        <td width="100" height="150"><center><img src="/assets/Badges/badge_imageModerator.png" /><br>Image <br>Moderator</center></td>
        <?php
	}elseif ($fr['jobid'] == '2'){
		?>
        <td width="100" height="150"><center><img src="/assets/Badges/badge_developer.png" /><br>Developer</center></td>
        <?php
	}elseif ($fr['jobid'] == '3'){
		?>
        <td width="100" height="150"><center><img src="/assets/Badges/badge_communityManager.png" /><br>Community <br>Manager</center></td>
        <?php
	}elseif ($fr['jobid'] == '4'){
		?>
        <td width="100" height="150"><center><img src="/assets/Badges/badge_forumModerator.png" /><br>Forum <br>Moderator</center></td>
        <?php
	}elseif ($fr['jobid'] == '5'){
		?>
        <td width="100" height="150"><center><img src="/assets/Badges/badge_artist.png" /><br>Artist</center></td>
        <?php
	}elseif ($fr['jobid'] == '6'){
		?>
        <td width="100" height="150"><center><img src="/assets/Badges/badge_headModerator.png" /><br>Head<br />Moderator</center></td>
        <?php
	}
}
if ($array['Membership'] == '1'){
	?>
    <td width="100" height="150"><center><img src="/assets/Badges/Staff.png" /><br>Staff<br /></center></td>
    <?php
}

if ($array['administrator'] == '1'){
	?>
    <td width="100" height="150"><center><img src="/assets/Badges/badge_developer.png" /><br>Developer<br /></center></td>
    <?php
}

if ($array['artist'] == '1'){
        ?>
  <td width="100" height="150"><center><img src="/assets/Badges/badge_artist.png" /><br>Artist</center></td>
        <?php
}
if ($array['moderator'] == '1'){
        ?>
  <td width="100" height="150"><center><img src="/assets/Badges/badge_headModerator.png" /><br>Moderator</center></td>
        <?php
}
if ($array['streamer'] == '1'){
        ?>
  <td width="100" height="150"><center><img src="/assets/Badges/badge_streamer.png" /><br>Streamer</center></td>
        <?php
}
if ($array['veteran'] == '1'){
        ?>
  <td width="100" height="150"><center><img src="/assets/Badges/badge_veteran.png" /><br>Veteran</center></td>
        <?php
}


	
       ?>
    </tr>
    </table>

</center>
</div>
<br>
<div style="width: 150%; max-width: 98%; border: 2px solid black; background-color: white; color: black; vertical-align: text-top; text-align: center;">
<strong><?php print_r($array['Username']); ?>'s Inventory</strong><br />
<table width="98%">
<tr>
<td width="250" style="text-align: left;">
<a href="?id=<?php print_r($id); ?>&find=Hat#bottom" id="buttonsmall2">Hats</a><br /><br />
<a href="?id=<?php print_r($id); ?>&find=Mouth#bottom" id="buttonsmall2">Faces</a><br /><br />
<a href="?id=<?php print_r($id); ?>&find=Shirt#bottom" id="buttonsmall2">Shirts</a><br /><br />
<a href="?id=<?php print_r($id); ?>&find=Pants#bottom" id="buttonsmall2">Pants</a><br /><br />
<a href="?id=<?php print_r($id); ?>&find=Shoe#bottom" id="buttonsmall2">Shoes</a><br /><br />
<a href="?id=<?php print_r($id); ?>&find=Background#bottom" id="buttonsmall2">Backgrounds</a><br /><br />
<a href="?id=<?php print_r($id); ?>&find=Accessory#bottom" id="buttonsmall2">Accessories</a><br /><br />

</td>
<td>
<table>
<tr>
<?php
if ($_GET['find']){
	$find = mysql_real_escape_string($_GET['find']);
	$c = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `type`='$find' AND `ownerid`='$id'"));
	if ($c == 0){
		echo "This user doesn't have any of these items!";
	}
	$q = mysql_query("SELECT * FROM `inventory` WHERE `type`='$find' AND `ownerid`='$id' ORDER BY id DESC");
}else{
	$q = mysql_query("SELECT * FROM `inventory` WHERE `type`='Hat' AND `ownerid`='$id' ORDER BY id DESC");
}
$qq = mysql_num_rows($q);
$p = 0;
for ($count = 1; $count <= $qq; $count ++){
	$qr = mysql_fetch_array($q);
	$p ++;
	?>
    <td style="text-align: center; border: 1px solid black; background-color: #FFFFFF; border-radius: 2px;">
    <a href="/Store/Item.php?id=<?php print_r($qr['itemid']); ?>">
    <img src="/assets/Avatars/<?php print_r($qr['path']); ?>" border="0" /><br />
    <?php
	$t = $qr['name'];
	if (strlen($t) >= 14){
		$t = substr($qr['name'], 0, 14);
	}
	print_r($t);
	?>
    </a>
    </td>
    <?php
	if ($p == 6){
		$p = 0;
		echo "</tr><tr>";
	}
}
?>
</tr>
</table>
</td>
</tr>
</table>
</div>
</td>
<td style="vertical-align: text-top;">
<div style="border: 2px solid black; background-color: white; color: black; vertical-align: text-top; text-align: left;">
<center><h3>Friends (<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `friends` WHERE `withid`='$id' AND `request`='1' ORDER BY id"))); ?>)<hr></h3></center><br>
<table width="98%"><tr>
<?php
$f = mysql_query("SELECT * FROM `friends` WHERE `withid`='$id' AND `request`='1' ORDER BY id LIMIT 0, 6");
$ff = mysql_num_rows($f);
$c = 0;
for ($count = 1; $count <= $ff; $count ++){
	$c ++;
	$fr = mysql_fetch_array($f);
	$ui = $fr['uid'];
	$witharray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$ui'"));
	?>
    <td>
    <center>
    <?php
	drawCharacter($ui, 100, 100);
	?>
    <br>
    <a href="Profile.php?id=<?php print_r($ui); ?>"><?php print_r($witharray['Username']); ?></a>
    </center>
    </td>
    <?php
	if ($c == 3){
		$c = 0;
		echo "</tr><tr>";
	}
}
?>
</tr>
</table>

<center>
<a href="/My/Friends.php?id=<?php print_r($id); ?>">[Show More]</a>
</center>
</div><br>
<div style="border: 2px solid black; background-color: #FFFFFF; color: black; vertical-align: text-top; text-align: left;">
<center><h3>Groups (<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `groupmembers` WHERE `memberid`='$id' ORDER BY id")) + mysql_num_rows(mysql_query("SELECT * FROM `groups` WHERE `ownerid`='$id' ORDER BY id"))); ?>)</h3><hr></center><br>
<table width="98%"><tr>
<?php
$f = mysql_query("SELECT * FROM `groupmembers` WHERE `memberid`='$id' ORDER BY id LIMIT 0, 6");
$ff = mysql_num_rows($f);
$c = 0;
for ($count = 1; $count <= $ff; $count ++){
	$c ++;
	$fr = mysql_fetch_array($f);
	$ui = $fr['groupid'];
	$witharray = mysql_fetch_array(mysql_query("SELECT * FROM `groups` WHERE `id`='$ui'"))or die(mysql_error());
	?>
    <td>
    <center>
    <img style="width: 100px; height: auto;" src="/assets/groupimg/<?php print_r($witharray['logopath']); ?>">
    <br>
    <a href="Communities/Community.php?id=<?php print_r($witharray['id']); ?>"><?php print_r($witharray['name']); ?></a>
    </center></td>
    <?php
	if ($c == 3){
		$c = 0;
		echo "</tr><tr>";
	}
}
?></tr><tr>
<?php
$f = mysql_query("SELECT * FROM `groups` WHERE `ownerid`='$id' ORDER BY id LIMIT 0, 6");
$ff = mysql_num_rows($f);
$c = 0;
for ($count = 1; $count <= $ff; $count ++){
	$c ++;
	$fr = mysql_fetch_array($f);
	$witharray = $fr;
	?>
    <td>
    <center>
    <img style="width: 100px; height: auto;" src="/assets/groupimg/<?php print_r($witharray['logopath']); ?>">
    <br>
    <a href="Communities/Community.php?id=<?php print_r($fr['id']); ?>"><?php print_r($witharray['name']); ?></a>
    </center></td>
    <?php
	if ($c == 3){
		$c = 0;
		echo "</tr><tr>";
	}
}
?>
</tr>
</table><br>
<center>
<a href="/My/Groups.php?id=<?php print_r($id); ?>">[Show More]</a>
</center>
</div>
</td>
</tr>
</table><br><br>


<a name="bottom"></a>
<?php
include "Footer.php";