<?
include 'Header.php'
?>
<form action="" method="post">
<h2>Account Settings</h2>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home">
    <p>
</p><h4>Description:</h4>
    <h6>Note: Apostrophes are not allowed</h6>
<textarea name="NewBio" style="width: 50%; height: 150px; box-shadow: 0 0 0 !important;background-color:white;"><? echo "$myU->Description"; ?></textarea>
<br>
<br>
<input type="submit" name="ConfirmSettings" class="btn btn-primary" value="Update">
  </div>
<div class="tab-pane fade" id="social">
<p>
</div>
</div>
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;&nbsp;Success</h4>
</div>
<div class="modal-body">
You have been successfully signed out of all other sessions.
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
</div>
</div>
</div>
</div>
<div class="modal fade" id="confModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;&nbsp;&nbsp;Confirmation</h4>
</div>
<div class="modal-body">
If you have not set up Klotarium PUSH before, you should now be seeing a message from your browser requesting notification access. Click Enable.
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" id="dismiss-confm">OK</button>
<script>
$('#dismiss-confm').click(function(){
window.location = "https://buildcity.ml/Account/Settings?succ=true";
});
</script>
</div>
</div>
</div>
</div>
</div>
</div></form>


<?php
$adminDesc = $_POST['NewBio'];
$safeadminDesc = htmlentities($_POST['NewBio']);
$Desc = filter($_POST['NewBio']);
$Twit = filter($_POST['NewTwit']);
$SubmitTwit = $_POST['ConfirmTwit'];
$Submit = $_POST['ConfirmSettings'];
$Descriptio = htmlentities($Desc);
if ($Submit) {
          
          
                if($myU->PowerAdmin == "false") {
                mysql_query("UPDATE Users SET Description='".$Descriptio."' WHERE ID='".$myU->ID."'");
                }elseif($myU->PowerAdmin == "true"){
                mysql_query("UPDATE Users SET Description='".$Descriptio."' WHERE ID='".$myU->ID."'");
                };
    
    header("Location: /Settings.php");
    die();
    
  };
if ($SubmitTwit) {
          
    mysql_query("UPDATE Users SET Twitter='".$Twit."' WHERE ID='".$myU->ID."'");
    
    header("Location: /Settings.php");
    die();
    
  };
if(!$User){
echo"<h1>Sorry, But you're not a Member</h1>";
};
include 'Footer.php'
?>