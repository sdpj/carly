<? include("header.php"); error_reporting(E_ALL);

$id = $_GET['id'];
$baseplate = $handler->query("SELECT * FROM games WHERE id=" . $_GET['id']);
$gB = $baseplate->fetch(PDO::FETCH_OBJ);

?>

<table style="BORDER-RIGHT: black thin solid;BORDER-TOP: black thin solid;MARGIN-BOTTOM: 12px!important;BORDER-LEFT: black thin solid; MARGIN: auto;" cellspacing="0" cellpadding="5" width="512">
        <tbody>
          <tr>
            <td style="FONT-WEIGHT: bold; COLOR: white; border-bottom: black 1px solid;" bgcolor="steelblue"><?=$sitename;?> Level</td>
          </tr>
          <tr><td style="border-bottom: black 1px solid;" align="center" width="50%" height="240px">
          
            <img src="<?=htmlspecialchars($gB->image);?>" height="240"><br><br><a href="#"><button>Play Game</button></a><br><br><br><h3 align="left">Title:</h3><p align="left"><?=htmlspecialchars($gB->title);?></p><h3 align="left">Description:</h3><p align="left"><?=htmlspecialchars($gB->description);?></p><h3 align="left">Creator:</h3><a href="/user.aspx?id=1"><p align="left">Placeholder</p></a><h3 align="left">Creation Date:</h3><p align="left">2000-01-01 00:00:00</p><h3 align="left">Ratings:</h3><p align="left">0.00</p>          <button>I like this</button>&nbsp;&nbsp;<button>I dislike this</button>
    </td>
  </tr></tbody>
    </table>

<? include("footer.php"); ?>