<?php 
$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
$version = isset($_GET["version"]) ? filter_var($_GET["version"], FILTER_SANITIZE_NUMBER_INT) : -1; // -1 is the latest version internally.
	
header('Content-Type: text/plain');
// TODO: move isRobloxRequest somewhere else on this site
function isRobloxRequest() {
	return explode('.', $_SERVER['SERVER_NAME'])[0] == "rbx";
}
if (file_exists('./'.$id)) {
	$jsonData = file_get_contents("./".$id);
	if ((1 <= $id) && ($id <= 50)) {
		//this is a snippet of code from the coke14 webserver itself
		$data = ($_SERVER['HTTP_USER_AGENT'] == "Roblox/WinInet" ? "" : "\n") . ($_SERVER['HTTP_USER_AGENT'] == "Roblox/WinInet" ? "%" : "--rbxassetid%") . $id . "%" .  "\n" . $jsonData;
		$key = file_get_contents("../sign/sign.txt");
		// TODO: move this code somewhere else. preferably into some sort of generateSignature function
		openssl_sign($data, $sig, $key, OPENSSL_ALGO_SHA1);
		$jsonData = ($_SERVER['HTTP_USER_AGENT'] == "Roblox/WinInet" ? "%" : "--rbxsig%") . base64_encode($sig) . "%" . $data;
	}
	echo $jsonData;
} else {
	if (load($id) == true and $find->IsPublicDomain == 1 && !isRobloxRequest()) {
		if (file_exists($_SERVER["DOCUMENT_ROOT"].'/assets/'.$id)) {
			echo(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/assets/'.$id));
		}else {
			// Redirect to our CDN
			$location = "http://assetgame.roblonium.com/asset/$id";
			header("Location: $location");
		}
	}else {
		// Thanks Carrot for this code :) -Brent
		// This might be a Roblox asset. Lets fetch it from Roblox
		$url = "https://assetdelivery.roblox.com/v1/assetId/$id";
		if ($version != -1) // Get specific version
		{
			$url .= "/version/$version";
		}
		
		$options = ["http" => ["user_agent" => "Roblox"]]; // Set user agent because of KTX
		$context = stream_context_create($options);
		$asset = @file_get_contents("https://assetdelivery.roblox.com/v1/assetId/$id", false, $context);

		if (isset($asset))
		{
			$asset = json_decode($asset, true);
			if ($asset !== false && isset($asset["errors"]))
			{
				if ((int)$asset["errors"][0]["code"] == 0)
				{
					// We messed up something
					http_response_code(400);
					exit();
				}

				http_response_code((int)$asset["errors"][0]["code"]); // handles 404, 409, etc.
				exit();
			}

			// Redirect to Roblox asset (TODO: Can we just serve this directly? Some clients have an error with 312)
			$location = $asset["location"];
			header("Location: $location");
		}
		else
		{
			// Internal error
			http_response_code(400);
			exit();
		}
	}
}
?>