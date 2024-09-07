<? include("header.php"); ?>

<title><?=$sitename;?> Games</title>

<h1 class="MenuItem" align="center"><?=$sitename;?> Games</h1>
<table class="Grid" style=" BORDER-TOP: silver thin solid; MARGIN-BOTTOM: 0px; BORDER-LEFT: silver thin solid;" cellspacing="0" cellpadding="5" width="818">
   <tbody>
      <tr>
         <td class="GridHeader" style="FONT-WEIGHT: bold; COLOR: white; border-right: silver 1px solid; border-bottom: silver 0px solid;">Name</td>
         <td class="GridHeader" style="FONT-WEIGHT: bold; COLOR: white; border-right: silver 1px solid; border-bottom: silver 0px solid;">Rating</td>
         <td class="GridHeader" style="FONT-WEIGHT: bold; COLOR: white; border-right: silver 1px solid; border-bottom: silver 0px solid;">Author</td>
         <td class="GridHeader" style="FONT-WEIGHT: bold; COLOR: white; border-right: silver 0px solid; border-bottom: silver 0px solid;">Date</td>
      </tr>

<? $lvlsql = mysql_query("SELECT * FROM games ORDER BY id DESC LIMIT 10");
while($lvl = mysql_fetch_object($lvlsql)){ ?>

      <tr>
         <td valign="center" style="border-right: silver 1px solid; border-bottom: silver 0px solid;">
            <div style="display:inline-block;vertical-align:middle;"><a href="Game/Default.aspx?id=<?=$lvl->id;?>"><img width="64" height="48" src="<?=htmlspecialchars($lvl->image);?>"></a></div>
            <div style="display:inline-block;"><a href="Game/Default.aspx?id=<?=$lvl->id;?>"><?=htmlspecialchars($lvl->title);?></a></div>
         </td>
         <td style="border-right: silver 1px solid; border-bottom: silver 0px solid;">0 <img src="images/emoticons/smiley_ok.bmp"></td>
         <td style="border-right: silver 1px solid; border-bottom: silver 0px solid;"><a href="user.aspx?id=1">Placeholder</a></td>
         <td style=" border-bottom: silver 0px solid;">2000-01-01 00:00:00</td>
      </tr>

<?}?>

   </tbody>
</table>
<table class="Grid" style="BORDER-RIGHT: silver thin solid; BORDER-BOTTOM: silver thin solid; MARGIN-BOTTOM: 12px; BORDER-LEFT: silver thin solid;" cellspacing="0" cellpadding="5" width="818">
   <tbody>
      <tr>
         <td bgcolor="969696" align="center"><a href="/levels.php?page="></a>&nbsp;<a href="/levels.php?page=1">1</a>&nbsp;<a href="/levels.php?page=2">2</a>&nbsp;<a href="/levels.php?page=3">3</a>&nbsp;<a href="/levels.php?page=4">4</a>&nbsp;</td>
      </tr>
   </tbody>
</table>

<? include("footer.php"); ?>