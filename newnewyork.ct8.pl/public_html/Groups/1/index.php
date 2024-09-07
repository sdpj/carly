<? include "../../header.php"; 
$getGroup = $handler->query("SELECT * FROM `groups` WHERE id='1'");
$gG = $getGroup->fetch(PDO::FETCH_OBJ);
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
<div class="col s12 m2 l2">
<select class="browser-default market-dropdown" name="type">
<option value="all">All</option>
<option value="business">Business</option>
<option value="war">War</option>
<option value="roleplay">Roleplay</option>
<option value="club">Club</option>
<option value="shop">Shop</option>
</select>
</div>
<div class="col s12 m10 l10">
<input type="text" class="general-textbar" placeholder="Search a group name" onchange="updateSearch(this.value)" name="query">
</div>
</div>
</form>
<div class="row">
<div class="col s12 m2 l3">
<div class="content-box" style="padding:0;padding:15px;">
<img src="https://storage.googleapis.com/bloxcity-file-storage/ffffcfa2fa232d589cc0b0db2a1783fc587881c58dbbc.png" class="responsive-img center-align" style="border:1px solid #DEDEDE;">
<div style="padding-top:3px;text-align:center;font-size:22px;word-wrap:break-word;"><? echo"$gG->title"; ?></div>
<div style="padding-top:3px;text-align:center;font-size:14px;">Owned by: <a><? echo"$gG->owner"; ?></a></div>
<div style="height:12px;"></div>
<div class="center-align"><form action="" method="POST"><input type="submit" name="JoinGroup" class="groups-green-button center-align" value="Join Group"><input type="hidden" name="csrf_token" value="VoCrOP9owOTkoCXLNxpR5AkeGaiTYAhk1xH1Bjyivso="></form></div>
</div>
<div style="height:15px;"></div>
<div class="group-tab-link" id="about-tab" onclick="about()" style="background-color: rgb(250, 250, 250); border-right: 5px solid rgb(2, 136, 209);">About</div>
<div class="group-tab-link" id="announcements-tab" onclick="announcements()" style="background-color: rgb(255, 255, 255); border-right: none;">Announcements</div>
<div class="group-tab-link" id="members-tab" onclick="members()" style="background-color: rgb(255, 255, 255); border-right: none;">Members</div>
<div class="group-tab-link" id="events-tab" onclick="events()" style="background-color: rgb(255, 255, 255); border-right: none;">Events</div>
<div class="group-tab-link" id="divisions-tab" onclick="divisions()" style="background-color: rgb(255, 255, 255); border-right: none;">Divisions</div>
<div style="height:15px;"></div>
<div class="content-box" style="padding:0;padding:15px;">
<div style="text-align:center;font-size:24px;color:#444444;"><? echo"$gG->members"; ?></div>
<div style="text-align:center;font-size:16px;color;#666666;">Members</div>
<div style="height:15px;"></div>
<div style="text-align:center;font-size:24px;color:#15BF6B;"><? echo"$gG->vault"; ?></div>
<div style="text-align:center;font-size:16px;color;#666666;">Vault</div>
</div>
</div>
<div class="col s12 m10 l9">
<div id="about" style="display: block;">
<div class="content-box">
<div class="header-text" style="font-size:18px;padding-bottom:15px;">About</div>
<div><? echo"$gG->description"; ?></div>
</div>
</div>
<div id="announcements" style="display:none;">
<div style="background:#0288d1;padding:10px 15px;font-size:20px;color:white;">This feature</div>
<div class="content-box" style="border-radius:0;border-top:0;padding:0;padding:15px;font-size:16px;">
Is coming soon.
</div>
</div>
<div id="members" style="display:none;">
<div class="content-box">
<div class="row">
<div class="col s8"><div class="header-text" style="font-size:18px;margin-top:8px;">Members</div></div>
<div class="col s4">
<select class="browser-default market-dropdown" onchange="changeMembers(1, this.value)">
<option value="1">User (0)</option>
<option value="2">Administrator (0)</option>
<option value="3">Management (0)</option>
<option value="100">Owner (1)</option>
</select>
</div>
</div>
<div id="members-area"><div class="row" style="margin-bottom:0;">
<div class="col s2 center-align" style="margin-top:15px;">
<a href="#"><img src="https://storage.googleapis.com/bloxcity-file-storage/44338c599c8178f8198f4d34d6566ac6588e806a71d7a.png" class="responsive-img"></a>
<div style="padding-top:3px;">
<div class="clearfix"></div></div>
<div style="height:25px;"></div>
<ul class="pagination center-align">
<li class="disabled"><a onclick="changeMembers(0, 1)"><i class="material-icons">chevron_left</i></a></li>
<li class="active"><a style="cursor:pointer;" onclick="changeMembers(1, 1)">1</a></li><li class="waves-effect"><a style="cursor:pointer;" onclick="changeMembers(2, 1)">2</a></li><li class="waves-effect"><a style="cursor:pointer;" onclick="changeMembers(3, 1)">3</a></li><li class="waves-effect"><a style="cursor:pointer;" onclick="changeMembers(4, 1)">4</a></li><li class="waves-effect"><a style="cursor:pointer;" onclick="changeMembers(5, 1)">5</a></li><li class="waves-effect"><a style="cursor:pointer;" onclick="changeMembers(6, 1)">6</a></li>
<li class="waves-effect"><a onclick="changeMembers(2, 1)"><i class="material-icons">chevron_right</i></a></li>
</ul>
</div>
</div>
</div>
<div id="events" style="display:none;">
<div class="content-box">
<div class="header-text" style="font-size:18px;padding-bottom:15px;">Events</div>
<div>No events found.</div>
</div>
</div>
<div id="divisions" style="display:none;">
<div class="content-box">
<div class="header-text" style="font-size:18px;padding-bottom:15px;">Divisions</div>
<div class="row">
<div class="col s2 center-align" style="padding-top:15px;">
<a href="https://www.bloxcity.com/groups/group.php?id=2"><img src="https://storage.googleapis.com/bloxcity-file-storage/796c9c7d5e1c5690f93fd1e3a98adc66587e0300ddff4.png" style="width:100px;height:100px;"></a>
<a href="https://www.bloxcity.com/groups/group.php?id=2"><div style="color:#666666;font-size:14px;word-wrap:break-word;">Test group</div></a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<? include "../../footer.php"; ?>