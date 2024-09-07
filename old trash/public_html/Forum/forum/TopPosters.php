<?php

include "../Header.php";
echo "<font color='#343434' size='5'><b>Top 10 Posters</b></font><div class='divider-bottom' style='width:100%;padding-top:3px;margin-bottom:5px;'></div>";

$getTopPosters = mysql_query("SELECT * FROM Users ORDER BY ForumPost DESC LIMIT 0,10");
echo"
	 				<table>
						<tr>
							<td width='630'>
								<b><font size='3'><font color='white'>Username</font></font></b>
							</td>
							<td width='190'>
								<b><font size='3'><font color='white'></font></font></b>
							</td>
							<td width='175'>
								<b><font size='3'><font color='white'></font></font></b>
							</td>
							<td width='100'>
								<b><font size='3'><font color='white'></font></font></b>
							</td></td>
							<td width='50'>
								<b><font size='3'><font color='white'>Posts</font></font></b>
							</td>
						</tr>
					</table>
";
while ($gT = mysql_fetch_object($getTopPosters)){
echo"<table style='padding-top:5px;padding-bottom:5px;'>
						<tr>
							<td width='990'>
								<font color='#343434' size='3'>&nbsp;&nbsp;&nbsp;$gT->Username</font>
</td>
<td width='50'>
<font color='#343434' size='3'>&nbsp;&nbsp;&nbsp;$gT->ForumPost</font>
</td>
</tr>
</table>
							";
}
echo"</div></div></div></div>";
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");