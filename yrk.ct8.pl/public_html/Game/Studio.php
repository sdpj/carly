<?php error_reporting(0); // THANK YOU WATERBOI, NOW IM GONNA CONNECT IT TO THE ACTUAL ON-SITE ACCOUNTS

    function get_signature($script)

    {

        $signature = "";

        openssl_sign($script, $signature, file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/joining/PrivateKey.pem"), OPENSSL_ALGO_SHA1);

        return base64_encode($signature);

    }

    header("Content-Type: text/plain");


    // Construct joinscript

    $joinscript = [

        "PingReceiver" => "https://assetgame.yrk.ct8.pl/Game/ClientPresence.ashx?version=old&PlaceID=0",

        "PingIntervalInSeconds" => 120,

        "UserId" => "",

        "MainGuiScriptID" => 37801172,

        "AssetUrl" => "https://assetgame.yrk.ct8.pl/Asset/",

        "BaseUrl" => "http://www.yrk.ct8.pl/",

        "ApiProxyEndPoint" => "https://api.yrk.ct8.pl",

        "UserId" => "$id",

        "SuperSafeChat" => false,

        "CharacterAppearance" => "http://yrk.ct8.pl/joining/usercharapp.txt",

    ];



    // Encode it!

    $data = json_encode($joinscript, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);



    // Sign joinscript

    $signature = get_signature("\r\n" . $data);



    // exit

    exit("--rbxsig%". $signature . "%\r\n" . $data);

?>