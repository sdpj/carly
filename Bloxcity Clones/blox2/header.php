<?php
ob_start();
include($_SERVER['DOCUMENT_ROOT'].'/core/config.php');
//eval(base64_decode("aW5jbHVkZSgkX1NFUlZFUlsnRE9DVU1FTlRfUk9PVCddLicvb2JmdXNjYXRpb24vb2JmdXNjYXRvci5waHAnKTs="));

/*
if(gethostname() != "bp.bricked.nl"){
    die("Unauthorized access!");
}
*/

/*
$file = "/home/bprewritten/freelance/index.php";
//echo $file;
if(is_file($file)) {
} else {
  die("Unauthorized access! Personal usage.");
}
*/

/*
-----------------------------------------------------------------------------------------------------------

Thank you for being a part of Bricked.
______________________________                      .__  __    __                                    __   
\______   \______   \______   \ ______  _  _________|__|/  |__/  |_  ____   ____        ____   _____/  |_ 
 |    |  _/|     ___/|       _// __ \ \/ \/ /\_  __ \  \   __\   __\/ __ \ /    \      /    \_/ __ \   __\
 |    |   \|    |    |    |   \  ___/\     /  |  | \/  ||  |  |  | \  ___/|   |  \    |   |  \  ___/|  |  
 |______  /|____|    |____|_  /\___  >\/\_/   |__|  |__||__|  |__|  \___  >___|  / /\ |___|  /\___  >__|  
		\/                  \/     \/                                   \/     \/  \/      \/     \/      
		
PLEASE NOTE: bricked.nl is a proprietary source.
Using this without permission may result in a DMCA or C&D, with the possibility of a lawsuit.
This source is heavily obfuscated. It is unlikely you will get much out of hosting this regardless.

-----------------------------------------------------------------------------------------------------------

For developers,

here are the necessary locations.

 -VueJS headers are located in /html/header.php
 -VueJS scripts are located before </html> at /html/footer.php
 -DB connection is in /core/db.php
 -Configuration file is in /core/config.php

here is necessary information.

 -the directory /testings includes various website tests. you may test in this directory before uploading something
in fact it is recommended to do so.
 -please use VueJS to load HTML as this loads the site faster.
 -ask questions if you are unsure of something.

Here is some ASCII art-

             =iTTI=i===:===+::=:;;::,;.   .;;:;;;;,:;==+;===;;==+=+, -Tim Park
            ;=ITTT=====+:===;)+==+=+=++:::;++=+====I+:;;++=+=+++ii+:;
            +I)I==+++==;,III=================:+===TITTT=:+;:====IIi;+
             ::I=;;;;+;+=========+==+:::++::==========++i=:.===+T==:+
          ;:)i)+;+;;+=======i===ITT):;;,;:;:,,;===IL==TTT+:=;,;;;;:.:
          ;II++,+;+:=:,i)===T===TTI,;=;:;:.:,:,=IITTI)TTTT=,=;;;;,II=+
 |       ;+)I==::+:=:=)TTT)ITT==LT);::,\:/,:;,:iI=L=iTTTi==);=::+=i)I;
 |__una  ;))++===:==+)TLTLTLL=LI)==)~        ~:=+=+=,=iT====+;+.=+:;):+
          ;==++;,=:=iI=I=i=T===:===)         ;;;.:,.:,+);===+:==,;=I=:
 (Human   ;;;+;;;=;;=======)==;:=;,: /|    |\,::'::..:,;;:++:++=:::+:
  Form:     :;;:;;;;===+:===++ :;:.:| `---'  |:`  :. +.,::;;;::=.;::+
 S Movie)    ;:,:;;;;;;,==:,i  :`':  `-____-' ':  `:    ,:,,;;;::;::+
            ;+=;;;;.::,;;;;'---'-_             -~~~-_   =);:;;;.,.:==++::,
         L;;==+===,.,::::;-~.----.             _.--_ ~- I=:;:;+=iII+==iTTTTIi;
 Ii=ii==;;======+,+.,:::; ,' ##@@ \           / @@# ~-+ |+:;:;==ITTT===TLLLLLT
;;;;:++===Ii===;==.;:._|  | ###  # |         | #  ##  ||T:+;;:===TLLT==)LLLLLL
========TLL)=====,++;| -| : ##@  # |         | #  ## |'|--.++=TL:=)LLLLLLLTLLL
=i==iLLLL)IIL::;:==:;|~\|  \ #### /    |      \ ###  | |  |+==TT:i=LLLLLLLLLLL
TLLLLLLLT=i=)T)==:==+|| `|  ~~~~~~     L       `----' |' ||)+=IT;==)T)T=))LLLT
LLLTLLLIILTLL==:;====`   |                            | //'++==TI:==i========L
LLLII)ILLL)==;=====+;+\o `|           ----           |' /'+:;===II+===========
=i=+:I)L)===;====;;;+;;`\ `|          `--'          .'o/';;;;;====T::=========
=====TT===:====;;+;;;+;|,`-+\                     .'++|;;;+;+;+======+,+======
==;==)====;=+=+;;;;;+;;|;++++`-_                .'++++|:;;;;;;;:==+==++;:===+=
=::=)====;===;;;;+;++;(_):.;++++`-_          _-';i;+;(_);;;;;+;;;+======;;;===
+.+=====+;;;=;;;;++;;+;;.:;;;;+;+;|`-_    _-'|):;;;+;,;);;;;;;;;;;;;+====+;;.+
;:======;;;.+;+;;;+++;+;;;;++;+;++|iii`--'iii|=;;;;;;;;;;;;+;;:;;;;;;;;===;;+.
;.;+====;;;;;,:;;+;+;+;+.---.+;+++|iiiiiiiiii|+;;;;;;;;;;;;:;;;;;:;;;;;;;+;;;;
;::;;;==+;;;;;;,;;;;;;;|     `-.++|iiiiiiiiii|+ ______;;;;;;:;;;:;;;;;;;;;;:;;
+;.;+:;;+;;++;;::++;;+|'_.-----._~~--__ii__----'      |;;;;:;;;;;;;;;;;;;;;;;,
+;:;;;;;;;;;;;;;,;;;;+`--------------/.()_____.------.|:;;;:;;;;;;;;;;;;;;;;,;
+=;;;;;;;;;+;;;::;;+;+;=)=ii+;ii___/  |+=-------------',;;;;;;;:;;;;;;;;;;,.:;
+=:;;;==;;;;;;+;___----------~~~i/'  |'i\   \iii~~--.__;;;;;;;;;;;;;;;;;;:;;;;
+;,;;===___.--~~    ||      . i/'   |'iii\   `\ii.     ||~~~---___;;;;;;:;=+;;
::====./           /++\_.-.__/'    |' ``''\    `\.   __|`|        \._;;;:===;=
=====/        __.--:;+,,,::..`-_   |_______\  ./'__--+:;+++----_     \;:======
====|        /++,;,,,+=.,:++===+-_|HHHHHHHHH\/HH|===+,+,+:..++;;-     \:+=====
===|'       |++++;;   ,,,,,,+==|HHHHHHHHHHHHHHHH|....:...   ;.,==\_    |+=====
===|        |,....:,.:,++,.----'HHHHHHHHHHHHHHH.H|..,,,,...:.+++:::|   `|;====
++|'      ii`,,.+i..,,___/TTTTHHHHHHHHHHHHHHHHHHH`-_---___-_..,++__|    |;====
=+|      iii)\ _+;..-'TTTTTTTTHH.HHHHHHHHHHHHH.HHHHHTTTTTTTT|../iiii    |=====
+|'      iiii|'T`-'TTTTTTTTTTTTHH.HHTTTTTTTTTTTTTHHHTTTTTTTT`-|iiiii    `|;.:+
+|       iiii|TTTTTTTTTTTTTTTTTTHTTTTTTTTTTTT.TTTTTTTTTTTTTTTT|iiiii     |+=;=
|'      iiiiii\TTTTTTTTTTTTTTTTTTT.TTTTTTTTT.TTTTTTTTTTTTTTTT/iiiiii     |:===
        iiiiiii\TTTTTTTTTTTTTTTTTTTHHHHHHHHHHHHTTTTTTTTTTTTT/iiiiiii     `|===
       iiiiiiii|`\TTTTTTTTTTTTTTHHHH.HHHHHH.HHHHHHHTTTTTTT/'|iiiiiiii     |:==
       iiiiiii|':+~\TTTTTTTTTTHHHHHHHHHHHHHHHHHHHHHHHTTT/';+`|iiiiiii     |,++
      iiiiiiii|:;++|TTTTTTTTTHHHHHHHH.HHHH.HHHHHHHHHHHHT|+,;;|iiiiiii     |:+=
      iiiiiii|'++++`|TTTTTTTTHHHHHHHHHHHHHHHHHHHHHHHHHHH|:;+;`|iiiiii     `|:+
     iiiiiii|';+++++`|TTTTTTTHHHHHHHHHH.HHHHHHHHHHHHHHH|'+;;;;|iiiiiii     |;;
     iiiiii|'++;;+;++`|TTTTTTHHHHHH_------_HHHHHHHHHHH|'++;;;;`|iiiiii     |i;
    iiiiii|';+;;;;+;++`|TTTTTTHHH.-    _---=HHHHHHHHH|';++;;;;;`|iiiii     `|;
    iiiii|';+;;;+;;;;++`|TTTTTHH:    .'HHHHHHHHHHHHH|':;;;;;;;;;|iiiii      |;
   iiiiii|:+;;;;;;;;++++|TTTTTHH|    |HHHHHHHHHHHHH.|;++;;++;;;;`|iiiii     |,
   iiiii|'+;+;+;./~\_/~~`|TTTTHH:    `\HHHHH.HHHHHH|\__/~\;+;;;;;|iiiii     |+
  iiiii|';+;___/:;;:;;;;+|TTTTTH`\     ~---=/HHHHHH|:;;;;:\__;;;;`|iiii     `|
  iiii|':;;/+++++,,,,..,,|ITTTTTHH~-.____-~~HHHHHHH|,,....++;~-.;;|iiiii
 iiii|':;;/,,.,.,,,.,,..|IITTTTTHHHHHHHHHHHHHHHHHHHH|,,,++.....|;;`|iiiii

                          ...                             |     |    |   |
    -`''-  _        ..########o...                       |     |    |   |
 _.'     `: \     ,##8#########8##o,,     (      (       `|    |    |   |
/ :  ___,-+-'   .#######8##8###8###8##,    )ailor )aturn  |    |    |   |
`-+-'     ;   ,#8###########8#8########,,                 `|   `|   |   `|
   `-...-'   :#88####8##8###########8###.,                 |    |  |'    |
            .HXX8X88X#8XX########XX8X8XX#;,                `|   |  |     |
           ,#O#X8888#88###########X####8X8,         _       `|  `\/'   ,/
          :8##88##X######8#8######X######8#:      _| |__     `|      ,/
         .######8##8####8)#)#(i#88####8####.:    |_   __|     `|    /
       .,#88##8#88###H8I~-_  _-~8+8##8####8#,:     | |___    __.----._
      :=#X##8#######,# ~-._()_.-~ ##########.,:    |  __ \   L__    __|
    .:I8##88####88#:;_--__    __--_,:#88#####),:   | |  \ |     |--|
   .:=8#XX#####88#LH =#O#\    /O##\i)##8######+:   | |  | \__  |'  `|
 .':###X888###8#8#O) \##@/    \##=/#H8###8####.,:  |_|  `\___| `|--|'
.':#####8####888L;;I,       |      #8###8##8###,.,              |  |
:.88Li######8#888#,H.     .__,    :8##88#####8##o:             |'  `|
:88X:##88##8##8#8##O8,           _8###########8#.8.           .|    |
8X#+#888#8##8#8#H.###8#,_      _-'8##=#####88#XX,o:           | \__/  _
X#..8#8##8##8888..8##8#8#-.__.-X#88##=8#####8#8#.,;           `.|__|-' |
'   HH8###;##8##,+888#L#|__  __|##88##;8###8##X'               ||(__- |'
_____                   |__()__|                _____          .|.:@#/_
\    `---.________.-----'      `-----._____.---'    /          ||._--' |
 \           oOOOOOOOOOOo__      ___oOOOOOOOOo    _/          | |(_----|
  \_.--_        oOOOOOOOOo -   --   oOOOOOOo __.-'            | |(_--__)
 _-:_-'           oOOOOOOOo        oOOOOOOo    `-_            | |.:(__ )
<::<_      _        oOOOOOOo       oOOOOo |       -_          `||.:@#_/
 ~-_:-__.-':'      xXXXxoOOOo ,|, oOOOoxXXXx _______\         |||.:@#|
    -_|    |        xXXXXXXXXx\|/.xXXXXXXXx  \ \             / `|.:@#|
      |   |'   _-.  xXXXXXxx--=O=--xxXXXXx|___| \           /  .|.:@#|
      |   |__-':/    xXXxxXXx'/|\`.XXxxxXX:.  '  \        ./  .:|.:@#|
      |     :::||    xxxXXXXx.'|`.xXXXXXxxx::.    \      /   .::|.:@#|
      |     :::||_  xxXXXXXXXx/'\_xXXXXXXXXx::.    \    /   .::/|.:@#|
      |    :::|' \`--xXXXXXXXx     xXXXXXx  \::.    \  /   .::/ |.:@#|
      |    :::|   \   xXXXXXX      xXXXx     \::.   /\/   .::/  |.:@#|
      |    ::|xx   \    xXx         xx        \::. /oO|  .::/   |.:@#|
     |'   .::|XXXXxx|    `          '|   xxxxx \::/OoOO\.::/    |.:@#|
     |    ::|XXXXXXX|                |xXXXXXx   \|oOOooOOOOo    |.:@#|
 ,-__|__ .::|XXXXXX/__              |_XXXXXx      OoooOoooooo   |.:@#|
 \ooooOOo::|XXXXXX/__ \,            | \XXXx       oOOOooOOOO    |.:@#|
  \OOOoooooo|XxoOOOo.\. \          / ./oOOoXXXXXx   oOOOoooo    |.:@#|
   |OOOOOOOO|oOOOOOOOo.\ \,       / /oOOOOOOoXXx       oOOo.    |.:@#|
   |oooooooo|OOOOOOOOOOo.\ \     / /oOOOOOOOOOOOo [ -Tim Park ] |.:@#|

------------------------------------------------
Thank you for visiting https://asciiart.website/
This ASCII pic can be found at
https://asciiart.website/index.php?art=anime%20and%20manga/sailor%20moon

*/

