<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
$Setting = array(
  "PerPage" => 18
);
$Page = $_GET['Page'];
if ($Page < 1) { $Page=1; }
if (!is_numeric($Page)) { $Page=1; }
$Minimum = ($Page - 1) * $Setting["PerPage"];
//for
$getall = mysql_query("select * from UserStore");
$all = mysql_num_rows($getall);
//query
$allusers = mysql_query("SELECT * FROM UserStore ORDER BY ID DESC");
$num = mysql_num_rows($allusers);
$i = 0;
$Num = ($Page+8);
$a = 1;
$Log = 0;
?>
<?php
echo "<h4 style='text-align:center;margin-bottom:0px;'>Store</h4>
      <form action='' method='POST'>

<table cellspacing='0' cellpadding='0' width='100%'>
  <tr>
    <td width='50%'>
    <div id='LargeText'>
    </div>  
    </td>
    <td>
        <table cellspacing='0' cellpadding='0'>
          <tr>
            <td>
              <center><input type='text' name='q' style='width:200px;'></center>

              <center><input type='submit' name='s' value='Search' class='btn blue' style=''></center>
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>
<table cellspacing='0' cellpadding='0' width='100%'><tr><td valign='top'>
<table width='98%'>
  <tr>
    <td width='50%'>
      ";
      if($User) { if($myU->PowerArtist == "turkey") { echo "Please login or have the correct ranks!"; } else
      echo "
        
      ";
      }
      echo "
        <table>
          
          <tr>
            <td>
              <a href='?Sort=Mouths' style='font-weight:bold;color:#777;'>Faces</a>
            </td>
          </tr>
          <tr>
            <td>
              <a href='?Sort=Hair' style='font-weight:bold;color:#777;'>Hair</a>
            </td>
          </tr>
          <tr>
            <td>
              <a href='?Sort=Top' style='font-weight:bold;color:#777;'>Shirts</a>
            </td>
          </tr>
          <tr>
            <td>
              <a href='?Sort=Bottom' style='font-weight:bold;color:#777;'>Pants</a>
            </td>
          </tr>
          <tr>
            <td>
              <a href='?Sort=Shoes' style='font-weight:bold;color:#777;'>T-Shirts</a>
            </td>
          </tr>
          <tr>
            <td>
              <a href='?Sort=Hats' style='font-weight:bold;color:#777;'>Hats</a>
            </td>
          </tr>
          <tr>
            <td>
              <a href='?Sort=Accessories' style='font-weight:bold;color:#777;'>Accessories</a>
            </td>
          </tr>
        </table><br>
<a href='/Store/Upload.php' class='btn blue'>Create</a>
    </td>
    <td>
    
    </td>
  </tr>
</table>
</td><td align='center'>
";

echo "<center><table><tr>";
    $q = mysql_real_escape_string(strip_tags(stripslashes($_POST['q'])));
    $s = mysql_real_escape_string(strip_tags(stripslashes($_POST['s'])));
    $Sort = mysql_real_escape_string(strip_tags(stripslashes($_GET['Sort'])));
    
    
      if (!$Sort) {
    
      if (!$s) {
      
        $getItems = mysql_query("SELECT * FROM UserStore WHERE Active='1' AND itemDeleted='0' ORDER BY ID DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
      
      }
      elseif ($s) {
      
        $getItems = mysql_query("SELECT * FROM UserStore  WHERE Name LIKE '%$q%' AND Active='1' AND itemDeleted='0' ORDER BY ID DESC");
      
      }
      }
      else {
      $getItems = mysql_query("SELECT * FROM UserStore WHERE Active='1' AND itemDeleted='0' AND Type='$Sort' ORDER BY ID DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
      }
  
    $counter = 0;
  
    while ($gI = mysql_fetch_object($getItems)) {
    
      $counter++;
    
      $getCreator = mysql_query("SELECT * FROM Users WHERE ID='".$gI->CreatorID."'");
      $gC = mysql_fetch_object($getCreator);
    
      echo "
      
      <td style='width:100px;height:200px;font-size:11px;width:1px !important;margin-right:30px;' valign='top'><a href='/UserItem.php?ID=".$gI->ID."' border='0' style='color:black;'>
        <div style='border: 1px solid #bbb;border-radius:5px;width:100px;height:200px;'>
          <!--<img src='/Store/Dir/".$gI->File."' width='100' height='200'>-->Item Renders Are WIP
        </div>
        <b>".$gI->Name."</b></a>
        <br />
        <font style='font-size:10px;'>Creator: <a href='/User.php?Profile=".$gC->Username."'>".$gC->Username."</a>
        <br />
        <font color='green'><b>ThinkBux: ".$gI->Price."</b></font>
      </td>
      
      ";
      
      if ($counter >= 6) {
      
        echo "</tr><tr>";
        
        $counter = 0;
      
      }
    
    }

    echo "</tr></table></td></tr></table><center>";
    $amount=ceil($num / $Setting["PerPage"]);
if ($Page > 1) {
echo '<a href="?Page='.($Page-1).'">Prev</a> - ';
}
echo ''.$Page.'/'.(ceil($num / $Setting["PerPage"]));
if ($Page < ($amount)) {
echo ' - <a href="?Page='.($Page+1).'">Next</a>';
}
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
?>