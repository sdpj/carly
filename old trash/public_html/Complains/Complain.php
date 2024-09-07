<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
?>
<html>
<style>
#ajax_form {width:410px;font-family:verdana,arial;font-size:12px}
#ajax_form td{font-family:verdana,arial;font-size:12px}
#ajax_form_header {font-family:verdana,arial;font-size:1.3em;font-weight:bold;text-align:center}
#returned_value{font-family:verdana,arial;text-align:center;font-size:12px;color:#000000}
#go {border:1px solid #CCCCCC;background:#FFF}
</style>


<form>
<div id="header"><center><strong>Complain<strong></center></div>
<br />
<table width="350" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr> 
    <td><label>Your Username:</label></td>
    <td><input type="text" id="Username" style="width:100%" /></td>
  </tr>
  <tr> 
    <td><label>Your Email:</label></td>
    <td><input type="text" id="Email" style="width:100%" /></td>
  </tr>
  <tr> 
    <td><label>Requested Staff:</label></td>
    <td><input type="text" id="RequestedStaff" style="width:100%" /></td>
  </tr>
  <tr> 
    <td colspan="2">
    	<label>Your Complaint:</label><br /><br />
    	<textarea name="Complaint" style="width:100%;height:160px" id="Complaint"></textarea>
    </td>
  </tr>
  <tr align="center"> 
    <a href="mailto:help@Gravitar.net?subject=test&amp;body=test">Submit</a>
  </tr>
</table>
</html>
<?php
$Username = SecurePost($_POST['Username']);
$Email = SecurePost($_POST['Email']);
$RequestedStaff = SecurePost($_POST['Requested Staff']);
$Complaint = SecurePost($_POST['Complaint']);
$Submit = $_POST['Submit'];

if ($Submit) {
    
if(!$Username) {
    echo"Please include your Username";
    }
elseif(!$Email) {
    echo "Please include your Email";
}
elseif(!$Complaint) {
    echo "Please include a complaint.";
}
elseif(!$RequestedStaff) {
    echo "Please include the requested staff!";
}

else {
    
 mysql_query("INSERT INTO Apps (Username, Email, Complaint, RequestedStaff) VALUES ('$Username','$Email','$Complaint','$RequestedStaff')");  
    echo "<font color='green'><b>Your complaint is being reviewed, 3 complaints and the staff badge is revoked.</b></font>";
}

}