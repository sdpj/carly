<?php

// @Copyright Void Team 

// Made by Bailey Tonning
include "Header.php";
if (!User) {
header("Location: index.php"); exit(); }
echo "

<b>

<font size='3'>Make a job application</font><br />

</b>


<br /><br /><br />

<form action='' method='post'>

<table>
<tr>
<td>
<b>Type:</b>
</td>
<td>
<select name='Job'>
<option value='Artist'>Artist</option>
<option value='Mega Moderator'>Mega Moderator</option>
<option value='Image Moderator'>Image Moderator</option>
<option value='Forum Moderator'>Forum Moderator</option>
<option value='Administrator'>Administrator</option>
<option value='Community Manager'>Community Manager</option>
<option value='Director'>Director</option>
<option value='Developer'>Developer</option>
</select>
</td>
</tr>
<tr>
<td>
<b>Full Name:</b>
</td>
<td>
<input type='input' name='Name' placeholder='First Last'>
</td>
</tr>
<tr>
<td>
<b>Date of birth:</b>
</td>
<td>
<input type='input' name='Age' placeholder='Day/Month/Year'>
</td>
</tr>
<tr>
<td>
<b>Country:</b>
</td>
<td>
<input type='input' name='Country'>

</td>
</tr>
</table><br />


<input type='submit' name='Submit' value='Send'></form>

<b>Once your application is read a staff memeber will message you</b>


";


$Name = SecurePost($_POST['Name']);
$Age = SecurePost($_POST['Age']);
$Country = SecurePost($_POST['Country']);
$Job = SecurePost($_POST['Job']);
$Ass = $_POST['ass'];
$Submit = $_POST['Submit'];
$Username = $myU->Username;


if ($Submit) {
    
if(!$Name) {
    echo"Please include your name";
    }
elseif(!$Age) {
    echo "Please include your age";
}
elseif(!Desc) {
    echo "Please include a description";
}
elseif(!$Country) {
    echo "Please include the country your in";
}

else {
    
 mysql_query("INSERT INTO Apps (Name, Age, Country, Username, Job) VALUES ('$Name','$Age','$Country','$myU->Username','$Job')");  
    echo "<font color='green'><b>Your app has been sent</b></font>";
}

}

include "Footer.php";
?>