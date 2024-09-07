<?php
	session_start();
?>

<!-- index, initial landing page -->
<!-- saved from url=(0036)https://vidsurf.glitch.me/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My channel</title>
    <link rel="stylesheet" href="css/channel.css?ts=<?=time()?>">
	<link rel="stylesheet" href="css/header.css?ts=<?=time()?>">
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
	#popup_edit_avatar {
		background-color: rgb(220, 220, 220);
		position: fixed;
		top: 50%; left: 50%;
		transform: translate(-50%, -50%);
		width: 480px; height: 360px;
		display: none;
	}
	</style>
    <script src="jquery.min.js.download"></script>
	<script src="js/subscriptions.js"></script>
	<script src="js/edit_channel.js"></script>
	
  </head>
		<?php
		    include("db_credentials.php");
			error_reporting(0);
		
			$userId = $_GET['user'];

            if (isset($_POST['update_avatar'])) {
				//upload the file to the server:
				$avatarPath = $_FILES["user_avatar"]["name"];
				$avatarPathParts = pathinfo($avatarPath);

				$avatar_dir = "images/avatars/";
				$target_avatar_file = $avatar_dir . basename($_FILES["user_avatar"]["name"]);
				$upload_ok = 1;

				$check = getimagesize($_FILES["user_avatar"]["tmp_name"]);
				if($check !== false) {
					$upload_ok = 1;
				} 
				else {
					$upload_ok = 0;
				}
				
				if ($upload_ok != 0) {
					if (move_uploaded_file($_FILES["user_avatar"]["tmp_name"], $target_avatar_file)) {
						/*echo "The avatar ". basename( $_FILES["user_avatar"]["name"]). " has been uploaded.";*/
					} 
				}
				
				$update_avatar = "UPDATE Users SET avatar='". basename( $_FILES["user_avatar"]["name"]). "' WHERE user_id=".$_SESSION["userId"];
				$update = $conn->query($update_avatar);
			}

			$get_user_info = "SELECT * FROM Users WHERE user_id='$userId'";
			$result = $conn->query($get_user_info);

			if ($result->num_rows === 1) {
				while($row = $result->fetch_assoc()) {
					$channel_user = $row['username'];
					$channel_email = $row['email'];
					$join_date = $row['join_date'];
					$avatar = $row['avatar'];
				}
			}

			$get_channel = "SELECT * FROM Channels WHERE channel_id='$userId'";
			$result = $conn->query($get_channel);		

			if ($result->num_rows === 1) {
				while($row = $result->fetch_assoc()) {
					$channel_description = $row['channel_description'];
					$featured_video = $row['featured_video'];
					$background_image = $row['background_image'];
					$bg_col_r = $row['bg_col_r'];
					$bg_col_g = $row['bg_col_g'];
					$bg_col_b = $row['bg_col_b'];
					$bg_col_a = $row['bg_col_a'];
					$text_col_r = $row['text_col_r'];
					$text_col_g = $row['text_col_g'];
					$text_col_b = $row['text_col_b'];
				}
			}

			if ($featured_video != NULL) {
				$get_featured_video = "SELECT * FROM Videos WHERE video_id=$featured_video";
				$result = $conn->query($get_featured_video);

				if ($result->num_rows === 1) {
					while($row = $result->fetch_assoc()) {
						$featured_video_id = $row['video_id'];
						$featured_video_name = $row['video_name'];
						$featured_video_file = $row['video_file'];
						//assigned to update the view count on the video...
						$curr_view_count = $row['views'];
					}
				}

				$update_view_count = "UPDATE Videos SET Views=".($curr_view_count+1)." WHERE video_id=".$featured_video_id."";
				$update = $conn->query($update_view_count);	
			}
			else {
				
			}
			
			$lifetime_views = 0;
			$get_all_videos = "SELECT * FROM Videos WHERE uploader=".$userId."";
			$result = $conn->query($get_all_videos);
			$total_videos = $result->num_rows;

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$lifetime_views += $row['views'];
				}
			}
		?>		
	<style>
		body {
			background-image: url("images/channels/bgs/<?php echo $background_image ?>"); /* customizable */
			background-repeat: no-repeat; /* fixed */
			background-size: cover; /* fixed */
			background-attachment: fixed; /* fixed */
		}
		div.content {
			background-color: rgba(<?php echo $bg_col_r.", ".$bg_col_g.", ".$bg_col_b.", ".($bg_col_a / 100.0) ?>);
		}
		div.small, div.bold_name, p.channel_desc {
			color: rgb(<?php echo $text_col_r.", ".$text_col_g.", ".$text_col_b ?>);
		}	
	</style>
	<?php
	
	?>
	
  <body>
	<?php
		include("header.php");	
	?>
	<aside class="sidebar"></aside>
	<!-- customizable attributes of the channel layout go here -->
    <main>
		<div class="content" style=
			"margin: auto; 
			width: 100%; 
			height: 1000px;">
			<div class="banner" style="width: 100%; height: auto;">
			</div>
			<div style="float: left; width: 30%">
				<div>
					<table><tr>					
						<?php
						if ($avatar != '') {
							echo '<td><img id="avatar" src="images/avatars/'.$avatar.'" style="width: 100px;"/></td>';
						}
						else {
							echo '<td><img id="avatar" src="images/791224_man_512x512.png" style="width: 100px;"/></td>';
						}						
						
							$uploader_id = $_GET['user'];
						
							if ($_SESSION["userId"] != "") {
								//first, see if user is watching their own video...
								if ($_SESSION["userId"] == $_GET['user']) {
									echo '<td><div style="float: right; padding-left: 75px;">
										<button class="disabled_yellow_button" id="yellow" disabled>Subscribe</div></td>';
								}
								else {
									//see if the subscription already exists from user $sub_from to $sub_to
									$query_search_subscription = "SELECT * FROM Subscriptions WHERE subscriber_id=".$_SESSION["userId"]." AND subscribed_to_id=".$_GET['user'];
									$result = $conn->query($query_search_subscription);

									if ($result->num_rows === 1) {
										echo '<td><div style="float: right; padding-left: 75px;">
											<button class="yellow_button" id="yellow" onclick="confirm_unsubscribe()">Subscribed</div></td>';
									}
									else {
										echo '<td><div style="float: right; padding-left: 75px;">
											<button class="yellow_button" id="yellow" onclick="subscribe('.$_SESSION["userId"].', '.$_GET['user'].')">Subscribe</div></td>';
									}
								}
							}
						?>
					</tr></table>	
					<br />
					<div class="bold_name"><?php echo $channel_user; ?></div>
					<div class="small">Join date: May 5th, 2020</div>
					<div class="small">Last seen: 2 days ago</div>
					<div class="small">Subscribers: 0</div>
					<div class="small">Views: <?php echo ($lifetime_views); ?></div>
					<div class="small">Videos: <?php echo ($total_videos); ?></div>
					<br />
					<p class="channel_desc"><?php echo ($channel_description); ?></p>
					<br />
					<div class="small">Country: Chad</div>
					<div class="small">Website: https://www.smwcentral.net/?p=profile&id=18536</div>
					<br />
					<hr />
					<br />
					<button style=
						"font-size: 16px; 
						font-weight: bold;"
						onclick="show_avatar_popup()">Change your avatar</button>
					<br />
					<br />
					<button style=
						"font-size: 16px; 
						font-weight: bold;"
						onclick="show_channel_popup()">Customize your channel</button>
				</div>
			</div>
			<div style="float: left; width: 70%;">
				
				<div style="padding: 1rem;">
					<?php
						if ($featured_video != "") {
							echo "<video class='vid' src='videos/uploaded/$featured_video_file' controls width='100%' height='auto'>";
						}
						else {
							echo "<img src='images/no_featured_video.png'>";
						}
					?>
				</div>
				<div class="bold_name"><a href="watch_video.php?id=<?php echo ($featured_video); ?>" 
					class="feat_video_link"><?php echo ($featured_video_name); ?></a></div>
				<a class="edit_featured_video" href="channel_edit.php" style="float: right;">Edit featured video</a>
				<div class="small">From: <?php echo $channel_user; ?></div>
				<div class="small">Views: <?php echo ($curr_view_count+1); ?></div>
				<div class="small">Comments: 0</div>
				
				<br />
				<div class="bold_name">All Videos (<?php echo ($total_videos); ?>)</div>
				<div class="videos_container" style="overflow-x: scroll;">
					<table><tr>					
						<td class="all_videos"><div class="a_video">
							<form method='GET' action="watch_video.php">
								<div class="thumbnail">
								  <input class="thumbnail" type="image" src="images/image8-2-1024x576.png" />
								</div>
								<br>
							 </form>
							 <h3 class="h">
								<a href="watch_video.php?id=<?php echo ($featured_video); ?>" class="video_link">Video 1</a>
							 </h3>
						</div></td>
						<td class="all_videos"><div class="a_video">
							<form method='GET' action="watch_video.php">
								<div class="thumbnail">
								  <input class="thumbnail" type="image" src="images/image8-2-1024x576.png" />
								</div>
								<br>
							 </form>
							 <h3 class="h">	
								<a href="watch_video.php?id=1" class="video_link">The video that has a decently long title for the sake of testing the site's CSS</a>
							 </h3>
						</div></td>
						<td class="all_videos"><div class="a_video">
							<form method='GET' action="watch_video.php">
								<div class="thumbnail">
								  <input class="thumbnail" type="image" src="images/image8-2-1024x576.png" />
								</div>
								<br>
							 </form>
							 <h3 class="h">
								<a href="watch_video.php?id=1" class="video_link">Video 2</a>
							 </h3>
						</div></td>
						<td class="all_videos"><div class="a_video">
							<form method='GET' action="watch_video.php">
								<div class="thumbnail">
								  <input class="thumbnail" type="image" src="images/image8-2-1024x576.png" />
								</div>
								<br>
							 </form>
							 <h3 class="h">
								<a href="watch_video.php?id=1" class="video_link">Video 3</a>
							 </h3>
						</div></td>
						<td class="all_videos"><div class="a_video">
							<form method='GET' action="watch_video.php">
								<div class="thumbnail">
								  <input class="thumbnail" type="image" src="images/image8-2-1024x576.png" />
								</div>
								<br>
							 </form>
							 <h3 class="h">
								<a href="watch_video.php?id=1" class="video_link">Video 4</a>
							 </h3>
						</div></td>
						<td class="all_videos"><div class="a_video">
							<form method='GET' action="watch_video.php">
								<div class="thumbnail">
								  <input class="thumbnail" type="image" src="images/image8-2-1024x576.png" />
								</div>
								<br>
							 </form>
							 <h3 class="h">
								<a href="watch_video.php?id=1" class="video_link">Video 5</a>
							 </h3>
						</div></td>
					</tr></table>
				</div>
			</div>
		</div>	
		
	<!-- 'unsubscribe from?' popup -->
    <div id="popup">
		<h2 style="text-align: center; padding-top: 20px;">Unsubscribe from <?php echo ($channel_user); ?>?</h2>
		<table style="padding-top: 50px; padding-left: 78px;"><tr>
		<td><button onclick="cancel()">Cancel</button></td>
		<td><button onclick="unsubscribe(
			<?php echo ($_SESSION["userId"]); ?>, 
			<?php echo ($_GET['user']); ?>)
		">Unsubscribe</button></td>
		</tr></table>
	</div>
	<!-- end popup -->
	<!-- 'edit channel' popup -->
    <div id="popup_edit_avatar">
		<form method="POST" enctype="multipart/form-data">
			<input name="user" value="<?php echo ($_SESSION["userId"]); ?>" hidden />
			<h2 style="text-align: center; padding-top: 20px; padding-bottom: 20px;">Change your avatar</h2>
			<tr>
				<td><label><strong style="padding: 5px;">Avatar</strong></label></td>
			</tr>		
			<tr>
				<td><input id="avatar_input" class="form-control" type="file" name="user_avatar" accept="image/*" /></td>					
			</tr>
			<tr>
				<td><p style="padding: 5px; font-size: 12px; font-style: italic;">Avatars should have a 1:1 aspect ratio,
				as any and all avatars uploaded to Vidsurf will be stretched to fit a 1:1 ratio and some 
				avatars may end up looking awkward as a result.</p></td>
			</tr>
			<table style="padding-top: 50px; padding-left: 30px;"><tr>
			<td><button onclick="cancel()">Cancel</button></td>
			<td><input type="submit" name="update_avatar" value="Update avatar" /></td>
			</tr></table>
		</form>
	</div>
	<!-- end popup -->	
    </main>
	<aside class="sidebar"></aside>

    <footer>
      
    </footer>

</body></html>
