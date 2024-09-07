<?php
include('../Site/init.php'); error_reporting(0);
	$Name = $_GET["uname"];
    $getUser = $handler->query("SELECT * FROM users WHERE username='".$Name."'");
    $gU = $getUser->fetch(PDO::FETCH_OBJ);
	// These appearances are hardcoded and like this because this feature wasn't finished before I closed the project

	header("Content-Type: text/plain");

	$DefaultAppearance = "http://rhodum.xyz/charapp/DefaultColors;http://rhodum.xyz/Hat/?file=rhodum.rbxm;http://rhodum.xyz/Hat/?file=$gU->hat.rbxm";
	$Appearance = "";

	if (preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $Name))
	{
		if ($Name == "BlockIX") 
		{
			$Appearance = "http://rhodum.xyz/charapp/AdminColors;http://rhodum.xyz/Hat/?file=rhodum.rbxm;http://rhodum.xyz/Hat/?file=$gU->hat.rbxm";
		} 
		elseif ($Name == "AnotherUsername")
		{
			$Appearance = "http://rhodum.xyz/charapp/DefaultColors;http://rhodum.xyz/Hat/?file=rhodum.rbxm;http://www.roblox.com/asset?id=1028606&version=2";
		} 
		elseif ($Name == "User")
		{
			$Appearance = "http://rhodum.xyz/charapp/DefaultColors;http://rhodum.xyz/Hat/?file=rhodum.rbxm;http://www.roblox.com/asset/?id=2972302&version=1";
		}
		else
		{
			$Appearance = $DefaultAppearance;
		}
	} else {
		$Appearance = $DefaultAppearance;
	}

	echo $Appearance;

?>
