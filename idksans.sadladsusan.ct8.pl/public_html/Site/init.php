<?php
$sitename = "Raveway";
$company = "OnTopicGC";
$discord = "cdgWqNNmYR";
error_reporting(0);
session_start();
session_id();
ob_start();
date_default_timezone_set('America/New_York');
session_name('avatar-kittens');
$user = $_SESSION['username'];
$encrypt = $_SESSION['hash'];
$admin = $_SESSION['admin'];

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}


try {
	$handler = new PDO('mysql:host=mysql.ct8.pl;dbname=m32361_bcreate', 'm32361_bcreate', 'BCreate1#');
	$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

$conn = mysql_connect("mysql.ct8.pl", "m32361_bcreate", "BCreate1#");
mysql_select_db("m32361_bcreate");

$gettopics = $handler->query("SELECT * FROM topics");
$Banner = $handler->query("SELECT * FROM banner");
$gB = $Banner->fetch(PDO::FETCH_OBJ);
$User = $handler->query("SELECT * FROM users");
$usr = $User->fetch(PDO::FETCH_OBJ);
$maintenance = $handler->query("SELECT * FROM maintenance");
$mntnc = $maintenance->fetch(PDO::FETCH_OBJ);
$getipbans = $handler->query("SELECT * FROM ipbans WHERE ip='$ip'");
$ipban = ($getipbans->rowCount());
if ($ipban > 0) {
        header('HTTP/1.0 403 Forbidden');
	include($_SERVER['DOCUMENT_ROOT']."/Error/IPBanned.php");
	exit();
        die();
}
$handler->query("INSERT INTO iplogs (ip) VALUES('$ip')");

if ($user) {
$myusr = $handler->query("SELECT * FROM users WHERE username='".$user."'");
$myu = $myusr->fetch(PDO::FETCH_OBJ);
$userExist = ($myusr->rowCount());
if ($userExist == "0") {
session_destroy();
header("Location: ../");
}
$handler->query("UPDATE users SET ip='$ip' WHERE username='$myu->username'");
$checkDatabase = $handler->query("SELECT * FROM userips WHERE ip='$ip' AND id='$myu->id'");
$cii = ($checkDatabase->rowCount());
if ($cii == "0") {
$handler->query("INSERT INTO userips (id, ip) VALUES('$myu->id','$ip')");
}
if ($encrypt != $myu->password) {
session_destroy();
}
}

$now = time();
if ($now > $myu->getemeralds) {
$newemrlds = $now + 86400;
if ($myu->elite == 0) {
$amounttoadd = 15;
}
elseif ($myu->elite == 1) {
$amounttoadd = 50;
}
$handler->query("UPDATE users SET emeralds=emeralds + ".$amounttoadd." WHERE id='$myu->id'");
$handler->query("UPDATE users SET getemeralds='$newemrlds' WHERE id='$myu->id'");
}

$now = time();
$timeout = 5; 
$xp = 60;
$expires = $now + $timeout*$xp;
$handler->query("UPDATE users SET visittick='$now' WHERE username='$user'");
$handler->query("UPDATE users SET expiretime='$expires' WHERE username='$user'");


function relativetime($original = null) {
		//make sure we were given a time
		if($original) {
			//make sure date is a valid unix timestamp
			//http:stackoverflow.com/questions/2524680/check-whether-the-string-is-a-unix-timestamp#answer-2524761
			if((string) (int) $original !== $original) {
				//go ahead and convert it, just to be sure
				$original = date('U', strtotime($original));
			}
			
			//time periods
			$second = 1;					//1 second in Unix Time
			$minute = $second * 60;			//1 minut in Unix Time
			$hour = $minute * 60;			//1 hour in Unix Time
			$day = $hour * 24;				//1 day in Unix Time
			$week = $day * 7;				//1 week in Unix Time
			$month = $day * 30;				//1 month in Unix Time
			$year = $day * 365;				//1 year in Unix Time
			$decade = $year * 10;			//10 years in Unix Time
			$century = $decade * 10;		//100 years in Unix Time
			$millenium = $century * 10;		//1,000 years in Unix Time
			$today = time(); 				//current Unix Time

			//initialize vars to store our time and name
			$name = '';
			$total = 0;

			//get seconds since the date given to the function
			$since = $today - $original;
			
			//create array to store textual representation and Unix second representations
			$checks = array(
				array('second', $second),
				array('minute', $minute),
				array('hour', $hour),
				array('day', $day),
				array('week', $week),
				array('month', $month),
				array('year', $year),
				array('decade', $decade),
				array('century', $century),
				array('millenium', $millenium)
			);

			//iterate through checks to find the largest value for relative time display
			foreach($checks as $key => $check) {
				$seconds = $check[1];
				$count = floor($since / $seconds);
				//if we can't go any further, exit loop
				if($count < 1) {
					break;
				//if we can, update the name and the total
				} else {
					$name = $check[0];
					$total = $count;
				}
			}

			//begin creating our return value by adding total
			$return = $total;

			//if it's greater than 1
			if($total > 1) {
				//if this is millenia, change the pluralization accordingly
				if($name == 'millenium') {
					$return .= ' ' . 'millenia';
				//if this is centuries, change the pluralization accordingly
				} elseif($name == 'century') {
					$return .= ' ' . 'centuries';
				//otherwise just add an s
				} else {
					$return .= ' ' . $name . 's';
				}
			//if it isn't, just return the singular name
			} else {
				$return .= ' ' . $name;
			}

			//append 'ago' to the return string
			$return .= ' ago';

			//return time since
			return $return;
		} else {
			return "??? ago";
		}
	}

$handler->query("UPDATE threads SET bump = '".time()."' WHERE sticky = '1'"); // making sure stickies are always at the top - carlyy :D

if ($myu->Ban == "1" && $bannedcanview != "true") {
    
        header("Location: /Banned.php");
        die();
    
    }
?>