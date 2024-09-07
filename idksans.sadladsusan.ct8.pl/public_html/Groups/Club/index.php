<? include "../../header.php"; 

$id = $_GET['id'];

if(!$_GET['id'])
{
    header('Location: /Groups');
}

$getGroup = $handler->query("SELECT * FROM `groups` WHERE id=" . $_GET['id']);

$gG = $getGroup->fetch(PDO::FETCH_OBJ);

$ownersql = $handler->query("SELECT * FROM `users` WHERE username='" . $gG->owner."'");

$owner = $ownersql->fetch(PDO::FETCH_OBJ);


?>

<div class="col s12 m9 l8">

<div class="container" style="width:100%;">

<script>

		function about() {

			document.getElementById("about-tab").style.backgroundColor = "#FAFAFA";

			document.getElementById("about-tab").style.borderRight = "5px solid #0288d1";

			

			document.getElementById("announcements-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("announcements-tab").style.borderRight = "none";

			document.getElementById("members-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("members-tab").style.borderRight = "none";

			document.getElementById("events-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("events-tab").style.borderRight = "none";

			document.getElementById("divisions-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("divisions-tab").style.borderRight = "none";

			document.getElementById("about").style.display = "block";

			

			document.getElementById("announcements").style.display = "none";

			document.getElementById("members").style.display = "none";

			document.getElementById("events").style.display = "none";

			document.getElementById("divisions").style.display = "none";

		}

		

		function announcements() {

			document.getElementById("about-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("about-tab").style.borderRight = "none";

			

			document.getElementById("announcements-tab").style.backgroundColor = "#FAFAFA";

			document.getElementById("announcements-tab").style.borderRight = "5px solid #0288d1";

			document.getElementById("members-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("members-tab").style.borderRight = "none";

			document.getElementById("events-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("events-tab").style.borderRight = "none";

			document.getElementById("divisions-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("divisions-tab").style.borderRight = "none";

			document.getElementById("about").style.display = "none";

			

			document.getElementById("announcements").style.display = "block";

			document.getElementById("members").style.display = "none";

			document.getElementById("events").style.display = "none";

			document.getElementById("divisions").style.display = "none";

		}

		function members() {

			document.getElementById("about-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("about-tab").style.borderRight = "none";

			

			document.getElementById("announcements-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("announcements-tab").style.borderRight = "none";

			document.getElementById("members-tab").style.backgroundColor = "#FAFAFA";

			document.getElementById("members-tab").style.borderRight = "5px solid #0288d1";

			document.getElementById("events-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("events-tab").style.borderRight = "none";

			document.getElementById("divisions-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("divisions-tab").style.borderRight = "none";

			document.getElementById("about").style.display = "none";

			

			document.getElementById("announcements").style.display = "none";

			document.getElementById("members").style.display = "block";

			document.getElementById("events").style.display = "none";

			document.getElementById("divisions").style.display = "none";

		}

		function events() {

			document.getElementById("about-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("about-tab").style.borderRight = "none";

			

			document.getElementById("announcements-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("announcements-tab").style.borderRight = "none";

			document.getElementById("members-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("members-tab").style.borderRight = "none";

			document.getElementById("events-tab").style.backgroundColor = "#FAFAFA";

			document.getElementById("events-tab").style.borderRight = "5px solid #0288d1";

			document.getElementById("divisions-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("divisions-tab").style.borderRight = "none";

			document.getElementById("about").style.display = "none";

			

			document.getElementById("announcements").style.display = "none";

			document.getElementById("members").style.display = "none";

			document.getElementById("events").style.display = "block";

			document.getElementById("divisions").style.display = "none";

		}

		function divisions() {

			document.getElementById("about-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("about-tab").style.borderRight = "none";

			

			document.getElementById("announcements-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("announcements-tab").style.borderRight = "none";

			document.getElementById("members-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("members-tab").style.borderRight = "none";

			document.getElementById("events-tab").style.backgroundColor = "#FFFFFF";

			document.getElementById("events-tab").style.borderRight = "none";

			document.getElementById("divisions-tab").style.backgroundColor = "#FAFAFA";

			document.getElementById("divisions-tab").style.borderRight = "5px solid #0288d1";

			document.getElementById("about").style.display = "none";

			

			document.getElementById("announcements").style.display = "none";

			document.getElementById("members").style.display = "none";

			document.getElementById("events").style.display = "none";

			document.getElementById("divisions").style.display = "block";

		}

		

		function changeMembers(page, rank) {

			var xmlHttp = new XMLHttpRequest();

			xmlHttp.open( "GET", "https://www.bloxcity.com/groups/members.php?GroupID=1&Rank=" + rank + "&Page=" + page, true);

			xmlHttp.send(null);

			xmlHttp.onload = function(e) {

				if (xmlHttp.readyState == 4) {

					document.getElementById("members-area").innerHTML = xmlHttp.responseText;

				}

			}

		}

		

		window.onload = function() {

			

					about();

					changeMembers(1, 1);

					

			$(".modal-trigger").leanModal();

		}

	</script>

<form action="#">

<div class="row">

<div class="col s12 m10 l10">

<input type="text" class="general-textbar" placeholder="Search a group name (Coming Soon)" onchange="updateSearch(this.value)" name="query" style="width:100%;">

</div>

</div>

</form>

<div class="row">

<div class="col s12 m2 l3">

<div class="content-box" style="padding:0;padding:15px;">

<img src="<? echo " $gG->image"; ?>" class="responsive-img center-align" width="105%">

<div style="padding-top:3px;text-align:center;font-size:22px;word-wrap:break-word;"><? echo"$gG->title"; ?></div>

<div style="padding-top:3px;text-align:center;font-size:14px;">Owned by: <a href="/users/<? echo $owner->id ?>/profile"><? echo"$gG->owner"; ?></a></div>

<div style="height:12px;"></div>

<style data-jss="" data-meta="Unthemed">
.buyButton-0-2-58 {
  width: 100%;
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.buyButton-0-2-58:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
.normal-0-2-59 {
  width: auto!important;
}
.cancelButton-0-2-60 {
  width: 100%;
  border: 1px solid #404041;
  background: linear-gradient(0deg, rgba(69,69,69,1) 0%, rgba(140,140,140,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.cancelButton-0-2-60:hover {
  background: grey!important;
}
.continueButton-0-2-61 {
  width: 100%;
  border: 1px solid #084ea6;
  background: linear-gradient(0deg, rgba(8,79,192,1) 0%, rgba(5,103,234,1) 100%);
  padding-top: 5px;
  padding-bottom: 5px;
}
.continueButton-0-2-61:hover {
  background: linear-gradient(0deg, rgba(2,73,198,1) 0%, rgba(7,147,253,1) 100%); ;
}
.badPurchaseRow-0-2-62 {
  margin-top: 70px;
}
</style>
<style data-jss="" data-meta="Unthemed">
.btn-0-2-64 {
  color: white;
  border: 1px solid #357ebd;
  margin: 0 auto;
  display: block;
  padding: 1px 13px 3px 13px;
  font-size: 20px;
  text-align: center;
  font-weight: normal;
}
.btn-0-2-64:disabled {
  opacity: 0.5;
}
.wrapper-0-2-65 {
  width: 100%;
  border: 1px solid #a7a7a7;
  background: #e1e1e1;
}
.defaultBg-0-2-66 {
  background: linear-gradient(0deg, rgba(0,113,0,1) 0%, rgba(64,193,64,1) 100%);
}
.defaultBg-0-2-66:hover {
  background: linear-gradient(0deg, rgba(71,232,71,1) 0%, rgba(71,232,71,1) 100%);
}
</style>

<? $groupmember = $handler->query("SELECT * FROM groupmembers WHERE userid=" . $myu->id . " AND groupid=". $id);

if (!$groupmember->fetch(PDO::FETCH_OBJ)){ ?>

<div class="center-align"><form action="/Groups/Club/Join.php?id=<? echo $id ?>" method="POST"><input type="submit" name="JoinGroup" class="btn-0-2-64 buyButton-0-2-58 w-auto ms-0" value="Join Group" style="width:105%!important;"><input type="hidden" name="csrf_token" value="VoCrOP9owOTkoCXLNxpR5AkeGaiTYAhk1xH1Bjyivso="></form></div>

<? } else { ?>

<div class="center-align"><form action="/Groups/Club/Leave.php?id=<? echo $id ?>" method="POST"><input type="submit" name="JoinGroup" class="btn-0-2-64 wearButton-0-2-191 cancelButton-0-2-60" value="Leave" style="width:105%;"><input type="hidden" name="csrf_token" value="VoCrOP9owOTkoCXLNxpR5AkeGaiTYAhk1xH1Bjyivso="></form></div>

<? } ?>

</div>

<? $getGroup = $handler->query("SELECT * FROM groupmembers WHERE groupid='$id' LIMIT 12"); 

$getGroupM = $handler->query("SELECT * FROM groupmembers WHERE groupid='$id'"); ?>

<div style="height:15px;"></div>

<div class="group-tab-link" id="about-tab" onclick="about()" style="background-color: rgb(250, 250, 250); border-right: 5px solid rgb(2, 136, 209);">About</div>

<div class="group-tab-link" id="announcements-tab" onclick="announcements()" style="background-color: rgb(255, 255, 255); border-right: none;">Announcements</div>

<div class="group-tab-link" id="members-tab" onclick="members()" style="background-color: rgb(255, 255, 255); border-right: none;">Members</div>

<div class="group-tab-link" id="events-tab" onclick="" style="background-color: rgb(255, 255, 255); border-right: none; display: none !important;">Events</div>

<div class="group-tab-link" id="divisions-tab" onclick="" style="background-color: rgb(255, 255, 255); border-right: none; display: none !important;">Divisions</div>

<div style="height:15px;"></div>

<div class="content-box" style="padding:0;padding:15px;">

<div style="text-align:center;font-size:24px;color:#444444;"><? echo $getGroupM->rowCount(); ?></div>

<div style="text-align:center;font-size:16px;color;#666666;">Members</div>

<div style="height:15px;"></div>

<div style="text-align:center;font-size:24px;color:#A61;"><img src="https://media.discordapp.net/attachments/345988575143395328/1054578087142109294/latest.png" style="width: 9%; margin-right: 0.2rem;"><? echo"$gG->vault"; ?></div>

<div style="text-align:center;font-size:16px;color;#666666;">Vault</div>

</div>

</div>

<div class="col s12 m10 l9">

<div id="about" style="display: block;">

<style>
.card-0-2-28 {
    border: 1px solid #b2b2b2;
    padding: 4px;
    background: #e6e6e6;
}
body {
    background: #ffffff !important;
}
</style>

<div class="card-0-2-28">

<p class="fw-700 font-size-18 mb-2 lighten-2">About</p>

<div><? echo"$gG->description"; ?></div>

</div>

</div>

<div id="announcements" style="display:none;">

<div style="background:#0288d1;padding:10px 15px;font-size:20px;color:white;">Shout - 1/1/2000</div>

<div class="content-box" style="border-radius:0;border-top:0;padding:0;padding:15px;font-size:16px;">

Placeholder. (This feature is not out yet)
<br>
<br>
- <?=$sitename;?>

</div>

</div>



<div id="members" style="display: none;">

<div class="card-0-2-28">

<div class="row">

<div class="col s8"><p class="fw-700 font-size-18 mb-2 lighten-2">Members</p></div>

<div class="col s4">

<select class="browser-default market-dropdown" onchange="changeMembers(1, this.value)" style="float: right;">

<option value="1">Members</option>

</select>

</div>

</div>

<div id="members-area"><div class="row" style="margin-bottom:0;">

<? while($gG = $getGroup->fetch(PDO::FETCH_OBJ)){ 

$user = $handler->query("SELECT * FROM users WHERE id=" . $gG->userid);

$gU = $user->fetch(PDO::FETCH_OBJ)

?>

<div class="col s2 center-align" style="margin-top:15px;">



<img class="circle" src="https://media.discordapp.net/attachments/345988575143395328/1054550595337453698/bc1eedb52be3b4b94b11e77b2e2b6f1279028be02072f5ec24408157b23fdd6a_thumbnail.png" width="75" height="75">

<div style="padding-top:3px;">

<a href="/users/<? echo $gU->id ?>/profile" style="font-size:12px;"><? echo $gU->username ?></a>

</div>

</div>

<? } ?>

</div>

<style data-jss="" data-meta="Unthemed">
.button-0-2-54 {
  color: #777777;
  border: 1px solid #777777;
  margin: 0 auto;
  display: block;
  font-size: 15px;
  background: linear-gradient(0deg, rgba(224,224,224,1) 0%, rgba(255,255,255,1) 100%);
}
.button-0-2-54:hover {
  background: linear-gradient(0deg, rgba(203,216,255,1) 0%, rgba(255,255,255,1) 100%);
}
.col-0-2-55 {
  padding-left: 0;
  padding-right: 0;
}
</style>

<div style="height:25px;"></div>

<ul class="pagination center-align">

<button class="button-0-2-54">&#x25C4;</button>

<li class="active"><a>Page 1 of 1</a></li>

<button class="button-0-2-54">&#x25BA;</button>

</ul>

</div>

</div>

</div>



<div id="events" style="display:none;">

<div class="content-box">

<div class="header-text" style="font-size:18px;padding-bottom:15px;">Events</div>

<div>No events found.</div>

</div>

</div></div>



<div id="divisions" style="display: none;">

<div class="content-box">

<div class="header-text" style="font-size:18px;padding-bottom:15px;">Divisions</div>

<div>No divisions found.</div>

</div>

</div>



</div>

</div>

</div>

<? include "../../footer.php"; ?>