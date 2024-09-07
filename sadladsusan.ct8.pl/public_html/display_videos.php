<?php
	session_start();
?>

<!-- index, initial landing page -->
<!-- saved from url=(0036)https://vidsurf.glitch.me/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Vidsurf - share your videos with the world!</title>
    <link rel="stylesheet" href="css/index.css?ts=<?=time()?>">
	<link rel="stylesheet" href="css/display_videos.css?ts=<?=time()?>">
	<link rel="stylesheet" href="css/header.css?ts=<?=time()?>">
	<link rel="stylesheet" href="css/sidebar.css?ts=<?=time()?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="images/jquery.min.js.download"></script>
  </head>
  <body>
	<?php
		include("header.php");
		include("sidebar.php");
	?>

    <main>
      <section class="featured-section">
        <div class="header_display_videos">
          <h1>
            Results for <?php 
			$search_query = $_GET["video_query"];
			$search_query_no_spaces = str_replace(" ", "", $search_query); //remove spaces for additional query
			echo $search_query;
			?>
          </h1>
        </div>
        <div class="content">
			<table>
			<?php
				if ($search_query == "") {
					header("location: index.php");
				}
				
		        include("db_credentials.php");
				
				$video_query = "SELECT * FROM Videos WHERE video_name LIKE '%$search_query%'
					OR video_tags LIKE '%$search_query_no_spaces%'";

				$result = $conn->query($video_query);

				if ($result->num_rows >= 1) {
					while($row = $result->fetch_assoc()) {
						echo 
						'<tr>
							<td class="video_cell">
							  <div class="video-card">
								<div class="thumbnail">';
								$thumbnail = $row["thumbnail"];
								if ($thumbnail != '') {
									echo '<img src="images/thumbnails/'.$thumbnail.'" style="width: 200px; height: 120px;">';
								}
								else {
									echo '<img src="images/image8-2-1024x576.png" style="width: 200px; height: 120px;">';
								}								  
								echo '</div>
							</td>
							<td class="video_cell">
								<h3 class="video_title">
								  <a href="watch_video.php?id='.$row["video_id"].'">'.$row["video_name"].'</a>
								</h3>
								<p class="video_desc">
									'.$row["video_description"].'
								 </p>
							  </div>
							</td>
						</tr>';
					}
				} 
				else {
					echo '<h3>No search results found</h3>';
				}
			?>
			</table>
        </div>
      </section>
    </main>

    <aside class="ads">
      
    </aside>
    <footer>
      
    </footer>

</body></html>
