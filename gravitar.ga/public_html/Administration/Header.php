<?php

include "Global.php";

if ($user['powerAdmin'] == 0){
  if ($user['powerCM'] == 0){
    if ($user['powerForumMod'] == 0){
      if ($user['powerHeadMod'] == 0){
        if ($user['powerImageMod'] == 0){
          header('location: ../index.php');
          exit();
          die();
        }
      }
    }
  }
}



echo "
<style>
body {

padding: 0;
margin: 0;
}
#Header {
border-right:1px solid black;
float:left;
font-family:verdana;
background-color:lightgrey;
width:15%;
margin:0;
padding:15px;
height:100%;
}
#buttonsmall {
   -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  background: #3498db;
  padding: 0px 10px 0px 10px;
  text-decoration: none;
}
</style>
<div id='Header'>
<a href='Pend.php' >Pend Items (" . mysql_num_rows(mysql_query("SELECT * FROM `shop` WHERE `accepted`='0' ORDER BY id")) . ")</a><br>
";
if ($user['Username'] == 'wafkee'){
  ?><a href='Give.php'>Give Upgrades</a>
    <?php
}
if ($user['powerHeadMod'] == '1'){
}
echo "<br>
<a href='Reports.php' >Reports (" . mysql_num_rows(mysql_query("SELECT * FROM `report` ORDER BY reportID")) . ")</a><br>
<a href='Ban.php' >Ban Users</a><br>
<a href='Change.php' >Change Announcement</a>
<br><br>
<a href='/index.php'>&larr; Back to Site</a>
</div>";