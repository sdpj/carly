<? include"../header.php"; 
?>
<?php 
$id = $_GET["ID"];
?>
<?php
$id = $myu->id;
if ($user) {
?>
</center>
<div class="col s12 m9 l8">
<div class="container" style="width:100%;">
<script>
    document.title = "Rhodum|<?php echo $id; ?>;
  </script>
<div class="content-box">
<div class="header-text">Join a game</div></br>
<div style="font-size:16px;">How to join a game: Open Rhodum Player, Enter your username, and then enter your discord token which you can generate  <a href="http://rhodum.xyz/token/">here</a>. If you don't have the client, you can dowload it <a href="http://rhodum.xyz/Hat/?file=Rhodum.exe">here</a></div>
<?php
} else {
header('Location: /Register');
}
?>