/*

echo'<h1 style="color: red;">Critical Server Errors</h1>
<h3>One or more server errors have been detected on BPRewritten.</h3>
<hr>';

if($_SERVER['SERVER_ADDR'] != "127.0.0.1"){
	echo"<h1>Server Error!</h1>
	Unable to resolve hash check. Authentication failure. Error code: 000<br>
	<b>BPRewritten</b>";
}
if($_SERVER['SERVER_ADDR'] != "localhost"){
	echo"<h1>Server Error!</h1>
	Unable to resolve hash check. Authentication failure. Error code: 001<br>
	<b>BPRewritten</b>";
}
echo"<h1>Server Error!</h1>
<h2>Incorrect data hashes</h2>
	Unable to resolve hash check through database. Authentication failure. Error code: 003<br>
	<b>BPRewritten</b>";

echo"<h1>Server Error!</h1>
<h2>Failure to verify file hash handshake</h2>
	Unable to resolve remote hash handshake from server. Authentication failure. Error code: 004<br>
	<b>BPRewritten</b>";

die();

*/

include($_SERVER['DOCUMENT_ROOT'].'/core/classes/profanityFilter.php');

if($loggedIn){
    $banSel = $db->prepare("SELECT * FROM `bans` WHERE `userID` = :uIDD");
    $banSel->bindParam(":uIDD", $user->id, PDO::PARAM_INT);
    $banSel->execute();

$ban = $banSel->fetch(PDO::FETCH_OBJ);

if(!isset($bannedPage)){
    if($bannedPage != "true"){

if($ban){
    echo"<script>window.location.replace('/account/banned.php');</script>";
}

}

  }
}
?>

