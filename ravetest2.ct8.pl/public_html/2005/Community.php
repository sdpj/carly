<? include("header.php");

$show = "25";

$sort = "id";

$search = "";

$ascordesc = "ASC";


if(is_numeric($_GET['show'])){

$show = htmlspecialchars($_GET['show']);

}

if($_GET['sort']){

$sort = htmlspecialchars($_GET['sort']);

}

if($_GET['sort'] == "points"){

$sort = "emeralds";

$ascordesc = "DESC";

}

if($_GET['search']){

$search = htmlspecialchars(mysql_real_escape_string($_GET['search']));

}

?>

<h3>List of <?=$sitename;?> users from oldest to newest.</h3>
Users listed 
<select name="showing" id="showing">
   <option value="?show=25">25</option>
   <option value="?show=50">50</option>
   <option value="?show=100">100</option>
   <option value="?show=200">200</option>
   <option value="?show=9999999999">All</option>
</select>
&nbsp; &nbsp;
<input id="searching" placeholder="Enter a username to refine your search." size="32">
&nbsp;&nbsp;Sort by 
<select name="sorting" id="sorting">
   <option value="&amp;sort=id">User ID</option>
   <option value="&amp;sort=username">Username</option>
   <option value="&amp;sort=points">Points</option>
</select>
<button id="searchBtn" onclick="onClick()">Search</button>
<script>
   var input = document.getElementById("searching");
   input.addEventListener("keypress", function(event) {
     if (event.key === "Enter") {
       event.preventDefault();
       document.getElementById("searchBtn").click();
     }
   });
   
   function onClick() {
     var x = document.getElementById("showing").value;
     var y = document.getElementById("sorting").value;
     var z = document.getElementById("searching").value;
     window.location.replace("/2005/Community.aspx" + x + y + "&search=" + z);
   }
</script>
<br>
<br>
<table style="BORDER-RIGHT: black thin solid; BORDER-TOP: black thin solid; MARGIN-BOTTOM: 12px; BORDER-LEFT: black thin solid;" cellspacing="0" cellpadding="5" width="818">
   <tbody>
      <tr>
         <td style="FONT-WEIGHT: bold; COLOR: white; border-right: black 1px solid; border-bottom: black 1px solid;" bgcolor="steelblue">&nbsp;User ID&nbsp;</td>
         <td style="FONT-WEIGHT: bold; COLOR: white; border-right: black 1px solid; border-bottom: black 1px solid;" bgcolor="steelblue">Username</td>
         <td style="FONT-WEIGHT: bold; COLOR: white; border-right: black 1px solid; border-bottom: black 1px solid;" bgcolor="steelblue">Points</td>
         <td style="FONT-WEIGHT: bold; COLOR: white; border-bottom: black 1px solid;" bgcolor="steelblue">Date Created</td>
      </tr>

<?php
$getUsers2 = mysql_query("SELECT * FROM users WHERE username LIKE '%$search%' ORDER BY $sort $ascordesc LIMIT $show");
while($gU2 = mysql_fetch_object($getUsers2)){?>


      <tr>
         <td style="border-right: black 1px solid; border-bottom: black 1px solid;">1</td>
         <td style="border-right: black 1px solid; border-bottom: black 1px solid;"> <a href="user.aspx?id=<?=$gU2->id;?>"><?=$gU2->username;?></a></td>
         <td style="border-right: black 1px solid; border-bottom: black 1px solid;"><?=$gU2->emeralds;?></td>
         <td style=" border-bottom: black 1px solid;"><?=date("Y-m-j G:i:s", $gU2->datecreated);?></td>
      </tr>

<? } ?>

   </tbody>
</table>

<? include("footer.php"); ?>