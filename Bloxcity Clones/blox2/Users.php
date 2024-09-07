<?php
include "Header.php";
$Setting = array(
  "PerPage" => 6
);
$PerPage = 6;
$Page = mysql_real_escape_string(strip_tags(stripslashes($_GET['Page'])));
if ($Page < 1) { $Page=1; }
if (!is_numeric($Page)) { $Page=1; }
$Minimum = ($Page - 1) * $Setting["PerPage"];
$allusers = mysql_query("SELECT * FROM Users");
$num = mysql_num_rows($allusers);
$getConfig = mysql_query("SELECT * FROM Configuration");
$gC = mysql_fetch_object($getConfig);
//query


  //search
  $q = mysql_real_escape_string(strip_tags(stripslashes($_POST['q'])));
  $s = mysql_real_escape_string(strip_tags(stripslashes($_POST['s'])));
echo"
  <form action='' method='POST'>
    <center><div id='aB' style='width:99%;border-top-left-radius:5px;border-top-right-radius:9px;'>
      <center>
        <table>
          <tr>
              <h4>Users:&nbsp;"; $Users = mysql_num_rows($Users = mysql_query("SELECT * FROM Users")); echo "
".number_format($Users)."</h4>
          </tr>
        </table>
      </center>
    </div>
  </form>
  <Br />
  ";
  echo "<center>
  
  <table style='table-layout: fixed;width:20%;'><tr>";
  if (!$s) {
  $getMembers = mysql_query("SELECT * FROM Users WHERE Ban='0' ORDER BY ID ASC LIMIT {$Minimum},  ". $Setting["PerPage"]);
  }
  else {
  $getMembers = mysql_query("SELECT * FROM Users WHERE Username LIKE '%$q%' ORDER BY ID");
  }
    $counter = 0;
    if (!$s) {
    while ($gM = mysql_fetch_object($getMembers)) {
      $counter++;
      echo "<td style='width:170px;border: 0px solid #bbb;border-radius:5px;' width='100px;'><center><a href='/User.php?Profile=$gM->Username' border='0'>";if($gC->Avatars == "2sex"){echo"<img src='https://avatars.mine2build.eu/$gM->Avatar3D' width='300' height='350'>";}elseif($gC->Avatars == "3D"){echo"<img src='/Avatars/$gM->Avatar3D' width='256' height='256'>";};echo"<br /><smalltextlink>$gM->Username</smalltextlink></a></td> &nbsp;  &nbsp; ";
      if ($counter>= 6) {
        echo "</tr><tr>";
        $counter = 0;
      }
    }
    }
    else {
    
        while ($gM = mysql_fetch_object($getMembers)) {
      $counter++;
      echo "<td style='width:0px;' width='0px'><a href='/Profile/$gM->Username' border='0'>";if($gC->Avatars == "3D"){echo"<img src='https://avatars.mine2build.eu/$gM->Avatar3D' width='300' height='350'>";}elseif($gC->Avatars == "2D"){echo"<img src='/GetCharacter2D?ID=$gM->ID'>";};echo"<br />$gM->Username</a></td>";
      if ($counter>= 6) {
        echo "</tr><tr>";
        $counter = 0;
      }
      }
    
    }
  echo "</tr></table><center>";
$amount=ceil($num / $Setting["PerPage"]);
if ($Page > 1) {
echo '<a href="?Page='.($Page-1).'"><img src="/caret.png" height=15px></a> ';
}
if (!$Page > 1) {
echo '<img src="/caret.png" height=15px> ';
}
echo ''.$Page.'/'.(ceil($num / $Setting["PerPage"]));
if ($Page < ($amount)) {
echo ' <a href="?Page='.($Page+1).'"><img src="/caret.png" height=15px style="transform: scaleX(-1);"></a>';
}



include "Footer.php";
?>