<html prefix="og: http://ogp.me/ns#" lang="en">
<head>
<?php
if(isset($title)){
?>
<title><?=$title?> - Bricked</title>
<?php
}else{
?>
<title>Bricked</title>
<?php
}
?>
<link rel="icon" type="image/png" href="https://cdn.bricked.nl/storage/img/brickedicon.png">
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
if(isset($metaDesc)){
?>
<meta name="description" content="Bricked is an online social gaming platform. Build and script games, trade in an active market, and play with many users!">
<?php
}else{
?>
<meta name="description" content="Bricked is an online social gaming platform. Build and script games, trade in an active market, and play with many users!">
<?php
}
?>
<meta name="keywords" value="brickplanet, brick planet, bprewritten, bricked, bricked.nl">
<meta name="author" content="Bricked">
<meta property="og:image" content="https://cdn.bricked.nl/storage/img/brickedicon.png" />

<meta name="csrf-token" content="a69c2c95a779b5bc651583e229170f6112047b4d">

<link rel="stylesheet" href="/storage/css/bpr.css?r=<?=rand()?>">
<link rel="stylesheet" href="/storage/css/foundation.css?r=<?=rand()?>">
<link rel="stylesheet" href="/storage/css/main.css?r=<?=rand()?>">

<style>
/* Core BPR styles */

