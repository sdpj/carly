<?php
include($_SERVER['DOCUMENT_ROOT']."/header.php");
?>
<div class="col s12 m9 l8">
<div class="container" style="width:100%;">
<form action="" method="post"> 

<label id="first">Thread</label><br/>
<input type="text" name="title"><br/>

<label id="first">Body</label><br/>
<input type="text" name="post"><br/>

<button type="submit" name="save">Post</button>

</form>
</div>
</div>
<?
if(isset($_POST['save'])){
$hi = $handler->query("INSERT INTO threads (threadAdmin, threadTitle, threadBody) VALUES ('$user','".$_POST["title"]."','".$_POST["post"]."')");
} include($_SERVER['DOCUMENT_ROOT']."/footer.php");
?>