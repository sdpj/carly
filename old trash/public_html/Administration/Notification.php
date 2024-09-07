<?php

include "Header.php";

if ($myU->PowerAdmin != "true") {
header("Location: index.php"); exit(); 
}


echo "
<b>Send notification to all users</b><br />
<br />
<font color='red'><font size='2'>Spamming this will result in losing your powers</font></font>
<br />
<br />
<form>
<textarea name='body' rows='15' cols='50'></textarea>
<br />
<input type='submit' name='submit' value='Submit'>
</form>";
