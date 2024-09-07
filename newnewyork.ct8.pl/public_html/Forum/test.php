                                                                                                                                                                                                                                <?php
        $id = $_GET['id']; 
	
	$Topic = $Data->getRow("SELECT * FROM `topics` WHERE `id`='$id'");
	
	$Topic = Data::useRows($Topic);
	
	if($Topic->id == null){
		$Site->newPage("Topic not found.", "");
		die("The selected topic does not exist.");
	}
	                 	
       	if($Topic){                                           
		$Site->newPage("$Topic->name", "");
	}
	

	// if user is not logged in go to landing
	if(!User::loggedIn()) {
		$Site->redirect($Site->site_url . "/Landing");
	}
	
	$Threads = $Data->getRows("SELECT * FROM `threads` WHERE `topic`='$id' AND `pinned`='0' ORDER BY `bump` DESC");
	$Pins    = $Data->getRows("SELECT * FROM `threads` WHERE `pinned`='1' ORDER BY `bump` ASC");
?>
		<div class="panel">
			<div style="margin-bottom: -15px;" class="breadcrumb">
				<span style="margin-left:20px;">
					<a href="/Forum">Forum</a> > <a href="/Topic/<?php echo $Topic->id; ?>"><?php echo $Topic->name; ?></a>
				</span>
				<span style="float:right;margin-right:16px;">
					<a href="/Create/<?php echo $id; ?>" class="mod-btn">New Thread</a>
				</span>
				
			</div>
			
			<br /><br>
			
			<table style="border-collapse: collapse;" class="table-wrap">
				<tr>
					<th class="bold h" style="width: 677px; font-size: 20px; padding-bottom: 3px;">Thread</th>
					<th class="bold h" style="width: 182px; font-size: 20px; padding-bottom: 3px; padding-left: 9px; color: #3F3F3F;">Poster</th>
					<th class="bold h" style="width: 138px; font-size: 20px; padding-bottom: 3px; padding-left: 11px; color: #3F3F3F;">Replies</th>
					<th class="bold h" style="width: 186px; font-size: 20px; padding-bottom: 0px; color: #3F3F3F;">Last Post By</th>
					
				</tr>
			</table>
			
			<table style="border-collapse: collapse;" class="table-wrap">
			
			<?php foreach ($Pins as $Pin) {

				$Pin = Data::useRows($Pin);
				$Replies = $Data->getRows("SELECT * FROM `replies` WHERE `thread`='$Pin->id'");
				$Poster = $Data->getRow("SELECT * FROM `users` WHERE `id`='$Pin->poster'");
			?>
			
				<tr>
					<td onclick="javascript:location.href='http://avatarcentral.net/Thread/<?=$Pin->id?>'" class="t" style="cursor:pointer; width: 583px; font-size: 20px; padding-bottom: 14px; position: absolute; background: rgba(235, 201, 24, 0.15); font-family: josefin_sansbold, sans-serif; padding-top: 24px;">
							<span style="margin-left: 10px;">
								<icon style="color: rgb(209, 159, 30); font-size: 24px; margin-right: 12px;" class="fa fa-thumb-tack"></icon>
								<?php echo $Pin->name; ?>
							</span>
						</td>
					<td onclick="javascript:location.href='http://avatarcentral.net/User/<?=$Poster->id?>'" class="t" style="background: rgba(235, 201, 24, 0.15); font-family: josefin_sansbold, sans-serif;cursor:pointer;width:185px;text-align: center;">
						<?
						if(strlen($Poster->username) > 14) {
							echo substr($Poster->username,0,11).'...';
						}
						else {
							echo $Poster->username;
						}
						?>
						<span style="display:block; font-size: 14px; margin-top: -26px;">
							<?php
								echo $Site->timeAgo($Pin->created) . " ago";
							?>
						</span>
					</td>
					<td class="t" style="background: rgba(235, 201, 24, 0.15); font-family: josefin_sansbold, sans-serif; width: 85px;text-align: center;">
						<?=$Data->countRows($Replies)?>
					</td>
					<?
						$Reply = $Data->getRow("SELECT * FROM `replies` WHERE `thread`='$Pin->id' ORDER BY id DESC LIMIT 1");
						$reply_exists = isset($Reply->id) ? $Reply->id : '';
					?>
					<td <? if($reply_exists) { ?>onclick="javascript:location.href='http://avatarcentral.net/User/<?=$Reply->poster?>'"<? } ?> class="t" style="background: rgba(235, 201, 24, 0.15);cursor:pointer;width: 187px;text-align: center;">
						<?php
						
						if($reply_exists) {
							$ReplyPoster = new User($Reply->poster);
							if(strlen($ReplyPoster->username) > 14) {
								echo substr($ReplyPoster->username,0,11).'...';
							}
							else {
								echo $ReplyPoster->username;
							}
						?>
							<span style="display:block; font-size: 14px; margin-top: -26px;">
								<?php
									echo $Site->timeAgo($Reply->created) . " ago";
								?>
							</span>
						<?
						}
						else {
						?>
							No replies!
						<?
							}
						?>
					</td>
				</tr>
			
			<? }
			foreach ($Threads as $Thread) {

				$Thread = Data::useRows($Thread);
				$Replies = $Data->getRows("SELECT * FROM `replies` WHERE `thread`='$Thread->id'");
				$Poster = $Data->getRow("SELECT * FROM `users` WHERE `id`='$Thread->poster'");
			?>
			
				<tr>
					<td onclick="javascript:location.href='http://avatarcentral.net/Thread/<?=$Thread->id?>'" class="t" style="cursor:pointer; width: 683px; font-size: 20px; padding-bottom: 3px;">
							<span style="cursor:pointer;margin-left: 10px;">
								<icon style="font-size: 19px; margin-right: 13px;" class="fa fa-file"></icon>
								<?php echo $Thread->name; ?>
							</span>
						</td>
					<td onclick="javascript:location.href='http://avatarcentral.net/User/<?=$Poster->id?>'" class="t" style="cursor:pointer;width: 178px;text-align: center;">
						<?
						if(strlen($Poster->username) > 14) {
							echo substr($Poster->username,0,11).'...';
						}
						else {
							echo $Poster->username;
						}
						?>
						<span style="display:block; font-size: 14px; margin-top: -26px;">
							<?php
								echo $Site->timeAgo($Thread->created) . " ago";
							?>
						</span>

					</td>
					<td class="t" style="width: 152px;text-align: center;">
						<?=$Data->countRows($Replies)?>
					</td>
					<?
						$Reply = $Data->getRow("SELECT * FROM `replies` WHERE `thread`='$Thread->id' ORDER BY id DESC LIMIT 1");
					?>
					<td onclick="javascript:location.href='http://avatarcentral.net/User/<?=$Reply->poster?>'" class="t" style="cursor:pointer;width: 179px;text-align: center;">
						<?php
						$reply_exists = isset($Reply->id) ? $Reply->id : '';
						if($reply_exists) {
							$ReplyPoster = new User($Reply->poster);
							if(strlen($ReplyPoster->username) > 14) {
								echo substr($ReplyPoster->username,0,11).'...';
							}
							else {
								echo $ReplyPoster->username;
							}
						?>
							<span style="display:block; font-size: 14px; margin-top: -26px;">
								<?php
									echo $Site->timeAgo($Reply->created) . " ago";
								?>
							</span>
						<?
						}
						else {
						?>
							No replies!
						<?
							}
						?>
					</td>
				</tr>
			
			<? } ?>
			</table>
		</div>
<?
	$Site->showFooter();
?>
                                                            
                            
                            
                                                            
                                                            
                            
                            
                            
                            
                            
                            
                            
                            
                            