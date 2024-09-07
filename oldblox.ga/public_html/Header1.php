<?php

	include($_SERVER['DOCUMENT_ROOT'].'/Global.php');

	?>
	<head>
		<link rel="stylesheet" href="http://avatar-gamer.ga/Base/Style/Main.css">
		<link rel="icon" type="image/png" href="http://avatar-gamer.ga/Badgess/Administrator.png">
	</head>
	<body>
	<?if($myU->Premium != "3" OR !$User){
		echo"
		<div class='site-header'>
			<div id='navigation-container'>
				<a href='http://avatar-gamer.ga/'>
					<img src='http://avatar-gamer.ga/Images/Avatar-Universe-logo.png' width='190' height='35' style='margin-bottom:2px;margin-right:15px;vertical-align:bottom;'>
				</a>
			</div>
		</div>
		";
	}
	elseif($myU->Premium == "3"){
		echo"
		<div class='site-header-prem'>
			<div id='navigation-container-prem'>
				<a href='http://avatar-gamer.ga/'>
					<img src='http://avatar-gamer.ga/Images/AvatarUniverse-prem.png' width='190' height='35' style='margin-bottom:2px;margin-right:15px;vertical-align:bottom;'>
				</a>
			</div>
		</div>
		";
	}?>
		<div id='MasterContainer'>
		<div id='bodywrapper'>
		<div id='Body' style='width:900px;'>
		<div style='padding-top:50px;'></div>
	</body>