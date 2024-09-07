<?php
	include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/connect.php' );
	if(ISSET($_COOKIE['EPICNAME']) && ISSET($_COOKIE['EPICPASS'])){
		// Confirm Credentials, if fail destroy cookies and redirect to homepage
		$username = mysqli_real_escape_string($conn,$_COOKIE['EPICNAME']);
		$password = mysqli_real_escape_string($conn,$_COOKIE['EPICPASS']);

		$accountQ = mysqli_query($conn,"SELECT * FROM `ec_users` WHERE `USERNAME`='$username' AND `PASSWORD`='$password'");
		$account = mysqli_num_rows($accountQ);
		if($account > 0){
			// Get user values
			$user = mysqli_fetch_array($accountQ);
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/header.php' );
			// include( $_SERVER['DOCUMENT_ROOT'] . 'EpicClubRebootMisc\HTMLS\Dashboard.html' );
			// include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/header.php' );
			echo"
			<body";
					if($ishalloweentheme == 0){echo"";}else{echo" style='background-color:black;'";}
					echo">";
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/global.php' );
			if(isset($_POST['code'])){
			    $promo = mysqli_real_escape_string($conn, $_POST['code']);
			    $codeQ = mysqli_query($conn, "SELECT * FROM `promocodes` WHERE `CODE` = '$promo'");
			    $codeN = mysqli_num_rows($codeQ);
			    $code = mysqli_fetch_array($codeQ);
			    if($codeN>0){
			        if($code['ENABLED']=='TRUE'){
			            $hasRedeemedQ = mysqli_query($conn, "SELECT * FROM `promocode_redeems` WHERE `CODE` = '$code[ID]' AND `USER` = '$user[ID]'");
			            $hasRedeemed = mysqli_num_rows($hasRedeemedQ);
			            if($hasRedeemed==0){
    			            if($code['TYPE']=='CURRENCY'){
    			                $cc = $code['CURRENCY'];var_dump($cc);
    			                $ac = $user['GOLD'];var_dump($ac);
    			                $c = $cc + $ac;var_dump($c);
    			                $i = $code['ID'];var_dump($i);
    			                $a = $user['ID'];var_dump($a);
    			                $time = time();var_dump($time);
    			                mysqli_query($conn, "INSERT INTO `promocode_redeems` VALUES (NULL,'$i','$a','$time')");
    			                mysqli_query($conn, "UPDATE `ec_users` SET `GOLD` = '$c' WHERE `ID` = '$a'");
    			                echo"<script>window.alert('Promocode Redeemed! You Have Redeemed $cc Gold!');</script>";
			                    echo"<script>window.location='/Promocodes/';</script>";
    			            }elseif($code['TYPE']=='ITEM'){
    			                $id = $code['ITEM'];
    			                $ownedQ = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `ITEM_ID` = '$id' AND `USER_ID` = '$user[ID]'");
    			                $owned = mysqli_num_rows($ownedQ);
			                    if($owned==0){
			                        $itemQ = mysqli_query($conn, "SELECT * FROM `ec_items` WHERE `ID` = '$id'");
    			                    $itemN = mysqli_num_rows($itemQ);
    			                    if($itemN==0){
    			                        echo"<script>window.alert('Error 3');</script>";
        			                    echo"<script>window.location='/Promocodes/';</script>";
    			                    }else{
    			                        $time = time();
    			                        $item = mysqli_fetch_array($itemQ);
    			                        mysqli_query($conn, "INSERT INTO `promocode_redeems` VALUES (NULL,'$code[ID]','$user[ID]','$time')");
    			                        mysqli_query($conn, "INSERT INTO `ec_crate` VALUES (NULL,'$item[ID]','$user[ID]','0')");
    			                        echo"<script>window.alert('Promocode Redeemed! You Have Redeemed The $item[NAME] Item!');</script>";
        			                    echo"<script>window.location='/Promocodes/';</script>";
    			                    }
			                    }else{
			                        echo"<script>window.alert('You Already Own This Item!');</script>";
			                        $time = time();
			                        mysqli_query($conn, "INSERT INTO `promocode_redeems` VALUES (NULL,'$code[ID]','$user[ID]','$time')");
			                        echo"<script>window.location='/Promocodes/';</script>";
			                    }
    			            }else{
    			                echo"<script>window.alert('Error 2');</script>";
        			            echo"<script>window.location='/Promocodes/';</script>";
    			            }
			            }else{
			                echo"<script>window.alert('You Have Already Redeemed This Promocode!');</script>";
			                echo"<script>window.location='/Promocodes/';</script>";
			            }
			        }else{
			            echo"<script>window.alert('Promocode Has Expried!');</script>";
			            echo"<script>window.location='/Promocodes/';</script>";
			        }
			    }else{
			        echo"<script>window.alert('Promocode Doesn\'t Exist!')</script>";
			        echo"<script>window.location='/Promocodes/';</script>";
			    }
			}
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:";
					if($ishalloweentheme == 0){echo"#ddd";}else{echo"orange";}
					echo";border-radius:10px;padding:20px;'>
							<h1>Redeem A Promocode!";
                            if($user['POWER']=='ADMIN'||$user['POWER']=='FOUNDER'||$user['POWER']=='CO-FOUNDER'){
                                echo"<a href='/Promocodes/logs.php' class='fa fa-list-ul'></a>";
                            }echo"</h1>
							<form method='post' enctype='multipart/form-data'>
							    <input style='text-transform: uppercase;border:1px solid black;border-radius:5px;width:600px;padding:5px;margin-bottom:5px;";if($ishalloweentheme == 0){echo"";}else{echo"background-color:orange;";}echo"' placeholder='Promocode' name='code' required></input>
							    <button style='";if($ishalloweentheme == 0){echo"";}else{echo"background-color:orange;";}echo"'>Submit</button>
							</form>
						    <br><br>
						    <div style='border-top:1px dotted;'></div>
						    <h2>What are promocodes?</h2>
						    <p>Upon Redeeming a valid promocode, you will recieve a virtual item (or currency) that will be added to your Unitorium account. To redeem, enter the promocode in the box above and press submit.</p>
						    <p>Made by Lord ;)</p>
						</div>
					</div>
				</center>
			</body>";

		}else{
			setcookie('EPICPASS','',time() - 666, '/');
			setcookie('EPICNAME','',time() - 666, '/');
			header("Location: ../"); exit;
		}

	}else{
		echo"<script>window.location='/';</script>";
}
?>