<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	$ID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ID'])));
	if (!$User){
	header("Location: index.php");
	}
	if (!$ID){
		echo"
		<strong>
			Please provide a message ID!
		</strong>
		";
		exit;
	}else{
		$getMessage = mysql_query("SELECT * FROM PMs WHERE ID='".$ID."'");
		$gM = mysql_fetch_object($getMessage);
		if ($gM->ReceiveID != $myU->ID){
			echo"
			<strong>
				That message does not exist!
			</strong>
			";
			exit();
		}
		if ($gM->LookMessage == "0"){
			mysql_query("UPDATE PMs SET LookMessage='1' WHERE ID='".$ID."'");
			header("Location: /ViewMessage.aspx?ID=".$ID."");
		}
		$getSender = mysql_query("SELECT * FROM Users WHERE ID='".$gM->SenderID."'");
		$gS = mysql_fetch_object($getSender);
		$Method = mysql_real_escape_string(strip_tags(stripslashes($_GET['Method'])));
		if (!$Method){
			echo"
			<div id='view-msg-title'>
				".$gM->Title."
			</div>
			";
		}
	}
?>

<?
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>