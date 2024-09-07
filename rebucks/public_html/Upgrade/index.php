<?php
include('../global.php');
?>
<table width="98%">
<tr><td width="80%" style="border-right: 1px solid grey">
<h1>Membership Upgrades</h1><br />
<center>
<table>
<tr>
<td width="250" style="border-right: 0px solid #999; text-align: center; vertical-align: text-top;">
To buy upgrades please add the owner on skype: The2beast3
<hr>
</td>
</tr>
</table>
<br>
<table width="98%">
<tr>
<td width="250" style="border-bottom: 1px solid #999;"></td>
<td width="250" style="border-bottom: 1px solid #999;"><b>Free</b></td>
<td width="250" style="border-bottom: 1px solid #999;"><b>Premium</b></td>
<td width="250" style="border-bottom: 1px solid #999;"><b>God</b></td>
</tr>
<td width="250" style="border-bottom: 1px solid #999;">
10k Robux Per upload [Anything]
</td>
<td width="250" style="border-bottom: 1px solid #999;">
No
</td>
<td width="250" style="border-bottom: 1px solid #999;">
No
</td>
<td width="250" style="border-bottom: 1px solid #999;">
Yes
</td>
<tr>
<td width="250" style="border-bottom: 1px solid #999;">
Messaging System v2
</td>
<td width="250" style="border-bottom: 1px solid #999;">
No
</td>
<td width="250" style="border-bottom: 1px solid #999;">
Yes
</td>
<td width="250" style="border-bottom: 1px solid #999;">
Yes
</td>
</tr>
<tr>
<td width="250" style="border-bottom: 1px solid #999;">
Second Currency
</td>
<td width="250" style="border-bottom: 1px solid #999;">
No
</td>
<td width="250" style="border-bottom: 1px solid #999;">
Yes
</td>
<td width="250" style="border-bottom: 1px solid #999;">
Yes
</td>
</tr>
<tr>
<td width="250" style="border-bottom: 1px solid #999;">
Trade Currency
</td>
<td width="250" style="border-bottom: 1px solid #999;">
No
</td>
<td width="250" style="border-bottom: 1px solid #999;">
Yes
</td>
<td width="250" style="border-bottom: 1px solid #999;">
Yes
</td>
</tr>
<tr>
<td width="250" style="border-bottom: 1px solid #999;">
Daily Currency
</td>
<td width="250" style="border-bottom: 1px solid #999;">
20 Bucks
</td>
<td width="250" style="border-bottom: 1px solid #999;">
100 Bucks, 40 Reebs
</td>
<td width="250" style="border-bottom: 1px solid #999;">
5000 Bucks, 40 Reebs
</td>
</tr>
<tr>
<td width="250" style="border-bottom: 1px solid #999;">
New Theme
</td>
<td width="250" style="border-bottom: 1px solid #999;">
No
</td>
<td width="250" style="border-bottom: 1px solid #999;">
Yes
</td>
</td>
<td width="250" style="border-bottom: 1px solid #999;">
Yes
</td>
</tr>
<tr>
<td width="250" style="border-bottom: 1px solid #999;">
Group Costs
</td>
<td width="250" style="border-bottom: 1px solid #999;">
100 Bucks
</td>
<td width="250" style="border-bottom: 1px solid #999;">
FREE
</td>
<td width="250" style="border-bottom: 1px solid #999;">
FREE
</td>
</tr>
</table><br /><br /></center>
<?php
if ($logged==true){
	if ($user['Membership'] == '1'){
		?>
        Your Membership Expires on <?php echo date("Y-m-d H:i:s",$user['Expire']); 
	?></h3>
    <?php
	}else{
		?>You do not have a premium membership!</h3>
Come on, join us! Buy a membership and you'll get lots of nice things. Still not convinced? Compare a free user account to a membership plan, that'll get you pumpin'.<br /><br />
<?php
	}
} ?>
</td>
</tr>
</table>
