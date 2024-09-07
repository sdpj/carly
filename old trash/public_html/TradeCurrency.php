<?
include 'Header.php';
?>
<center>
<h1>Trade Currency</h1>
You Have <? echo $Bux ?> VOIN(s) and <? echo "$myU->Veuros" ?> VEURO(s)

<p>1 <font color='green'>VOIN</font> = 10 <font color='orange'>Veuros</font> <br>
10 <font color='orange'>Veuros</font> = 1 <font color='green'>VOIN</font></p>
<form action='' METHOD='POST'>
<b>Amount: </b><input type='text' name='amount'>
<select name='currency'>
<option name='VOIN'>VOINs</option>
<option name='VEURO'>VEUROs</option>
</select>
<br>
<input type='submit' name='trade' value='Trade'>
</form>
<?
$submit = $_POST['submit'];
$give = $_POST['give'];
$voin= $_POST['VOIN'];
$veuro = $_POST['VEURO'];

if($User) {
	if(isset($submit)) {
			
			
			
			}
		
		}
	



?>
<?
include 'Footer.php';
?>
