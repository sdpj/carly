<?php

session_id();
session_start();
ob_start();
date_default_timezone_set('America/Chicago');
      @mysql_connect("mysql.ct8.pl","m27001_oldblox","OldBlox1#");
    mysql_select_db("m27001_oldblox");
function SecurePost($var) {
    return mysql_real_escape_string(strip_tags(stripslashes($var)));
  }
 

  
  $Admin = $_SESSION['Admin'];
  
  if ($User) {
  
    $MyUser = mysql_query("SELECT * FROM Users WHERE Username='".$User."'");
    $myU = mysql_fetch_object($MyUser);
    $UserExist = mysql_num_rows($MyUser);
    
      if ($UserExist == "0") {
      
        session_destroy();
        header("Location: /index.php"); exit();
      
      }
  
  }
  $User = $_SESSION['Username'];
  function filter($string) {
  //array
  $words = array("fuck", "bitch", "gay", "asshole", "cunt", "dick", "nigga", "nigger", "penis", "vagina", "pussy", "sex", "blowjob", "s3x", "shit", "cum", "sperm", "lesbian", "slut", "anal", "penus", "cock", "tits", "weed", "faggot","gey","gay","wetback","s3x","secks");
  $new =   array("****", "*****", "***", "*******", "****", "****", "*****", "******", "*****", "******", "*****", "***", "*******", "***", "****", "***", "*****", "*******", "****", "****", "*****", "****", "****", "****", "******", "***","***", "*******", "***", "****");
  $string1 = str_ireplace($words, $new, $string);
  $findme = "***";
  $pos = strpos($string1, $findme);
  if ($pos !== false) {
  $User = $_SESSION['Username'];
    $MyUser = mysql_query("SELECT * FROM Users WHERE Username='".$User."'");
    $myU = mysql_fetch_object($MyUser);
   mysql_query("INSERT INTO Reports (UserWhoSent, UserReported, Content, Comment, Category, Type, ItemID) VALUES('1','$myU->ID','$string','System Report','System Report','System','0')");

  
  $string1 = "[ Moderated Content ]";

  return $string1;
  }
  else {
  return $string1;
  }
  }
  
  function filter2($string) {
  //array
  $words = array("fuck", "bitch", "gay", "asshole", "cunt", "dick", "nigga", "nigger", "penis", "vagina", "pussy", "sex", "blowjob", "s3x", "shit", "cum", "sperm", "lesbian", "slut", "anal", "penus", "cock", "tits", "weed", "faggot","gey","gay","wetback","s3x","secks");
  $new =   array("****", "*****", "***", "*******", "****", "****", "*****", "******", "*****", "******", "*****", "***", "*******", "***", "****", "***", "*****", "*******", "****", "****", "*****", "****", "****", "****", "******", "***","***", "*******", "***", "****");
  $string1 = str_ireplace($words, $new, $string);
  $findme = "***";
  $pos = strpos($string1, $findme);
  if ($pos !== false) {
  $User = $_SESSION['Username'];
    $MyUser = mysql_query("SELECT * FROM Users WHERE Username='".$User."'");
    $myU = mysql_fetch_object($MyUser);

  
  $string1 = "[ Moderated Content ]";

  return $string1;
  }
  else {
  return $string1;
  }
  }