<?php
include "Header.php";
$Setting = array(
	"PerPage" => 16
);
$PerPage = 12;
$Page = mysql_real_escape_string(strip_tags(stripslashes($_GET['Page'])));
if ($Page < 1) { $Page=1; }
if (!is_numeric($Page)) { $Page=1; }
$Minimum = ($Page - 1) * $Setting["PerPage"];
//query
$num = mysql_num_rows($allusers = mysql_query("SELECT * FROM Users WHERE PowerMegaModerator='true' AND $now < expireTime"));
$Num = ($Page+8);
			$OnlineNow = mysql_query("SELECT * FROM Users WHERE PowerMegaModerator='true' AND $now < expireTime LIMIT {$Minimum},  ". $Setting["PerPage"]);
			$NumOnline = mysql_num_rows($OnlineNow);
	echo "
	<div id='TopBar'>
	$num <b> Moderator(s) </b> Are Online
	</div>
	<div id='aB'>
	
	<table><tr>
		";
			$now = time();
			$counter = 0;

			while ($O = mysql_fetch_object($OnlineNow)) { 
				$counter++;
				echo "
				<td width='125'>
				<center>
				<a href='user.php?ID=$O->ID' style='border:0;' title='".$O->Username."'>";
					$height = 195; 
								$width = 100;
								echo "
						<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store//Dir/" . $O->Background . ");'>
						<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Dir/Avatar.png);'>
							<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $O->Eyes . ");'> 
								<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $O->Mouth . ");'>
									<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $O->Hair . ");'>
										<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $O->Bottom . ");'>
											<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $O->Top . ");'>
												<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $O->Hat . ");'>
													<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $O->Shoes . ");'>
														<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $O->Accessory . ");'>

														";
														if (time() < $gO->expireTime) {
														echo "<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(/Imagess/OnlineWatermark.png);'>";
														}
														if (time() < $gO->expireTime) {
														echo "</div>";
														}
														echo "
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
					";echo"
				<br />
				<smalltextlink>".$O->Username."</smalltextlink>
				</a>
				</td>
				";
				if ($counter >= 8) {
				
					echo "</tr><tr>";
					$counter = 0;
				
				}
			
			}
		
		echo "
		</tr></table><center>
	";
	
$amount=ceil($num / $Setting["PerPage"]);
if ($Page > 1) {
echo '<a href="modonline.php?Page='.($Page-1).'">Prev</a> - ';
}
echo 'Page '.$Page.' out of '.(ceil($num / $Setting["PerPage"]));
if ($Page < ($amount)) {
echo ' - <a href="modonline.php?Page='.($Page+1).'">Next</a>';
}
	
	echo "
	</div>
	";


include "Footer.php";
?>