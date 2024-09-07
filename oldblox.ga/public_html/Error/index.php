<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header1.php');
	$code = SecurePost($_GET['code']);
	if($code == "404"){
		echo"
		<h2>The file or extension you requested does not exist</h2>
		";
	}elseif($code == "403"){
		echo"
		<h2>You do not have permission to view the file or directory supplied</h2>
		";
	}elseif($code == "500"){
		echo"
		<h2>An unexpected error occurred with your request</h2>
		";
	}else{
		header("Location: /Error/?code=404");
		die();
	}
		
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>	