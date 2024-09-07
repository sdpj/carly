<?php

  include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
  $getUsers = mysql_query("SELECT * FROM Users");
  $numUsers = mysql_num_rows($getUsers);
  $Online = mysql_query("SELECT * FROM Users WHERE  $now < expireTime");
  $Online = mysql_num_rows($Online);
  $All = mysql_query("SELECT * FROM Users WHERE Ban='0'");
  $All = mysql_num_rows($All);
  $getUser = mysql_query("SELECT * FROM Users WHERE Ban='0'");
echo"
  <div class='members-browse-page'>
    <div style='width: 876px; height: 28px; margin-bottom: 10px; clear: both;'>

       <span class='form-label' style='margin-right: 30px;padding-top:5px;'>
        <strong>Search:</strong>
      </span>
      <span>
        <span class='search-bar'>
          <form action='' method='POST' style='margin:0;padding:0;'>
             <input type='text' name='UserSearchBar' maxlength='100' style='width:400px;'>
            <input type='submit' name='UserSearchSubmit' value='Search Users'>
            <a href='online.aspx'><b>Online (".$Online.")</b></a>
          </form>
        </span>
      </span>
             
  </div>

";

while ($gU = mysql_fetch_object($getUser)) {
$Description = nl2br($gU->Description);
echo"
<hr style='border: none; height: 1px; color: grey; background: lightgrey;'/>

<div style='padding-left:20px;'>

<table width='705px'>
<tr>
<td width='100px'>
<a href='user.aspx?ID=$gU->ID'><img src='/Avatar.php?ID=$gU->ID' style='height:50px;'></a>
</td>
<td width='100px'>
<a href='user.aspx?ID=$gU->ID'>$gU->Username</a>
</td>
<td width='305px'>
<center>$Description</center>
</td>
<td width='200x'>
";
  
  if (!$gU->expireTime){
                $SS = "Error";
              }
              else {
                if ($now < $gU->expireTime) {
                  $SS = "<center><font color='green'>Online</font></center>";
                }
                else {
                  $SS = date("F j, Y g:iA", $gU->expireTime);
                }
              }
  }
            echo"<center>";echo$SS;echo"</center>"; echo"
</td>
</tr>

</table>
</div>


";

$SubmitUserSearch = SecurePost($_POST['UserSearchSubmit']);
$UserSearch = SecurePost($_POST['UserSearchBar']);
if($SubmitUserSearch) {
$getUser = mysql_query("SELECT * FROM Users WHERE Username LIKE '%$UserSearch%' AND Ban='0'");
$userResults = mysql_num_rows($getUser);
if (!$UserSearch){
  die;
}
//if(!$SubmitUserSearch or !$UserSearch) {
//$getUser = mysql_query("SELECT * FROM Users WHERE Ban='0'");
//}
if ($userResults == 0) {
echo"<div style='padding-left:20px;'>
No users found</div>";
die();
}
while ($gU = mysql_fetch_object($getUser)) {
$Description = nl2br($gU->Description);
echo"
<hr style='border: none; height: 1px; color: grey; background: lightgrey;'/>

<div style='padding-left:20px;'>

<table width='705px'>
<tr>
<td width='100px'>
<a href='user.aspx?ID=$gU->ID'><img src='/Avatar.php?ID=$gU->ID' style='height:50px;'></a>
</td>
<td width='100px'>
<a href='user.aspx?ID=$gU->ID'>$gU->Username</a>
</td>
<td width='305px'>
<center>$Description</center>
</td>
<td width='200x'>
";if (!$gU->expireTime){
                $SS = "Error";
              }
              else {
                if ($now < $gU->expireTime) {
                  $SS = "<center><font color='green'>Online</font></center>";
                }
                else {
                  $SS = date("F j, Y g:iA", $gU->expireTime);
                }
              }
            echo"<center>";echo$SS;echo"</center>"; echo"
</td>
</tr>

</table>
</div>


";


}
}

  include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>