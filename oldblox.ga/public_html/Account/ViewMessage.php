<?php
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
?>

<?php
	$ID = SecurePost($_GET['ID']);
	
		if (!$User) {
		
			header("Location: ");
			die();
		
		}
		if (!$ID) {
		
			header("Location: ");
		die();
		
		}
		else {
		
			$getMessage = mysql_query("SELECT * FROM PMs WHERE ID='$ID'");
			$gM = mysql_fetch_object($getMessage);
			
				if ($gM->ReceiveID != $myU->ID) {
				
					echo "<b>Error.</b>";
					exit;
					
				}
				if ($gM->LookMessage == "0") {
				mysql_query("UPDATE PMs SET LookMessage='1' WHERE ID='$ID'");
				header("Location: ViewMessage.php?ID=$ID");
				die();
				}
				//sender id
				
				$getSender = mysql_query("SELECT * FROM Users WHERE ID='$gM->SenderID'");
				$gS = mysql_fetch_object($getSender);
				$Display1 = date("m/d/Y",$gM->time);
				$Display2 = date("g:i A",$gM->time);
				
				echo "
				
					<font size='5'>".$gM->Title."</font>
									<br>	<a href='#ReplyArea' onclick='setReplyBox();' class='btn-control-prof'>Reply</a> 

											<div class='divider-bottom' style='padding-top:10px;margin-bottom:10px;'></div>

				<div id=''>
					<a href='../user.aspx?ID=".$gS->ID."' style='color:black;'>
								<img src='/Avatar.php?ID=".$gS->ID."' height='100'>
							
								</a>
					<br>

					<br>
						<a href='../user.aspx?ID=$gS->ID'>".$gS->Username."</a> wrote at ".$Display1." ".$Display2." <br><br>
								".nl2br($gM->Body)."
								<br />
							
						
				</div>
				";
			
				
						
					
		?>
<!DOCTYPE html>
<body>
<script>
function setReplyBox() {
var content = "<br><form action='' method='post'><textarea name='Body' rows='15' cols='40'  style='width:500px;resize:none;'></textarea><br><br><input type='submit' class='btn-control-prof' name='SubmitReply' value='Send'></form>";
document.getElementById("ReplyArea").innerHTML = content;
}
</script>
</body>
</html> 

<?echo"
<div id='ReplyArea'></div>";
$Body = mysql_real_escape_string(strip_tags(stripslashes($_POST['Body'])));
$SubmitReply = mysql_real_escape_string(strip_tags(stripslashes($_POST['SubmitReply'])));
						
							if ($SubmitReply) {
							
								$Body = filter($Body);
								$Bodies = "
$Body								
-------------------------------------------------------------------
$gS->Username wrote:

$gM->Body";
								
								
								mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body, time) VALUES('$myU->ID','$gM->SenderID','RE: $gM->Title','".$Bodies."','".$now."')");
								header("Location: inbox.aspx");
								die();
							
							}
					
					}
echo"</div>";
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
