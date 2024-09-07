<?php
include('Header.php');
        if (isset($_GET['accept'])){
          $id = $_GET['accept'];
          mysql_query("UPDATE `shop` SET `accepted`='1' WHERE `id`='$id'");
                                        
        }
        if (isset($_GET['decline'])){
          $id = $_GET['decline'];
          mysql_query("DELETE FROM `shop` WHERE `id`='$id'");
          mysql_query("DELETE FROM `inventory` WHERE `itemid`='$id'");
        }
        $q = mysql_query("SELECT * FROM `shop` WHERE `accepted`='0' ORDER BY id");
        $qq = mysql_num_rows($q);
        $c = 0;
        ?>
                <center><h1 style="color: red;">Among US sussy</h1></center><br>
                <table><tr>
                <?php
        for ($count = 1; $count <= $qq; $count ++){
          $qr = mysql_fetch_array($q);
          $c ++;
          $ui = $qr['creatorid'];
          $uiar = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$ui'"));
          ?>
                    <td style="border: 1px solid black; border-radius: 5px; background-color: #D5D5D5; color: black; text-align: center;">
                    <img src="/assets/Avatars/<?php print_r($qr['path']); ?>"><br>
                    Name: <h3><?php print_r(htmlspecialchars($qr['Name'])); ?><br>
                    Uploader is premium: <?php if ($uiar['Membership'] == '0'){ ?>No!<?php }else{ ?>Yes!<?php } ?><br />
                    Uploader is artist: <?php if ($uiar['powerArtist'] == '0'){ ?>No!<?php }else{ ?>Yes!<?php } ?><br />
                    Uploader: <?php print_r($uiar['Username']); ?><br />
                    Description:<br>
                    <textarea disabled style="color: black; background-color: #D5D5D5; border: none;"><?php print_r($qr['Description']); ?></textarea><br>
                    <a href="?pend=items&accept=<?php print_r($qr['id']); ?>">Accept</a> | <a href="?pend=items&decline=<?php print_r($qr['id']); ?>">Decline</a>
                    </td>
                    <?php
          if ($c == 10){
            $c = 0;
            echo '</tr><tr>';
          }
        }