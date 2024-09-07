<?php
include "Header.php";
if ($myU->PowerImageModerator == "true")
{
?>
<font color="red" size="5">NO RECOLORED ITEMS</font><Br><br>
<?php
$getPending = mysql_query("SELECT * FROM UserStore WHERE active='0'");
$num_pending = mysql_num_rows($getPending);
if($num_pending == "0")
{
	echo "<b>No items to be moderated.</b>";
}

else
{
echo "<table style='font-size:10pt;'><tr>";
while ($gP = mysql_fetch_object($getPending))
{
$gcreator = mysql_query("SELECT * FROM Users WHERE ID='".$gP->CreatorID."'");
$gc = mysql_fetch_object($gcreator);

	echo "
	<td id='unApproveditem' width='215'>
	<center>
	<img src='/Store/Dir/".$gP->File."' width='100' height='200'>
	<br>
	<div align='left'>
	<br>
	<table width='100%'>
		<tr>
			<td>
				<b>
					Name:
				</b>
			</td>
			<td>
				$gP->Name
			</td>
		</tr>
			<td>
				<font color='green'>
					<b>
						BUX:
					</b>
				</font>
			</td>
			<td>
				<font color='green'>
					<b>
						".$gP->Price."
					</b>
				</font>
			</td>
		</tr>
		<tr>
			<td>
				<b>
					Creator:
				</b>
			</td>
			<td>
				".$gc->Username."
			</td>
		</tr>
		<tr>
			<td>
				<b>Type:</b>
			</td>
			<td>
				".$gP->Type."
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
		</tr>
	</table>
<a href='?Accept=Yes&ID=".$gP->ID."'><font color='green'>Accept</font></a> / <a href='?Accept=No&ID=".$gP->ID."'><font color='red'>Deny</font></a>
<br /><br />
	</div>
	</td>";

}

$Accept = mysql_real_escape_string(strip_tags(stripslashes($_GET['Accept'])));
$ID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ID'])));

if($Accept == "Yes" && $ID)
{

	mysql_query("UPDATE UserStore SET active='1' WHERE ID='$ID'");
	$Uploader = "".$gP->Username."";
	header("Location: $self");

}

if($Accept == "No" && $ID)
{
	$File = "Dir/".$gP->File."";
	unlink($File);
	mysql_query("DELETE FROM UserStore WHERE ID='$ID'");
	header("Location: $self");

}
}


}
else { header("Location: index.php"); exit();
}
echo "</tr></table>";
include "Footer.php";