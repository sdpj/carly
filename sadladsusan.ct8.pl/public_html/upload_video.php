<?php
	session_start();
?>

<!-- login page -->
<!-- based off: https://vidsurf.glitch.me/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Vidsurf - upload videos</title>
    <link rel="stylesheet" href="css/upload_video.css?ts=<?=time()?>">
	<link rel="stylesheet" href="css/header.css?ts=<?=time()?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="images/jquery.min.js.download"></script>
  </head>
  <body>

	<?php
		include("header.php");
		
		if(isset($_POST['upload_video'])) {
		    include("db_credentials.php");

			$videoName = $_POST['videoTitle'];			
			$videoDescription = $_POST['videoDescription'];	
			$videoTags = $_POST['videoTags'];
			
			$videoName = addslashes($videoName);
			$videoDescription = addslashes($videoDescription);
			$videoTags = addslashes($videoTags);
			
			$videoTags = str_replace(",", ":", $videoTags); //replace commas w/ colons for storing in database
			$videoTags = str_replace(" ", "", $videoTags); //remove spacing

			$filePath = $_FILES["videoFile"]["name"];
			$pathParts = pathinfo($filePath);
			
			$fileName = $pathParts["filename"];
			$videoExt = $pathParts["extension"];

			$category = $_POST['category'];

			$userId = $_SESSION['userId'];			
			
			//upload the thumbnail, if one was supplied
			$thumbnailPath = $_FILES["videoThumbnail"]["name"];
			$thumbPathParts = pathinfo($thumbnailPath);
			echo ($thumbnailPath);
			
			$thumbnails_dir = "images/thumbnails/";
			$target_thumb_file = $thumbnails_dir . basename($_FILES["videoThumbnail"]["name"]);
			$upload_ok = 1;
			  
			$check = getimagesize($_FILES["videoThumbnail"]["tmp_name"]);
			if($check !== false) {
				$upload_ok = 1;
			} 
			else {
				$upload_ok = 0;
			}
			
			if ($upload_ok != 0) {
				if (move_uploaded_file($_FILES["videoThumbnail"]["tmp_name"], $target_thumb_file)) {
					echo "The thumbnail file ". basename( $_FILES["videoThumbnail"]["name"]). " has been uploaded.";
				} 
			}
			
			//else, take 1st frame of uploaded video and use that as thumbnail
			
			$query_existing_videos = "SELECT * FROM Videos";
			$result = $conn->query($query_existing_videos);
			
			$all_video_ids = array();

			$latest_id = 0;			
			$query_latest_video = "SELECT * FROM Videos ORDER BY video_id DESC LIMIT 1";
			$result = $conn->query($query_latest_video);
			if ($result->num_rows === 1) {
				while($row = $result->fetch_assoc()) {
					$latest_id = $row['video_id'];
				}
			}
			
			echo ('<br />');
			
			// videos...
			$target_dir = "videos/uploaded/";
			$videoFile = $target_dir . $fileName;
			
			if(move_uploaded_file($_FILES['videoFile']['tmp_name'], $videoFile)) {
				// add the video to DB
				$query_add_video = "INSERT INTO Videos (video_id, video_name, video_description, video_tags, views, file_name, 
					video_extension, video_file, date_uploaded, uploader, category, thumbnail)
					VALUES (".($latest_id+1).", '$videoName', '$videoDescription', '$videoTags', 0, '$fileName', 
					'$videoExt', '$videoFile', '2020-05-01', '$userId', '$category', '$thumbnailPath' )";

				if ($conn->query($query_add_video) === TRUE) {
					echo "Video successfully uploaded.";
				} else {
					echo "Error uploading video.";
				}
			}
			
			//require("index.php");
		}
	?>

	<div class="top"></div>

	<div class="uploadWindow">
		<div class="leftSide">
			<div class="heading">
				<b>Upload Video</b>
			</div>
			
			<form class="form-upload" method='POST' enctype="multipart/form-data">
				<div class="uploader">
					<table>
					<tr>
						<td><label><strong>Video file to upload</strong></label></td>
					</tr>
					<tr>
						<td><input class="form-control" type="file" name="videoFile" accept="video/*" required/></td>
					</tr>					
					<tr>
						<td><label><strong>Title</strong></label></td>
					</tr>
					<tr>
						<td><input class="form-control" type="text" name="videoTitle" required/></td>
					</tr>
					<tr>
						<td><label><strong>Description</strong></label></td>
					</tr>
					<tr>
						<td><textarea class="form-control" rows="6" cols="50" name="videoDescription"></textarea></td>						
					</tr>
					<tr>
						<td><label><strong>Category</strong></label></td>
					</tr>
					<tr>
						<td>
						<select class="form-control" name="category">
							<option value="">- select a category -</option>
							<option value="Howto & Style">Howto & Style</option>
							<option value="Pets & Animals">Pets & Animals</option>
							<option value="Travel">Travel</option>
							<option value="Education">Education</option>
							<option value="Nonprofits & Activism">Nonprofits & Activism</option>
							<option value="Entertainment">Entertainment</option>
							<option value="Film">Film</option>
							<option value="Comedy">Comedy</option>
							<option value="Science">Science</option>
							<option value="News">News</option>
							<option value="Music">Music</option>
							<option value="Gaming">Gaming</option>
							<option value="Autos & Vehicles">Autos & Vehicles</option>
							<option value="Technology">Technology</option>
							<option value="Sports">Sports</option>
						</select>
						</td>
					</tr>
					<tr>
						<td><label><strong>Tags</strong></label></td>
					</tr>
					<tr>
						<td><textarea class="form-control" rows="6" cols="50" name="videoTags" placeholder=
						"Write your tags as a comma-separated list; e.g. keyboard, cat, video, original"></textarea></td>						
					</tr>
					<tr>
						<td><label><strong>Thumbnail</strong></label></td>
					</tr>
					<tr>
						<td><input class="form-control" type="file" name="videoThumbnail" accept="image/*" /></td>					
					</tr>
					<tr>
						<td><p style="font-size: 12px; font-style: italic;">Thumbnails should have a 16:9 aspect ratio,
						as any and all thumbnails uploaded to Vidsurf will be stretched to fit a 16:9 ratio and some 
						thumbnails may end up looking awkward as a result.</p></td>
					</tr>
					</table>
				</div>
				<br />
				<input type="submit" name="upload_video" value="Upload" />
			</form>
		</div>
		<div class="rightSide">
			<div class="heading">
				<b>About uploading</b>
			</div>
			This is the page where you upload videos to Vidsurf.
			</form>
		</div>
	</div>

    <aside class="ads">
      
    </aside>
    <footer>
      
    </footer>

</body>
</html>
