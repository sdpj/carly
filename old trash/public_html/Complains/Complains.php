<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
?>
<html>
<div class="comment">
    <div class="avatar">
        <a href="/index.php">
        <img src="http://www.imgbomb.com/i/d15/xdma7.png">
        </a>
    </div>

    <div class="name"><a href="/index.php">Gravitar (Anonymous Player)</a></div>
    <div title="Added at 06:40 on 30 Jun 2010" class="date">30 Jun 2010</div>
    <p>Message goes here</p>
</div>
<div id="addCommentContainer">
    <p>Add a complain</p>
    <form id="addCommentForm" method="post" action="">
    	<div>
        	<label for="Username">Your Username</label>
        	<input type="text" name="name" id="name" />

            <label for="Email">Your Email</label>
            <input type="text" name="Email" id="email" />

            <label for="body">Complaint</label>
            <textarea name="body" id="body" cols="20" rows="5"></textarea>

            <input type="submit" id="submit" value="Submit" />
        </div>
    </form>
</div>
