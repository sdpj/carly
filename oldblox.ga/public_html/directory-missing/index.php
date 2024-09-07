<?
	include($_SERVER['DOCUMENT_ROOT'].'/Global.php');
	include($_SERVER['DOCUMENT_ROOT'].'/Header1.php');

	$code = SecurePost($_GET['code']);
	
	if(!$code){
		header("Location: http://avatar-gamer.ga/directory-missing/?code=404");
		die();
	}
	elseif($code == "404"){
		echo"
		<div class='error-page'>
			<div id='alertText'>
				The directory supplied was not found on this server
			</div>
		</div>
		";
	}
	elseif($code == "400"){
		header("Location: http://avatar-gamer.ga/directory-missing/?code=404");
		die();
	}
	elseif($code == "user-banned"){
		echo"
		<div class='error-page'>
			<div id='alertText'>
				The item you requested does not exist
			</div>
		</div>
		";
	}
	elseif($code == "unknown"){
		echo"
		<div class='error-page'>
			<div id='alertText'>
				An unexpected error occurred with your request
			</div>
		</div>
		";
	}
	elseif($code == "403"){
		echo"
		<div class='error-page'>
			<div id='alertText'>
				An access denied protocol was given with your last request
			</div>
		</div>
		";
	}
	else{
		header("Location: http://avatar-gamer.ga/directory-missing/?code=404");
		die();
	}
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>