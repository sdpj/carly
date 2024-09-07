<center>
<?php

	include "../EpicClubRebootMisc/header.php";
				echo
	$getStaff = mysql_query("SELECT * FROM ec_users WHERE FOUNDER OR CO-FOUNDER OR ADMIN OR MOD");
	
	while ($gS = mysql_fetch_object($getStaff)) {
	echo $gS->Username . "<br />";
	}
echo"
									<center>
										<div style='height:115px;'></div> <!-- SPACE -->
											<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
												<h1 style='text-align:left;padding-left:200px;'>Report $uInfo[1]</h1>
												<form method='post'>
												<input type='hidden' value='$uInfo[0]' name='id' maxlength='500' required>
												<textarea style='border:1px solid;width:500px;' name='reason' placeholder='Reason' required>Reason must be valid! Please add more detail!</textarea><Br>
												<button style='border-radius:0px;width:500px;'>Submit</button>
												</form>
											</div>
										</div>
									</center>
								</body>"; exit;
								}
?>
</center>