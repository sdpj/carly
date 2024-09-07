<?	

# FORUM MOD ICON FOR WORLD2BUILD NEWS SECTION (JUST INCASE YOU NEED IT) 
#<img src='../Badgess/Forum Moderator.png' height='75' width='75' style='vertical-align:middle;margin-right:5px;'>				
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	if(!$User){
		header("Location: /Landing/Animated/");
		die();
	}
	echo"
	<!DOCTYPE html>
	<h1>My Friends</h1>
	
	
	
		
		
		
			<div class='OutletNavigation'>
				Friends
			</div>
			<div class='divider-bottom' style='clear:both;'>
	";
	
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>