<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php');
if(isset($_GET['id'])){
    $file_id = $_GET['id'];
    $file_path = 'files/'.$file_id;
    if(file_exists($file_path)){
        $file_data = file_get_contents($file_path);
        $file_data = htmlspecialchars($file_data);
    } else {
        http_response_code(404);
        $file_data = "Error 404 \nFile not found.";
    }
} else {
    header('Location: /');
}
?>
<html>
    <head>
        <title>View mode - file #<?php echo $file_id; ?></title>
    </head>
    <body>

            
          
<main id="level"> 
        <div class="row">
        <!--
<div class="section ad-section responsive-ad">
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="ca-pub-8371413036585820"
       data-ad-slot="3536880998"
       data-ad-format="auto"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</div> -->
         
                       
          <div class="modal" id="share-level">
            
          </div><!-- End modal -->
          <div class="modal" id="edit-images">
            
          </div><!-- End modal -->
          <div class="primary-content">
            <div class="section level-section" level="27809">
              <nav>
                <div class="nav-wrapper">
                  <p class="brand-logo truncate center-align" style="position: unset!important;">Level Name (<?php echo $file_id; ?>)</p>
                </div><!-- End nav wrapper -->
              </nav><!-- End nav -->
              <div class="card">
                <div class="card-content">
                  <div class="row">
                    <div class="level-code">
                      <textarea class="level-code-textarea" readonly=""><?php echo $file_data; ?></textarea>
                    </div><!-- End level code -->
                    <div class="level-info">
                      <div class="row no-margin">
                        <div class="col s12 m6 l6 no-padding">
                          <ul class="collection level-stats">
                            
                                                       
                            <a href="profile?user_id=1558">
                              <li class="collection-item hover-effect border-bottom-1">
                                <div class="level-creator row no-margin">
                                  <div class="user-aside no-padding col s2"> 
                                    <div style="background-image: url(https://media.discordapp.net/attachments/325507713159397378/476146448510222346/blue_crack_flower.png);" class="user-icon user-icon-round"></div>
                                  </div><!-- End user aside -->
                                  <div class="user-content col s10">
                                    <p class="user-username text">Username</p>
                                    <p class="user-class text">Role</p>
                                  </div><!-- End user content -->
                                </div><!-- End row -->
                              </li><!-- End creator info -->
                            </a><!-- End user url -->
                              

                                                        
                            <li class="collection-item">
                              <strong>Class:</strong> Gold                            </li>
                            <li class="collection-item">
                              <strong>Rating:</strong> 98.3%
                            </li>
                            <li class="collection-item">
                              <strong>Votes:</strong> 4                            </li>
                            <li class="collection-item">
                              <strong>Plays:</strong> 28                            </li>
                            <li class="collection-item">
                              <strong>Favorited By:</strong> 0                            </li>
                            <li class="collection-item">
                              <strong>Game:</strong>
                                                            <a href="game?id=49" target="_blank" class="add-play">Super Mario Construct</a>                            </li>
                            <li class="collection-item">
                              <strong>Difficulty:</strong> Medium                            </li>
                            <li class="collection-item">
                              <strong>Published:</strong> 02/10/22 at 8:27 PM                            </li>
                          </ul><!-- End level stats -->
                        </div><!-- End column -->
                        <div class="col s12 m6 l6 no-padding">
                          <ul class="collection level-description scrollable mega-scrollable">
                           
                                                        
                            <li class="collection-item">
                              <div class="slider" id="level-images-slider" style="height: 240px; touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                <ul class="slides" style="height: 200px;">

                                  <li class="active" style="opacity: 1;"><img src="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="background-image: url(&quot;https://i.imgur.com/d6Kbxs2.png&quot;);"></li>
                                </ul>
                              <ul class="indicators"><li class="indicator-item active"></li></ul></div><!-- End slider -->
                            </li><!-- End collection item -->
                            
                                                        
                            <li class="collection-item">
                              <strong>Description:</strong> 
                              Mario finds himself in the wintry lands of both a frigid forest and frozen cliffs, where monty moles and their variants are found more commonly, alongside snowy-themed enemies.                              
                            </li>
                            <li class="collection-item">
                              <strong>Contributors: </strong> 
                              
                              orangetack for the custom background
luigibonus for the custom music.                            </li>
                          </ul><!-- End level stats -->
                        </div><!-- End column -->
                      </div><!-- End row -->
                    </div><!-- End level info -->
                    <div class="level-rates">
                    
                                             
                          <div class="row">
                            <div class="col s12 m12 l12">
                              <h5 class="heading rates-heading">Rate this Level</h5>
                              <p>You'll need to <a href="login">login</a> or <a href="signup">create an account</a> in order to rate this level.</p>
                            </div><!-- End column -->
                          </div><!-- End row -->
                      
                                            
                                               
                        <div class="row">
                          <div class="separator separator-border-top">
                          <p>What Others are Saying</p>
                        </div><!-- End separator -->
                          <div class="col s12 m12 l12">
                            <div class="collection rates">
                         
                                                 
                          <div class="collection-item rate-container" rate="76865" user="5179">
                            <div class="row">
                              <div class="comment-aside col s2"> 
                                <div style="background-image: url(https://i.imgur.com/WV9ZJue.gif);" class="user-icon user-icon-round"></div>
                              </div><!-- End side info -->
                              <div class="comment-content col s10">
                                <p class="large-title text"><a href="profile?user_id=5179">SuperO</a> | 100/100</p>
                                <p class="comment text margin-top-5">
                                  
                                  <i>This user did not provide a review.</i>                                  
                                </p>
                                <div class="comment-info">
                                  <p class="comment-date text subtitle">02/11/22 at 9:16 AM</p>
                                                                    <p class="comment-actions right">
                                   
                                                                       
                                  </p><!-- End comment actions -->
                                </div><!-- End comment info -->
                              </div><!-- End rate content -->
                            </div><!-- End row -->
                          </div><!-- End rate container -->

                                                     
                          <div class="collection-item rate-container" rate="76861" user="3010">
                            <div class="row">
                              <div class="comment-aside col s2"> 
                                <div style="background-image: url(https://cdn.discordapp.com/attachments/445854723870818325/927396540354551808/FB_IMG_16411230981522835-3.jpg);" class="user-icon user-icon-round"></div>
                              </div><!-- End side info -->
                              <div class="comment-content col s10">
                                <p class="large-title text"><a href="profile?user_id=3010">AllenCaspe9510</a> | 98/100</p>
                                <p class="comment text margin-top-5">
                                  
                                  Let me get this straight. It's a very hard level. It's also a very beautiful level with appealing design including innovation but. It's not fun to play for me. Creative Challenges and Level design but this level isn't about endurance, its about precision. Let's get to the bottom of this.<br>
<br>
First off, a large chunk of snow, followed up by enemies slide walking from a slope in the very first screen when you play the level. You gotta be kidding me. The next part is a small cave compartment lived by dangerous enemies. The big moles in those small tight compartments forces the player to control their slide power, it's fine. With falling icicles? It's still fine. With Hammer Bros at the end of that compartment? I think it's going to be a bit frustrating to walk through those small tight sections when you die and there's multiple of them spread out on small spaced areas that would greatly increase the difficulty of this level.<br>
<br>
So I transverse through even the most difficult minis, and I really like the generous mushrooms. Had to fight against challenges that use instant death blocks. And finally, that lovely checkpoint. Nice!<br>
<br>
The next part after the checkpoint is really not fun to play through and its really long. On x190, that invisible mushroom caught me off guard. But it finally has a balanced placed hammer bro. After the challenge where you spin jump off a piranha from a pipe. I approach the most hardest challenges yet, the long on/off switch section, followed up by three minis. Then, a very precise off switch trigger and land on that moving mole. I spent a lot lives on this. Then, backtrack those three minis, but with increased difficultly and it's brutal.<br>
<br>
After that, you now have to ride a mole that brings you to a deep compartment below. Grab a spring. Carefully, create a pathing for the mole so that you can transverse through this compartment. Use the spring to jump high, and so on. The challenge still continues. You have to follow a cloud and you have to catch up to it, you can't take your time anymore to not die so you have to move quickly, very unforgiving.<br>
Then one last climb fighting against tough enemies and eventually, I like the ending. Go seek it out for yourself.<br>
Overall, not a fun level. Beautiful level, a lot of effort was made. Really difficult, would recommend this to players who excel in tight platforming and yeah. I'm probably going to rate this a generous 98 and a very hard rating.<br>
<br>
- Sent from my LG Refrigerator                                  
                                </p>
                                <div class="comment-info">
                                  <p class="comment-date text subtitle">02/11/22 at 5:36 AM</p>
                                                                    <p class="comment-actions right">
                                   
                                                                       
                                  </p><!-- End comment actions -->
                                </div><!-- End comment info -->
                              </div><!-- End rate content -->
                            </div><!-- End row -->
                          </div><!-- End rate container -->

                                                     
                          <div class="collection-item rate-container" rate="76860" user="906">
                            <div class="row">
                              <div class="comment-aside col s2"> 
                                <div style="background-image: url(https://lazorcozmic5.weebly.com/uploads/2/5/5/7/25575779/new-masked-avatar-2021-july_orig.png);" class="user-icon user-icon-round"></div>
                              </div><!-- End side info -->
                              <div class="comment-content col s10">
                                <p class="large-title text"><a href="profile?user_id=906">LazorCozmic5</a> | 95/100</p>
                                <p class="comment text margin-top-5">
                                  
                                  I found the first half more enjoyable compared to the more frustrating second half which had some unfair obstacles, that of which include the Cool Mole beside the nibbler as well as the backtracking challenge when you have the two spineys conflicting with the movement of the Big Fuzzy. It's also not advised to place invisible blocks above walking enemies, whether it's an invisible coin block or invisible powerup block. I respect the way you ended the level though.                                  
                                </p>
                                <div class="comment-info">
                                  <p class="comment-date text subtitle">02/11/22 at 3:24 AM</p>
                                                                    <p class="comment-actions right">
                                   
                                                                       
                                  </p><!-- End comment actions -->
                                </div><!-- End comment info -->
                              </div><!-- End rate content -->
                            </div><!-- End row -->
                          </div><!-- End rate container -->

                                                     
                          <div class="collection-item rate-container" rate="76850" user="7353">
                            <div class="row">
                              <div class="comment-aside col s2"> 
                                <div style="background-image: url(images/icons/icon1.png);" class="user-icon user-icon-round"></div>
                              </div><!-- End side info -->
                              <div class="comment-content col s10">
                                <p class="large-title text"><a href="profile?user_id=7353">carl3</a> | 100/100</p>
                                <p class="comment text margin-top-5">
                                  
                                  eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee                                  
                                </p>
                                <div class="comment-info">
                                  <p class="comment-date text subtitle">02/10/22 at 9:50 PM</p>
                                                                    <p class="comment-actions right">
                                   
                                                                       
                                  </p><!-- End comment actions -->
                                </div><!-- End comment info -->
                              </div><!-- End rate content -->
                            </div><!-- End row -->
                          </div><!-- End rate container -->

                                                    
                              </div><!-- End rates -->
                            </div><!-- End column -->
                          </div><!-- End row -->
                          
                                                
                    </div><!-- End level rates -->
                  </div><!-- End row -->
                </div><!-- End card content -->
              </div><!-- End card -->
            </div><!-- End level section -->
          </div><!-- End column (primary) -->
          <div class="secondary-content col s12 l3">
            
              
  
  
              
            
                     
         <!--
<div class="ad-section leaderboard-ad hide-on-med-and-down">
   <center>
     <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <ins class="adsbygoogle"
         style="display:inline-block;width:728px;height:90px"
         data-ad-client="ca-pub-8371413036585820"
         data-ad-slot="3829428999"></ins>
      <script>
(adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </center>
</div>  -->
          
        </div><!-- End row -->
        
      </div></main>
          
          

    </body>
</html>