<?php
$pagename = 'Home';
$pagelink = 'www.dimensious.com';
include('header.php');
?>
<?php
$id = $myu->id;
if ($user) {
?>
<style data-jss="" data-meta="Unthemed">
.container-0-2-24 {
  max-width: 1200px!Important;
}
.headshotWrapper-0-2-25 {
  border: 1px solid #c3c3c3;
  overflow: hidden;
  background: white;
  box-shadow: 0 -5px 20px rgba(25,25,25,0.15);
  border-radius: 100%;
}
.helloMessage-0-2-26 {
  font-size: 40px;
  font-weight: 600;
}
@media(min-width: 980px) {
  .helloMessage-0-2-26 {
    margin-top: 60px;
    margin-left: 20px;
  }
}
.subHeader-0-2-27 {
  color: #4a4a4a;
  font-size: 24px;
  font-weight: 300;
}
.card-0-2-28 {
  box-shadow: 0 -5px 20px rgba(25,25,25,0.15);
}
.friendRow-0-2-29 {
  overflow: auto;
  flex-flow: row;
  margin-right: -7px;
}
.mainBody-0-2-30 {
  background: #e3e3e3;
}
</style>
<style data-jss="" data-meta="Unthemed">
.image-0-2-39 {
  width: 100%;
  height: auto;
  margin: 0 auto;
  display: block;
  max-width: 400px;
}
</style>
<div class="row">
<h3 class="helloMessage-0-2-26">Hello, <? echo $myu->username ?>!</h3>
<iframe frameborder="0" src="/avatar.php?id=<? echo $myu->id ?>" scrolling="no" style=" width: 200px; height: 200px"></iframe></div><br><br><h4>you have no friends<br>(we plan to make this show more things, just later, in the mean time, <a href="https://discord.gg/cdgWqNNmYR">click here to join the discord server</a>)</h4><?php
} else {
header('Location: /auth/home');
}
?>
<?php
include('footer.php');
?>