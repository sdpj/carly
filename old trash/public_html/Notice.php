<?php
	include "Header.php";
	
		if ($User) {
		
			echo "
			<div id='LargeText'>
				<h1><b><font color= 'darkred'><center>Administration Alert</b></font></center></h1>
			</div>
			<h4><center><b>An administration alert has been ordered for all users to review.</b></center></h4>
			<br />
			<br />
			
			";
			
			$getNotice = mysql_query("SELECT * FROM Notice");
			$gN = mysql_fetch_object($getNotice);
			
			$getPoster = mysql_query("SELECT * FROM Users WHERE ID='$gN->UserID'");
			$gP = mysql_fetch_object($getPoster);
			
			echo "
<div align='left'>
					<h5>Posted by: <font color= 'blue'><b>Administration</b></font></h5>
					</div>
<font color= 'darkblue'>Hello,</font>
<br>
</br>
			<center>

				<div style='border:1px solid black; background-color:lightgrey; width:45%;'><br />
					<center>
					<font color= 'darkblue'>	$gN->Text </font>
					</center>
					<br />
				</div>
			</center>
<div align='right'>
<b><font color= 'darkblue'>Gravitar Administration</font></b>
</div>
			<br />
			<br />
			<font color= 'red'>You may now browse the website as you choose. Click <a href= '../index.php'><font color= 'blue'>here</FONT></a> to go home.</font>
			";
		
		}
	
	include "Footer.php";
?>
