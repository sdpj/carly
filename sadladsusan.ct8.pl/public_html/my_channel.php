<!-- index, initial landing page -->
<!-- saved from url=(0036)https://vidsurf.glitch.me/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My channel</title>
    <link rel="stylesheet" href="css/my_channel.css?ts=<?=time()?>">
  <link rel="stylesheet" href="css/header.css?ts=<?=time()?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="images/jquery.min.js.download"></script>
  </head>
    <style>
    body {
      background-image: url("images/channels/bgs/sample_channel_background.png"); /* customizable */
      background-repeat: no-repeat; /* fixed */
      background-size: cover; /* fixed */
      background-attachment: fixed; /* fixed */
    }
    div.content {
      background-color: rgba(220, 220, 220, 1.0);
    }
    div.small, div.bold_name, p.channel_desc {
      color: rgb(0, 0, 0);
    }  
  </style>
  <body>
  <?php
    include("header.php");
    
    include("db_credentials.php");
    
    $videoId = $_GET['id'];
    $get_video = "SELECT * FROM Users WHERE username='".$_SESSION['userName']."'";
    $result = $conn->query($get_video);
    
    if ($result->num_rows === 1) {
      while($row = $result->fetch_assoc()) {
        
        if(!$row['avatar']){
          $avatar = "791224_man_512x512.png";
          }
        else
        {
          $avatar = 'avatars/'.$row['avatar'];
        }
    
      }
    }
    
    //if not signed in, then can't look at your channel
    /*if ($_SESSION['userName'] == null) {
      header("location: index.php");
    }*/    
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
          <img src="images/<?=$avatar;?>" style="width: 100px;"/>
          <br />
          <div class="bold_name"><?php echo $_SESSION['userName']; ?></div>
          <div class="small">Join date: May 5th, 2020</div>
          <div class="small">Last seen: 2 days ago</div>
          <div class="small">Subscribers: 0</div>
          <div class="small">Views: 0</div>
          <div class="small">Videos: 0</div>
          <br />
          <p class="channel_desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
          In vehicula lobortis quam, eget feugiat leo vehicula nec. 
          Fusce porttitor mauris in lorem tempor blandit. 
          Aliquam eu ligula at tellus accumsan tincidunt at eget lorem. 
          Morbi nec tellus scelerisque, iaculis urna ac, elementum quam. 
          Praesent quis eros quis neque ornare viverra in at justo. 
          Nulla maximus felis nec nisl tincidunt, vel volutpat risus efficitur. 
          In hac habitasse platea dictumst. Curabitur vitae lorem elit. 
          Mauris tortor ligula, lacinia id scelerisque eu, aliquet quis justo. 
          Nunc accumsan vitae risus sed lobortis. 
          Phasellus at libero vel arcu pharetra consectetur id sed lacus.</p>
          <br />
          <div class="small">Country: Chad</div>
          <div class="small">Website: https://www.smwcentral.net/?p=profile&id=18536</div>
        </div>
      </div>
      <div style="float: left; width: 70%;">
        <div style="padding: 1rem;">
          <video class='vid' src='ddlc_quick ending_12.94' controls width='100%' height='auto'>
        </div>
        <div class="bold_name">Featured video</div>
        <div class="small">From: <?php echo $_SESSION['userName']; ?></div>
        <div class="small">Views: 0</div>
        <div class="small">Comments: 0</div>
        <br />
        <div class="bold_name">All Videos (0)</div>
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
                <a href="watch_video.php?id=1" class="video_link">Video 1</a>
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
    </main>
  <aside class="sidebar"></aside>
  
  <!-- sample php code -->
  <?php 

  ?>

    <footer>
      
    </footer>

</body></html>
