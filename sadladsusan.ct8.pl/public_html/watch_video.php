<?php
  session_start();
?>

<!-- index, initial landing page -->
<!-- saved from url=(0036)https://vidsurf.glitch.me/index.html -->
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Vidsurf - share your videos with the world!</title>
  <link rel="stylesheet" href="css/watch.css?ts=<?=time()?>">
  <link rel="stylesheet" href="css/header.css?ts=<?=time()?>">
  <link rel="stylesheet" href="css/sidebar.css?ts=<?=time()?>">
  <link rel="stylesheet" href="css/buttons.css?ts=<?=time()?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  #popup {
    background-color: rgb(220, 220, 220);
    position: fixed;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 320px; height: 220px;
    display: none;
  }
  </style>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/subscriptions.js"></script>
  </head>
  <body>
  <?php
    include("header.php");
    include("sidebar.php");
    
    include("db_credentials.php");
    
    $videoId = $_GET['id'];
    $get_video = "SELECT * FROM Videos WHERE video_id='$videoId'";
    $result = $conn->query($get_video);
    
    if ($result->num_rows === 1) {
      while($row = $result->fetch_assoc()) {
        $location = $row['video_file'];
        $ext = $row['video_extension'];
        $title = $row['video_name'];
        $desc = $row['video_description'];
        $upload_date = $row['date_uploaded'];
        $uploader_id = $row['uploader'];
        //assigned to update the view count on the video...
        $curr_view_count = $row['views'];
      }
    }
    
    $update_view_count = "UPDATE Videos SET Views=".($curr_view_count+1)." WHERE video_id=".$videoId."";
    $update = $conn->query($update_view_count);  

    $get_uploader = "SELECT * FROM Users WHERE user_id='$uploader_id'";
    $result = $conn->query($get_uploader);
    
    if ($result->num_rows === 1) {
      while($row = $result->fetch_assoc()) {
        $uploader_name = $row['username'];
      }
    }
  ?>

    <main>
  <p id="demo"></p>
      <section class="featured-section">
        <div class="header_display_videos">
          <h1 class="title" id="title">
            <?php 
        if ($title != '') {
          echo $title;
        }
        else {
          echo "null";
        }
      ?>
          </h1>      
        </div>
    <!-- video/uploader info -->
    <div class="content">
    <?php 
      echo "<video class='vid' src='" . $location . "' controls width='100%' height='auto' type='video/" . $ext . "' >";        
      ?>;
    </div>  
    <div style="float: left; width: 50%;">
      <div>
        <div style="float: left; padding: 10px;" >Rate: *****</div>
        <div style="float: right; padding: 10px;" >Views: <?php echo ($curr_view_count+1); ?></div>
        <div style="clear: both;"></div>
      </div>
      <div>
        <p style="float: left; padding-left: 10px; padding-right: 10px;" class="video_paragraphs">From: <?php echo ($uploader_name); ?></p></td>
        <?php
          if ($_SESSION["userId"] != "") {
            //first, see if user is watching their own video...
            if ($_SESSION["userId"] == $uploader_id) {
              echo '<td><div style="float: right; padding-left: 10px; padding-right: 10px;">
                <button class="disabled_yellow_button" id="yellow" disabled>Subscribe</div></td>';
            }
            else {
              //see if the subscription already exists from user $sub_from to $sub_to
              $query_search_subscription = "SELECT * FROM Subscriptions WHERE subscriber_id=".$_SESSION["userId"]." AND subscribed_to_id=".$uploader_id;
              $result = $conn->query($query_search_subscription);

              if ($result->num_rows === 1) {
                echo '<td><div style="float: right; padding-left: 10px; padding-right: 10px;">
                  <button class="yellow_button" id="yellow" onclick="confirm_unsubscribe()">Subscribed</div></td>';
              }
              else {
                echo '<td><div style="float: right; padding-left: 10px; padding-right: 10px;">
                  <button class="yellow_button" id="yellow" onclick="subscribe('.$_SESSION["userId"].', '.$uploader_id.')">Subscribe</div></td>';
              }
            }
          }
        ?>
        <div style="clear: both;"></div>
      </div>
      <p class="video_paragraphs">Added: <?php echo ($upload_date); ?></p>
      <hr />
      <p class="video_paragraphs"><?php echo ($desc); ?></p>
      <br />
      <!-- comments section -->
      <?php
      if ($_SESSION["userId"] != "") {
        echo '<form id="submit_comment" action="post_comment.php" method="POST" onSubmit="window.location.reload()">';
          echo '<div>';
            echo '<textarea class="form-control" rows="6" cols="50" id="comment" name="comment_text"></textarea>';
            echo '<br />';
            echo '<div style="padding-left: 295px;">';
              echo '<input type="text" id="userid" name="userid" value="'.$_SESSION["userId"].'" hidden />';
              echo '<input type="text" id="videoid" name="videoid" value="'.$videoId.'" hidden />';
              echo '<input type="submit" id="submit" name="submit" value="Comment" />';
            echo '</div>';
          echo '</div>';
        echo '<form>';
          }
      ?>
      <script src="js/comments.js"></script>
      <br />
      <?php
      $get_comments = "SELECT * FROM Comments WHERE video='$videoId' ORDER BY comment_id DESC";
      $result = $conn->query($get_comments);

      echo $result->num_rows." Comments";
    
      if ($result->num_rows >= 0) {
        //fetch the data of the user who made each comment, also
        
        
        while($row = $result->fetch_assoc()) {
          $get_commentor_info = "SELECT * FROM Users WHERE user_id=".$row['commentor_id'];
          $result2 = $conn->query($get_commentor_info);
          
          if ($result2->num_rows === 1) {
            while($row2 = $result2->fetch_assoc()) {
              $commentor_name = $row2['username'];
              $avatar = $row2['avatar'];
            }
          }
          
          echo '<div class="comment" style="padding: 5px;">';
            if ($avatar != '')
              echo '<img src="images/avatars/'.$avatar.'" style="width: 30px;" />';
            else
              echo '<img src="images/791224_man_512x512.png" style="width: 30px;" />';
            echo '<b> '.$commentor_name.' </b> 3 seconds ago';
            echo '<p>'.$row['comment_text'].'</p>';
          echo '</div>';
        }
      }

      ?>
    </div>
    <!-- other, related videos -->
    <div style="float: left; width: 50%;">
    </div>
      </section>
  
  <!-- 'unsubscribe from?' popup -->
    <div id="popup">
    <h2 style="text-align: center; padding-top: 20px;">Unsubscribe from <?php echo ($uploader_name); ?>?</h2>
    <table style="padding-top: 50px; padding-left: 78px;"><tr>
    <td><button onclick="cancel()">Cancel</button></td>
    <td><button onclick="unsubscribe(
      <?php echo ($_SESSION["userId"]); ?>, 
      <?php echo ($uploader_id); ?>)
    ">Unsubscribe</button></td>
    </tr></table>
  </div>
  <!-- end popup -->
    </main>

    <aside class="ads">
      
    </aside>
    <footer>
      
    </footer>
  
</body></html>
