<?php
  include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
  $Setting = array(
    "PerPage" => 18
  );
  $Page = $_GET['Page'];
  if ($Page < 1) { $Page=1; }
  if (!is_numeric($Page)) { $Page=1; }
  $Minimum = ($Page - 1) * $Setting["PerPage"];
  //for
  $getall = mysql_query("SELECT * FROM Items");
  $all = mysql_num_rows($getall);
  //query
  $allusers = mysql_query("SELECT * FROM Items WHERE itemDeleted='0' ORDER BY ID DESC");
  $num = mysql_num_rows($allusers);
  $i = 0;
  $Num = ($Page+8);
  $a = 1;
  $Log = 0;
  $SearchQuery = SecurePost($_POST['SearchQuery']);
  $SearchSubmit = SecurePost($_POST['SearchSubmit']);
  $Sort = SecurePost($_GET['Sort']);
  $MinPrice = SecurePost($_GET['MinPrice']);
  $MaxPrice = SecurePost($_GET['MaxPrice']);
  $StoreEnabled = mysql_query("SELECT * FROM UserStore");
  $StoreOnlineOffline = mysql_fetch_object($StoreEnabled);
  if (!$SearchSubmit && !$MinPrice && !$MaxPrice) {
    $getItems = mysql_query("SELECT * FROM Items WHERE itemDeleted='0' ORDER BY UpdateTime DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
  }
  elseif ($SearchSubmit){
    $getItems = mysql_query("SELECT * FROM Items WHERE Name LIKE '%".$SearchQuery."%' AND itemDeleted='0' ORDER BY ID DESC");
  }
  if ($Sort){
    $getItems = mysql_query("SELECT * FROM Items WHERE Name LIKE '%".$SearchQuery."%' AND itemDeleted='0' AND Type='".$Sort."' ORDER BY ID DESC");
  }
  if($Sort == "Limiteds"){
    $getItems = mysql_query("SELECT * FROM Items WHERE Name LIKE '%".$SearchQuery."%' AND itemDeleted='0' AND saletype='limited' ORDER BY ID DESC");
  }
  if($MinPrice && $MaxPrice){
    if(is_numeric($MinPrice) && is_numeric($MaxPrice)){
    
    }
    else{
      echo"
      <script>
        alert('Your minimum and max prices must be numbers only');
      </script>
      "; 
      return false;
    }
    if($MinPrice < $MaxPrice){
    
    }
    else{
      echo"
      <script>
        alert('Your max price must be greater than your minimum');
      </script>
      "; 
      return false;
    }
    if($pricemin >= 0 && $pricemax >= 0){
    
    }
    else{
      echo"
      <script>
        alert('Your minimum and max prices must be greater than or equal to 0');
      </script>
      ";
      return false;
    }
    $getItems = mysql_query("SELECT * FROM Items WHERE itemDeleted='0' AND saletype!='limited' AND Price>=$MinPrice AND Price<=$MaxPrice ORDER BY ID DESC");
  }
  $counter = 0;
  $total_counter = 0;
  
  if(mysql_num_rows($getItems) < 1){
    $SortStatus = "
    <center>
      I couldn't find any items relating to that. Try another category!
    </center>
    ";
  }
  else{
    $SortStatus = "
    
    ";
  }
?>
  <div class='catalog-page'>
    <h1 style='float:left;'>Catalog</h1>
    <div style='float:right;'>
      <form action='' method='POST' style='padding-top:30px;'>
        <input type='text' name='SearchQuery' style='width:300px;padding:7px;'>
        &nbsp;
        <input type='submit' name='SearchSubmit' style='padding:5px;font-size:15px;' class='btn-primary'>
      </form>
    </div>
    <br style='clear:both;'>
    <div class='divider-right' style='width:175px;float:left;'>
      <div class='divider-bottom' style='position: relative;z-index:3;'>
        <div class='legend-menu'>
          <div align='center'><div style='border-left:1px solid #ccc;color:#363636;background:lightgrey;padding:5px;'>
            <strong>Browse Categories</strong>
          </div></div>
          <div style='border-left:1px solid #ccc;background:#efefef;padding:5px;'>
            <h2 style='font-size:16px;margin:0;padding:0;margin-top:5px;margin-bottom:5px;'>
              Sort Items
            </h2>
            <a href='?all'>All Items</a>
            <br />
            <a href='?Sort=Hat'>Hats</a>
            <br />
            <a href='?Sort=Eyes'>Eyes</a>
            <br />
            <a href='?Sort=Bottom'>Pants</a>
            <br />
            <a href='?Sort=Top'>Shirts</a>
            <br />
            <a href='?Sort=Hair'>Hair</a>
            <br />
            <a href='?Sort=Shoes'>Shoes</a>
            <br />
            <a href='?Sort=Mouth'>Mouths</a>
            <br />
            <a href='?Sort=Accessory'>Gear</a>
            <h2 style='font-size:16px;margin:0;padding:0;margin-top:5px;margin-bottom:5px;'>
              Price Range
            </h2>
            <form action='' method='GET'>
              <table> 
                <tr>
                  <td>
                    <font class='Bux'>
                      Min B$: 
                    </font>
                  </td>
                  <td>
                    <input type='text' name='MinPrice' style='width:110px;'>
                  </td>
                </tr>
                <tr>
                  <td>
                    <font class='Bux'>
                      Max B$: 
                    </font>
                  </td>
                  <td>
                    <input type='text' name='MaxPrice' style='width:110px;'>
                  </td>
                </tr>
              </table>
            </form>
          </div>
        </div>
      </div>
      <div class='divider-bottom' style='position: relative;z-index:3;'>
        <div class='catalog-legend-sub' style='margin-top:10px;font-size:11px;padding:5px;'>
          <h2 style='font-size:16px;margin:0;padding:0;margin-top:5px;margin-bottom:5px;'>
            Item Types
          </h2>
          <b style='font-size:12px;'>Limited Item</b>
          <br />
          A limited supply originally sold by World2Create. Each unit is labeled with a serial number. Once sold out, owners can re-sell them to other users.
          <div style='padding-top:10px;'></div>
          <b style='font-size:12px;'>Premium Only Item</b>
          <br />
          An item that is only available to members with a Premium Membership with World2Create.
        </div>
      </div>
    </div>
    <div style='float:left;width:80%;margin-left:10px;'>
      <?php
        echo"
      <h1 style='margin:0;padding:0;font-weight:normal;'>
        Featured Items on World2Create
        <div style='float:right;'>
          <a href='http://rega-gaming.mlUpgrades/Bux.aspx' class='btn-primary'>
            Buy BUX
          </a>";
          if($myU->PowerArtist == "true") { echo "
          <a href='StoreUpload.aspx' class='btn-primary'>
            Upload Item
          </a>"; }
          echo"
        </div>
      </h1>
      <br style='clear:both;'>
      ".$SortStatus."
      <table cellpadding='3' cellspacing='3' style='padding-left:10px;'>
        <tr>
      ";
          while($gI = mysql_fetch_object($getItems)){
            $gIName = $gI->Name;
            if(strlen($gIName) > 11)  $gIName = substr($gIName, 0, 11).'...';
            $counter++;
            $total_counter++;
            $getCreator = mysql_query("SELECT * FROM Users WHERE ID='".$gI->CreatorID."'");
            $gC = mysql_fetch_object($getCreator);
            echo"
            <td style='width:105px;max-width:105px;'>
            ";
            if ($gI->saletype == "limited") {
              echo"
              <a href='http://rega-gaming.mlStore/Item.aspx?ID=".$gI->ID."'>
                <div style='width:100px;border:1px solid #ccc;padding:3px;'>
                  <div style='width: 100px; height: 200px; z-index: 3;  background-image: url(http://gamelabs.social-verse.ml/Store/Dir/Avatar.png);'>
                  <div style='width: 100px; height: 200px; z-index: 3;  background-image: url(http://gamelabs.social-verse.ml/Store/Dir/".$gI->File.");'>
                  <div style='width: 100px; height: 200px; z-index: 3;  background-image: url(/Imagess/LimitedWatermark.png);'>
                  </div></div></div>
                </div>
              </a>
              ";
            }
            else{
              echo"
              <a href='http://rega-gaming.mlStore/Item.aspx?ID=".$gI->ID."'>
                <div style='width:100px;border:1px solid #ccc;padding:3px;'>
                  <div style='width: 100px; height: 200px; z-index: 3;  background-image: url(http://gamelabs.social-verse.ml/Store/Dir/Avatar.png);'>
                  <div style='width: 100px; height: 200px; z-index: 3;  background-image: url(http://gamelabs.social-verse.ml/Store/Dir/".$gI->File.");'>
                  </div></div>
                </div>
              </a>
              ";
            }
            echo"
            <div style='margin-top:3px;height:auto;width:100px;border:1px solid #ccc;padding:3px;'>
              <a href='http://rega-gaming.mlStore/Item.aspx?ID=".$gI->ID."' title='".$gI->Name."'>
                <b style='font-size:13px;'>".$gIName."</b>
              </a>
              <br />
              <font style='color:gray;font-size:11px;'>
                <b>By:</b>
                <a href='http://rega-gaming.mluser.aspx?ID=".$gC->ID."' style='font-size:11px;'>
                  ".$gC->Username."
                </a>
              </font>
              <br />
              ";
              if($StoreOnlineOffline){
                echo"
                <div class='Bux' style='font-size:11px;color:red;'>
                  Purchasing Offline
                </div>
                ";
              }
              elseif ($gI->sell == "yes"){
                if ($gI->saletype == "limited" && $gI->numberstock == "0"){
                  echo"
                  <div class='Bux' style='font-size:11px;'>
                    Was B$: ".$gI->Price."
                  </div>
                  ";
                }
                else{
                  echo "
                  <div class='Bux' style='font-size:11px;'>
                    B$: ".$gI->Price."
                  </div>
                  ";
                }
              }
              else{
                  echo "
                  <div class='Bux' style='font-size:11px;color:red;'>
                    Off-Sale
                  </div>
                  ";
              }
            echo"
            </div>
            ";
            echo"
            </td>
            ";
            if ($counter >= 6){
              echo"
              </tr><tr>
              ";
              $counter = 0;
            }
          }?>
        </tr>
        <tr>
          <td>
            <?php
            echo"
            <br />
            ";
            if (!$Sort) {
              $amount=ceil($num / $Setting["PerPage"]);
              if ($Page > 1){
                echo'
                <a href="?Page='.($Page-1).'">
                  Prev
                </a> 
                - 
                ';
              }
              echo'Page '.$Page.'/'.(ceil($num / $Setting["PerPage"]));
              if ($Page < ($amount)){
                echo' 
                - 
                <a href="?Page='.($Page+1).'">
                  Next
                </a>
                ';
              }
            }?>
          </td>
        </tr>
      </table>
    </div>
    <br style='clear:both;'>
  </div>
<?php
  include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>