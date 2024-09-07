<?php
require "Header.php";



if ($myU->PowerAdmin >= "true") {
 
    $Title = mysql_real_escape_string(strip_tags(stripslashes($_POST['Title'])));
    $Body = mysql_real_escape_string(strip_tags(stripslashes($_POST['Body'])));
    $Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit'])));
     
    if($Submit)
    {
     
        if(!$Title)
        {
         
            echo "Error";
         
        }
		
        if (!$Body)
        {
         
            echo "Error";
         
        }
        else
        {
         
            mysql_query("INSERT INTO News (Username, Title, Body, PosterID)
            VALUES ('".$myU->Username."','".$Title."','".$Body."','".$myU->ID."')");
            header("Location: /blog.php");
         
        }
     
    }
     
    echo "
    <form action='' method='POST'>
        Title: <input type='text' style='width:600px;' name='Title'>
        <br>
        Body:
        <br>
        <textarea name='Body' rows='10' cols='80'></textarea>
        <br>
        <input type='submit' name='Submit' value='Post To Blog' class='Verstuur'>
    </form>
    ";
 
}

else {
echo "Error";
	}