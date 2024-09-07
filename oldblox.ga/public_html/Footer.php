  </div>
  </div>
  </div>
  <?if(!$User){
    echo" 
    <div class='footer-container'>
    ";  
  }elseif($myU->Premium == "0"){
    echo"
    <div class='footer-container'>
    ";
  }elseif($myU->Premium == "1"){
    echo"
    <div class='footer-container'>
    ";
  }elseif($myU->Premium == "2"){
    echo"
    <div class='footer-container'>
    ";
  }elseif($myU->Premium == "3"){ 
    echo"
    <div class='footer-container' style='background:black;'>
    ";
  }?>
    <div id='footer-nav'>
      <a href='/info/Privacy.aspx'>
        Privacy Policy
      </a>
      &nbsp;|&nbsp;
      <a href='../test.php'>
        Advertise with Us
      </a>
      &nbsp;|&nbsp;
      <a href='../test.php'>
        Press
      </a>
      &nbsp;|&nbsp;
      <a href='../test.php'>
        Contact Us
      </a>
      &nbsp;|&nbsp;
      <a href='../test.php'>
        About Us
      </a>
      &nbsp;|&nbsp;
      <a href='../test.php'>
        Blog
      </a>
      &nbsp;|&nbsp;
      <a href='..test.php'>
        Jobs
      </a>
      &nbsp;|&nbsp;
      <a href='../test.php'>
        Parents
      </a>
      &nbsp;|&nbsp;
      <a href='../test.php'>
        Online Store
      </a>
      <?php if($myU->Premium != "3" OR !$User){
        echo"
        
        <table width='100%' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='75'>
            <img src='/Badgess/Administrator.png' height='75' width='75' style='vertical-align:middle;margin-right:10px;'>
          </td>
          <td width='775'>
            <table width='100%' cellspacing='0' cellpadding='0'>
              <tr>
                <td>
                  <div id='badgecontainer' style='color:#555;font-size:12px;text-align:left;'>
                    ROBLOX, \"Online Building Toy\", characters, logos, names, and all related indicia are trademarks of <a href=\"http://corp.roblox.com/\" ref=\"footer-smallabout\" style='color: #095fb5;'>ROBLOX Corporation</a>, ©2012. Patents pending.
    ROBLOX is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, and no resemblance to the products of these companies is intended. Use of this site signifies your acceptance of the <a href=\"/web/20121022233947/http://www.roblox.com/info/terms-of-service\" ref=\"footer-terms\" style='color: #095fb5;'>Terms and Conditions</a>.
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      ";
      }
      elseif($myU->Premium == "3"){
        echo"
        <hr color='#6E6E6E' size='1' style='margin:10px;'>
        <table width='100%' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='75'>
            <img src='/Badgess/Administrator.png' height='75' width='75' style='vertical-align:middle;margin-right:10px;'>
          </td>
          <td width='775'>
            <table width='100%' cellspacing='0' cellpadding='0'>
              <tr>
                <td>
                  <div id='badgecontainer' style='color:#6E6E6E;font-size:12px;text-align:left;'>
                    Avatar-Universe is in no way affiliated with World2Build.com, WorldToBuild.com, ROBLOX, or other SANS (&quot;Social Avatar Network Script&quot;) websites. avatar-gamer.ga is copyrighted under World2Build Inc &copy; 2015. All rights reserved. Use of our website signifies your acceptance of our <a href='/info/terms-of-service/'>terms and conditions</a>. For all privacy related issues, please refer to our <a href='/info/Privacy.aspx'>privacy policy</a> or email <a href='mailto:info@avatar-gamer.ga'>info@avatar-gamer.ga</a>.
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      ";
      }?>
    </div>
  </div>