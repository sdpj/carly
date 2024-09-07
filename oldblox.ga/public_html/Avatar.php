<?
    @mysql_connect("mysql.ct8.pl","m27001_oldblox","OldBlox1#");
    mysql_select_db("m27001_oldblox");
$ID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ID'])));
$Username = mysql_real_escape_string(strip_tags(stripslashes($_GET['Username'])));
if (!$Username) {
$getUser = mysql_query("SELECT * FROM Users WHERE ID='".$ID."'");
}
else {
$getUser = mysql_query("SELECT * FROM Users WHERE Username='".$Username."'");
}
$gU = mysql_fetch_object($getUser);

//stuff


$Body = $gU->Body;
if (empty($Body)) {
$Body = "Avatar.png";
}

$Background = $gU->Background;
if (empty($Background)) {
$Background = "thingTransparent.png";
}

$Eyes = $gU->Eyes;
if (empty($Eyes)) {
$Eyes = "thingTransparent.png";
}

$Mouth = $gU->Mouth;
if (empty($Mouth)) {
$Mouth = "thingTransparent.png";
}

$Hair = $gU->Hair;

if (empty($Hair)) {
$Hair = "thingTransparent.png";
}

$Bottom = $gU->Bottom;
if (empty($Bottom)) {
$Bottom = "thingTransparent.png";
}

$Top = $gU->Top;
if (empty($Top)) {
$Top = "thingTransparent.png";
}

$Hat = $gU->Hat;
if (empty($Hat)) {
$Hat = "thingTransparent.png";
}

$Shoes = $gU->Shoes;
if (empty($Shoes)) {
$Shoes = "thingTransparent.png";
}

$Accessory = $gU->Accessory;
if (empty($Accessory)) {
$Accessory = "thingTransparent.png";
}



class StackImage
{
  private $image;
  private $width;
  private $height;
  
  public function __construct($Path)
  {
    if(!isset($Path) || !file_exists($Path))
      return;
    $this->image = imagecreatefrompng($Path);
    imagesavealpha($this->image, true);
    imagealphablending($this->image, true);
    $this->width = imagesx($this->image);
    $this->height = imagesy($this->image);
  }
  
  public function AddLayer($Path)
  {
    if(!isset($Path) || !file_exists($Path))
      return;
    $new = imagecreatefrompng($Path);
    imagesavealpha($new, true);
    imagealphablending($new, true);
    imagecopy($this->image, $new, 0, 0, 0, 0, imagesx($new), imagesy($new));
  }
  
  public function Output($type = "image/png")
  {
    header("Content-Type: {$type}");
    imagepng($this->image);
    imagedestroy($this->image);
  }
  
  public function GetWidth()
  {
    return $this->width;
  }
  
  public function GetHeight()
  {
    return $this->height;
  }
}
$Image = new StackImage("Catalog/Dir/Avatar.png");
$Image->AddLayer("Catalog/Dir/".$Background."");
$Image->AddLayer("Catalog/Dir/".$Body."");
$Image->AddLayer("Catalog/Dir/".$Eyes."");
$Image->AddLayer("Catalog/Dir/".$Mouth."");
$Image->AddLayer("Catalog/Dir/".$Bottom."");
$Image->AddLayer("Catalog/Dir/".$Top."");
$Image->AddLayer("Catalog/Dir/".$Hair."");
$Image->AddLayer("Catalog/Dir/".$Hat."");
$Image->AddLayer("Catalog/Dir/".$Shoes."");
$Image->AddLayer("Catalog/Dir/".$Accessory."");
if (time() < $gU->expireTime) {
  $Image->AddLayer("Imagess/Online.png");
  }else{
  $Image->AddLayer("Imagess/Offline.png");
  }
  if ($gU->Premium == 1) {
  $Image->AddLayer("Images/Builder.png");
  }
  elseif ($gU->Premium == 2) {
  $Image->AddLayer("Images/Constructor.png");
  }
  elseif ($gU->Premium == 3) {
  $Image->AddLayer("Images/Architect.png");
  }
$Image->Output();
?>