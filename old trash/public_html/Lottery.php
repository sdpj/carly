<?php



require_once("Header.php");

?>

<html>
<head>
<body>
<script type='javascript' type='text/javascript'>

function enter() {

alert("You have entered");
}
</script>



<?php

print_r("<font size='3'>Gravitar Lottery</font> <br />
<br />

<form action='' method='post'>


<input type='button' name='submit' value='Enter' onclick='enter()' >

</form>
");


$enter = mysql_real_escape_string($_POST['submit']);


if ($enter) {

mysql_query("INSERT INTO LotteryEntries (Username) VALUES ('$myU->Username')");
}

