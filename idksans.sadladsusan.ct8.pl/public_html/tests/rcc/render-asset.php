<?php $path = "../../../"; // include $path."private/includes/neek/connect.php";

$torsoColor = "";
$rightLegColor = "";
$leftLegColor = "";
$rightArmColor = "";
$leftArmColor = "";
$headColor = "";
$tShirt = "";
$pants = "";
$shirt = "";
$face = "";

$face = htmlspecialchars($_GET["face"]);
$shirt = htmlspecialchars($_GET["shirt"]);
$pants = htmlspecialchars($_GET["pants"]);
$tShirt = htmlspecialchars($_GET["tShirt"]);
$headColor = htmlspecialchars($_GET["headColor"]);
$leftArmColor = htmlspecialchars($_GET["leftArmColor"]);
$rightArmColor = htmlspecialchars($_GET["rightArmColor"]);
$leftLegColor = htmlspecialchars($_GET["leftLegColor"]);
$rightLegColor = htmlspecialchars($_GET["rightLegColor"]);
$torsoColor = htmlspecialchars($_GET["torsoColor"]);

$test = $_GET["shirt"];

if ($test == '""') {
	$studs = "rbxasset://studs.png";
}
else {
	$studs = "";
}
//The XML string that you want to send.

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:SOAP-ENC=\"http://schemas.xmlsoap.org/soap/encoding/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:ns2=\"http://roblox.com/RCCServiceSoap\" xmlns:ns1=\"http://roblox.com/\" xmlns:ns3=\"http://roblox.com/RCCServiceSoap12\">
    <SOAP-ENV:Body>
        <ns1:OpenJob>
            <ns1:job>
                <ns1:id>3</ns1:id>
                <ns1:expirationInSeconds>1</ns1:expirationInSeconds>
                <ns1:category>1</ns1:category>
                <ns1:cores>321</ns1:cores>
            </ns1:job>
            <ns1:script>
                <ns1:name>Script</ns1:name>
                <ns1:script>
							print($face)
							player = game:GetService(\"Players\"):CreateLocalPlayer(0)
							player:LoadCharacter(0)
							player.Character.Head.face.Texture = $face
							studs = Instance.new(\"Shirt\", player.Character)
							studs.ShirtTemplate = \"$studs\"
							shirt = Instance.new(\"Shirt\", player.Character)
							shirt.ShirtTemplate = $shirt
							tShirt = Instance.new(\"ShirtGraphic\", player.Character)
							tShirt.Graphic = $tShirt
							pants = Instance.new(\"Pants\", player.Character)
							pants.PantsTemplate = $pants
							bodyColors = Instance.new(\"BodyColors\", player.Character)
							print($headColor)
							bodyColors.HeadColor = BrickColor.new($headColor)
							bodyColors.LeftArmColor = BrickColor.new($leftArmColor)
							bodyColors.RightArmColor = BrickColor.new($rightArmColor)
							bodyColors.LeftLegColor = BrickColor.new($leftLegColor)
							bodyColors.RightLegColor = BrickColor.new($rightLegColor)
							bodyColors.TorsoColor = BrickColor.new($torsoColor)
							print($torsoColor)
							return game:GetService(\"ThumbnailGenerator\"):Click(\"PNG\", 2160, 2160, true)
				</ns1:script>
            </ns1:script>
        </ns1:OpenJob>
    </SOAP-ENV:Body>
</SOAP-ENV:Envelope>";


//The URL that you want to send your XML to.
$url = 'http://24.176.90.134:33333';

//Initiate cURL
$curl = curl_init($url);

//Set the Content-Type to text/xml.
curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));

//Set CURLOPT_POST to true to send a POST request.
curl_setopt($curl, CURLOPT_POST, true);

//Attach the XML string to the body of our request.
curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);

//Tell cURL that we want the response to be returned as
//a string instead of being dumped to the output.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Execute the POST request and send our XML.
$result = curl_exec($curl);

//Do some basic error checking.
if(curl_errno($curl)){
    throw new Exception(curl_error($curl));
}

//Close the cURL handle.
curl_close($curl);

$funnybase  = $result;
$luashit = array('LUA_TTABLE', "LUA_TSTRING");

$data = str_replace($luashit, "", $funnybase);

//echo $data;
$almost = strstr($data, '<ns1:value>');
$luashit = array('<ns1:value>', "</ns1:value></ns1:OpenJobResult><ns1:OpenJobResult><ns1:type></ns1:type><ns1:table></ns1:table></ns1:OpenJobResult></ns1:OpenJobResponse></SOAP-ENV:Body></SOAP-ENV:Envelope>");

$yeah = str_replace($luashit, "", $almost);
//echo $yeah;

$decoded = base64_decode($yeah);
file_put_contents("yeah.png",$decoded);

// $im = imagecreatefrompng("yeah.png");

header('Content-Type: image/png');

// imagepng($im);
// imagedestroy($im);
echo $decoded;

?>