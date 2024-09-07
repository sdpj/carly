<?php
    session_start();
?>

<!-- index, initial landing page -->
<!-- saved from url=(0036)https://vidsurf.glitch.me/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Vidsurf - share your videos with the world!</title>
    <link rel="stylesheet" href="css/index.css?ts=<?=time()?>">
	<link rel="stylesheet" href="css/header.css?ts=<?=time()?>">
	<link rel="stylesheet" href="css/sidebar.css?ts=<?=time()?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="images/jquery.min.js.download"></script>
  </head>
  <body>
	<?php
		include("header.php");
		include("sidebar.php");
		
		include("db_credentials.php");
		
		$get_videos = "SELECT * FROM Videos";
		
		$result = $conn->query($get_videos);
	?>

    <main>
      <section class="featured-section">
        <div class="header_index">
          <h1>
            Featured videos
          </h1>
        </div>
		<table>
        <div class="content" >
		  <?php
		  if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			  $id = $row['video_id'];
			  $title = $row['video_name'];
			  $desc = $row['video_description'];
		      $upload_date = $row['date_uploaded'];
			  $uploader_id = $row['uploader'];
			  $thumbnail   = $row['thumbnail'];
			  //assigned to update the view count on the video...
			  $curr_view_count = $row['views'];
				
			  $date = date_create($upload_date);
			  
			  $get_uploader = "SELECT * FROM Users WHERE user_id=".$uploader_id;
			  $result2 = $conn->query($get_uploader);
			  if ($result2->num_rows === 1) {
				while($row = $result2->fetch_assoc()) {
				  $username = $row['username'];
				  $avatar = $row['avatar'];
				}
			  }  
				
			  echo '<div class="video-card" style="width: 175px; padding: 30px; vertical-align: top;">';
			    echo '<form method="GET" action="watch_video.php">';
				  echo '<div class="thumbnail">';
				    if ($thumbnail != '') {
					  echo '<input class="thumbnail" type="image" src="images/thumbnails/'.$thumbnail.'" />';
					}
					else {					
					  echo '<input class="thumbnail" type="image" src="images/image8-2-1024x576.png" />';
					}
				  echo '</div>';

				    echo '<h3><input type="text" name="id" value="'.$id.'" hidden />';
					echo '<a href="watch_video.php?id='.$id.'" style="width: 185px; word-wrap: normal;">'.$title.'</a></h3>';
				  	if ($avatar != '') {
					  echo '<img src="images/avatars/'.$avatar.'" style="width: 30px; float: right; 
					  position: relative; left: 20px; top: 5px;" />';
					}
					else {
					  echo '<img src="images/791224_man_512x512.png" style="width: 30px; float: right;
					  position: relative; left: 20px; top: 5px;" />';
					}
					echo '<p class="subtext">Added: '.date_format($date, "F j, Y").'</p>';
				  echo '<p class="subtext">From: '.$username.'</p>';
				  echo '<p class="subtext">Views: '.$curr_view_count.'</p>';
			   echo '</form>';
              echo '</div>';
			  
			  
		    }
		  }
		  ?>
        </div>

      </section>
    </main>
	
	<!-- sample php code -->
	<?php 

	?>
	
    <aside class="ads">
      
    </aside>
    <footer>
      
    </footer>

</body></html>
