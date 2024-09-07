<?
include("header.php");

$id = $_GET['id'];

$getUser = $handler->query("SELECT * FROM users WHERE id='".$id."'");
$gU = $getUser->fetch(PDO::FETCH_OBJ);
$id = $gU->id;
$username = htmlspecialchars($gU->username);
$userExist = ($getUser->rowCount());
if ($userExist == "0") {
header("Location: /");
}
?>
<table style="BORDER-RIGHT: black thin solid; BORDER-TOP: black thin solid; MARGIN-BOTTOM: 12px; BORDER-LEFT: black thin solid;" cellspacing="0" cellpadding="5" width="818">
        <tbody>
          <tr>
            <td style="FONT-WEIGHT: bold; COLOR: white; border-bottom: black 1px solid;" bgcolor="steelblue"><?=$sitename;?> User</td>
            <td style="FONT-WEIGHT: bold; COLOR: white; border-bottom: black 1px solid;" bgcolor="steelblue">&nbsp;</td>
          </tr>
          <tr><td style="border-bottom: black 1px solid; border-right: black 1px solid;" align="center" width="50%" height="240px">
            <h3>Username:</h3>
            <!-- username -->
            <?=$username;?><h3>Date Created:</h3><?=date("Y-m-j G:i:s", $gU->datecreated);?><h3><?=$sitename;?> Points:</h3><?=$gU->emeralds;?> RP</td><td style="border-bottom: black 1px solid;" align="center" valign="top"><h3>About me:</h3>            <form action="/users.php" method="post">
              <textarea style="resize: none" cols="50" rows="10" name="new_about_me" maxlength="500" readonly=""><?=htmlspecialchars($gU->bio);?></textarea>              </form>
          </td>
        </tr></tbody>
      </table>
<?
include("footer.php");?>