<?php
/*
			--main-background-color: #262729;
			--main-sidebar-color: #2c2f35;
			--main-top-color: #2c2f35;
	--main-background-color: #212222;
    --main-sidebar-color: #272828;
    --main-top-color: #272828;
*/
?>

body{
    /*overflow-x: hidden !important;*/
}
:root{
    		--primary-txt-color: #E1E4EB;
			--main-background-color: #232529;
			--main-sidebar-color: #25272b;
			--sidebar-active: #1e2023;
			--main-top-color: #25272b;
			--top-bar-search: #33363c;
			--top-bar-search-focus: #40434a;
			--shadow-primary: #131313;
			--container-bg: #2c3038;
			--footer-bg: #2c3038b3;
			--astro-txt: #ae73e4;
}
/*img::before { content: "loading…" }*/

[v-cloak] > * { display:none }
[v-cloak]::before { content: "loading…" }

	</style>
<link rel="stylesheet" href="/storage/css/dark-style.css?r=<?=rand()?>">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.6.1/js/foundation.min.js"></script>
<script src="/storage/js/new.js"></script>

<meta class="foundation-mq">

<!-- VueJS -->
<!--dev-->
<!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
<!--production-->
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>
<body>

<div class="site-wrap">
<div class="top-bar">
<div class="top-bar-left">
<div class="grid-x align-middle grid-margin-x">
<div class="shrink cell hide-for-large">
<button class="menu-icon sidebar-menu-icon" type="button" data-toggle="side-bar" aria-controls="side-bar"></button>
</div>
<div class="shrink cell menu-logo">
<a href="/">
<img src="https://cdn.bricked.nl/storage/img/BRICKEDLogo.png" class="show-for-large" width="175" height="18">
<img src="https://cdn.bricked.nl/storage/img/brickedicon.png" class="hide-for-large" style="height:32px;">
</a>
</div>
<div class="auto cell no-margin">
<input type="text" class="menu-search" id="menu-search" placeholder="Search" onkeyup="searchSite(this.value)">
<div class="search-dropdown-parent">
<div id="search-dropdown" class="search-dropdown fast" data-toggler="u32dn2-toggler" data-animate="fade-in fade-out" style="display:none;z-index: 100;" aria-expanded="false">
<div id="show-recent">
<div style="padding:5px 15px;">Search by username, games, store items, and communities</div>
</div>
<div id="search-dropdown-content"></div>
</div>
</div>
</div>
<?php
if($loggedIn){
$seen = time();
$setseen = $db->prepare("UPDATE `users` SET lastseen = ". $seen . " WHERE `id` = :ID");
$setseen->bindParam(":ID", $user->id, PDO::PARAM_INT);
$setseen->execute();
?>
<div class="shrink cell">
<ul class="menu align-middle">

								<li class="menu-link show-for-medium">
									<a data-toggle="user-notifications">
										<span class="icon relative">
											<i class="material-icons">notifications_none</i>
									<?php
								
									$notificationSel = $db->prepare("SELECT * FROM `notifications` WHERE `userID` = :userIDD");
									$notificationSel->bindParam(":userIDD", $user->id, PDO::PARAM_INT);
									$notificationSel->execute();
									
									$notifications = $notificationSel->fetch(PDO::FETCH_OBJ);
									
									if(!$notifications || !isset($notifications)){
									   
									}else{
									    ?>
											<div class="notification-badge badge-header" id="notifications-count">1</div>
								    <?php
									}
									?>
												<div class="notification-badge badge-header" id="notifications-count" style="display:none;">0</div>
										</span>
									</a>
								</li>
								<li class="menu-link">
									<a :id="userCurrency" title="<?=$user->credits?> Credits" href="/upgrade/credits">
										<span class="icon">
										<img src="/storage/img/credits-sm.png" width="20"></span>
										<span id="userCurrency" class="show-for-medium">{{ credits }}</span>
										<span id="userCurrency" class="show-for-small-only"><?=$user->credits?></span>
									</a>
								</li>
								<li class="menu-link">
									<a :id="user" title="<?=$user->bits?> Bits" href="/upgrade/bits">
										<span class="icon">
										    <img src="/storage/img/bits-sm.png" width="20">
										</span>
										<span id="user" class="show-for-medium">{{ bits }}</span>
										<span id="user" class="show-for-small-only"><?=$user->bits?></span>
									</a>
								</li>
								<li class="menu-link avatar-preview">
									<a data-toggle="user-dropdown-all"><div class="menu-avatar-preview-thumbnail" style="background-image:url(https://cdn.bricked.nl/storage/avatars/thumb/<?=$user->id?>.png?r=<?=rand()?>);background-size:50px;background-position:45% 0%;-webkit-transform: scaleX(-1);-khtml-transform: scaleX(-1);-moz-transform: scaleX(-1);-ms-transform: scaleX(-1);-o-transform: scaleX(-1);transform: scaleX(-1);"></div></a>
								</li>
			<!-- User Dropdown -->
			<div id="user-dropdown-all" data-toggler data-animate="fade-in fade-out" style="display:none;z-index: 100;" class="fast">
				<i class="material-icons user-dropdown-arrow">arrow_drop_up</i>
				<div class="user-dropdown" id="user-dropdown">
					<div class="dropdown-header">
						<div class="grid-x align-middle grid-margin-x">
							<div class="shrink cell no-margin">
								<div class="avatar-preview-thumbnail" style="background-image:url(https://cdn.bricked.nl/storage/avatars/thumb/<?=$user->id?>.png?r=<?=rand()?>);background-size:40px;background-position:45% 0%;-webkit-transform: scaleX(-1);-khtml-transform: scaleX(-1);-moz-transform: scaleX(-1);-ms-transform: scaleX(-1);-o-transform: scaleX(-1);transform: scaleX(-1);"></div>
							</div>
							<div class="auto cell">
								<div class="dropdown-username">
								    <a id="name" href="#">{{ name }}</a>
								</div>
							</div>
						</div>
					</div>
					<div class="dropdown-body">
						<ul>
							<li><a href="/profile.php?id=<?=$user->id?>">Profile</a></li>
							<li><a href="/account/character/">Character</a></li>
							<li><a href="/account/keys/">Invite Keys</a></li>
						</ul>
						<div class="ddivider"></div>
						<ul>
							<li><a href="/account/settings/">Settings</a></li>
							<li><a href="/account/logout.php">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div id="user-notifications" data-toggler data-animate="fade-in fade-out" style="display:none;z-index: 100;" class="fast">
				<i class="material-icons user-notifications-arrow">arrow_drop_up</i>
				<div class="user-notifications">
					<div class="user-notifications-header">
						<div class="grid-x grid-margin-x align-middle">
							<div class="auto cell no-margin">
								Notifications
							</div>
							<div class="shrink cell no-margin right">
								<a href="/inbox/notifications">See All</a>
							</div>
						</div>
					</div>
					<div class="user-chat-row-divider"></div>
					<div id="user-notifications-html">

							<div class="user-notifications-none">
								<i class="material-icons">notifications_none</i>
								<span>You have no unread notifications.</span>
							</div>

					</div>
					<div class="push-5"></div>
				</div>
			</div>
<?php
}else{
?>
<div class="shrink cell">
<ul class="menu align-middle">
<li class="menu-login show-for-medium">
<div class="menu-log-in">
<a href="/account/login">Log In</a>
</div>
</li>
<li class="menu-createaccount show-for-medium">
<div class="menu-create-account">
<a href="/account/register">Join Now</a>
</div>
</li>
<?php
}
?>
</ul>
</div>
</div>
</div>
</div>
<div class="top-bar-push"></div>
<div class="grid-x grid-margin-x">
<div class="sidebar-shrink shrink cell no-margin">
<div class="side-bar" data-toggler="ox1nso-toggler" data-animate="fade-in fade-out" id="side-bar" aria-expanded="true">
<div class="side-bar-inner">
<?php
if(!$loggedIn){
?>
<ul class="hide-for-medium">
<li>
<a href="/account/login">
<i class="material-icons">person</i>
<span>Log In</span>
</a>
</li>
<li>
<a href="/account/register">
<i class="material-icons">person_add</i>
<span>Create Account</span>
</a>
</li>
</ul>
<?php
}
?>
<div class="sbdivider hide-for-medium"></div>
<ul>
<?php
if($loggedIn){
    $redirect = '/account/home';
}else{
    $redirect = '/';
}
?>
<li>
<a href="<?=$redirect?>">
<i class="material-icons">home</i>
<span>Home</span>
</a>
</li>
<li>
<a href="/games">
<i class="material-icons">public</i>
<span>Worlds</span>
</a>
</li>
<li>
<a href="/store">
<i class="material-icons">store</i>
<span>Store</span>
</a>
</li>
<li>
<a href="/users">
<i class="material-icons">group</i>
<span>Users</span>
</a>
</li>
<li>
<a href="/communities">
<i class="material-icons">language</i>
<span>Communities</span>
</a>
</li>
<li>
<a href="/forum">
<i class="material-icons">forum</i>
<span>Forum</span>
</a>
</li>
<li>
<a href="/chat">
<i class="material-icons">chat</i>
<span>Chat</span>
</a>
</li>
<li>
<a href="/leaderboard">
<i class="material-icons">format_list_numbered</i>
<span>Leaderboard</span>
</a>
</li>
<li>
<a href="/upgrade">
<i class="material-icons">add_circle</i>
<span>Upgrade</span>
</a>
</li>
<br>
<?php
if($loggedIn){
?>
<li>
<a href="/develop">
<i class="material-icons">build</i>
<span>Develop</span>
</a>
</li>
<li>
<a href="/account/character">
<i class="material-icons">person_outline</i>
<span>Avatar</span>
</a>
</li>
<li>
<a href="/wager">
<i class="material-icons">casino</i>
<span>Wager</span>
</a>
</li>
<li>
<li>
<a href="/account/keys">
<i class="material-icons">vpn_key</i>
<span>Invite Keys</span>
</a>
</li>
<li>
<a href="/mail">
<i class="material-icons">mail</i>
<span>Inbox</span>
</a>
</li>
<li>
<a href="/friends/index.php?id=<?=$user->id?>">
<i class="material-icons">person_add</i>
<span>Friends</span>
</a>
</li>
<li>
<a href="/trades">
<i class="material-icons">swap_horiz</i>
<span>Trades</span>
</a>
</li>
<?php
}
?>
<?php
if($loggedIn){
    
if($user->power >= 1){
?>
<br>
<li>
<a href="/admin">
<i class="material-icons">gavel</i>
<span>Admin</span>
</a>
</li>
<?php
}
}
?>
<li>
<a href="/merch">
<i class="material-icons">store</i>
<span>Merchandise</span>
</a>
</li>

</ul>
</div>
</div>
</div>


<div class="auto cell no-margin">
<div class="grid-container site-container-margin">

<?php
include($_SERVER['DOCUMENT_ROOT'].'/html/alerts.php');
?>

<div class="main-site-push"></div>

<div id="app">