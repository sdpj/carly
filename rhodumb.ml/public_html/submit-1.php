<?php include_once ($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php');
    //Including the database connecting
    //include_once 'settings.php';
?>
<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $sitename; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <?php
        // Checking connection
        if ($conn == false) {
            //If the connection fails then it sends out an error code.
            echo "Connection Failed: " . mysqli_connect_error();
            exit();
        }

        //If the connection not failed, then we are making a sql string
        $sql = "SELECT * FROM comments";

        //Then we are sending the sql string to the database
        $result = mysqli_query($conn, $sql);

        //After we sent it, we will count the rows there matches with the sql string
        $count = mysqli_num_rows($result);

        //Checking if there is more then 0 rows
        if ($count > 0) {
            //Outputting the rows one by one
            while($row = mysqli_fetch_array($result)) {
                echo '<div class="row">
                  
                  
                  <div class="col s12 m5">
     <div class="card card-item">
       <div class="card-image waves-effect waves-block waves-light">
         <a href="level?id=27822"><img src="http://via.placeholder.com/600x480?text=Placeholder"></a>
       </div>
       <div class="card-content">
         <a href="level?id=27822" class="card-title truncate">'.$row['Comment'] .'</a>
         <span>By <a href="profile?user=carl3">' . $row['Name'] . '</a></span><span class="right">' . $row['Date'] . '</span>
       </div>
       <div class="card-reveal">
         <span class="card-title truncate truncate-mini">
           <a href="level?id=27822">'.$row['Comment'] .'</a>
             <i class="material-icons right">close</i>
         </span>
         <p>By <a href="profile?user=carl3">' . $row['Name'] . '</a></p>
         <p></p>
       </div>
     </div>
   </div>
                  
                  
                  ';




            }
            echo "</table>";
        } else {
            //If there is no rows, we will print out that there is no rows.
            echo '<center>' . "0 results, No comments has been created." . '</center>';
            echo '<br>';
            echo '<br>';
        }
        //Then we close the connection
        mysqli_close($conn);
    ?>
 
</body>
</html>
